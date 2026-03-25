<?php
session_start();
$Errores = [];
require_once "config/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $nombre =trim($_POST["nombre"]);
    $email = trim($_POST["email"]);
    $contraseña = ($_POST["contraseña"]);
    $confirmContraseña = ($_POST["confirmContraseña"]);

    if(empty($nombre)){
        $Errores["nombre"] = "El nombre es obligatorio";
    }

    if(empty($email)){
        $Errores["email"] = "El email es obligatorio";
    }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $Errores["email"] = "El email " .$email. " no tiene un formato valido";
    }

    if(empty($contraseña)){
        $Errores["contraseña"] = "La contraseña es obligatorio";
    }elseif(strlen($contraseña) <8){
        $Errores["contraseña"] = "La contraseña debe tener minimo 8 caracteres";
    }elseif(!preg_match("/[A-Z]/",$contraseña)){
        $Errores["contraseña"] = "La contraseña debe tener minimo 1 letra en mayuscula";
    }elseif(!preg_match("/[a-z]/",$contraseña)){
        $Errores["contraseña"] = "La contraseña debe tener minimo 1 letra en minuscula";
    }elseif(!preg_match("/[0-9]/",$contraseña)){
        $Errores["contraseña"] = "La contraseña debe tener minimo 1 número";
    }elseif(!preg_match("/[@$!%*#?&]/",$contraseña)){
        $Errores["contraseña"] = "La contraseña debe tener minimo 1 caracter especial";
    }

    if(empty($confirmContraseña)){
        $Errores["confirmContraseña"] = "Debes confirmar la contraseña";
    }elseif($confirmContraseña !== $contraseña){
        $Errores["confirmContraseña"] = "ERROR CONTRASEÑA INVALIDA";
    }
    
    $sql = "SELECT email FROM usuarios WHERE email = :email ";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        ":email" => $email
    ]);

    if($stmt->fetch()){
        $Errores["email"] = "El email ya está registrado";
    }

    if(!empty($Errores)){
        $_SESSION["Errores"] = $Errores;
        $_SESSION["datos"]=compact("nombre","email");
        header("Location: index.php");
        exit;
    }
    
    
    $sql = "INSERT INTO usuarios(nombre,email,contrasena) VALUES (:nombre, :email, :contrasena)";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        ":nombre" => $nombre,
        ":email" => $email,
        ":contrasena" => $contraseña
    ]);
    $_SESSION['exito'] = true;
    header("Location: index.php");
    exit;
    
}
?>