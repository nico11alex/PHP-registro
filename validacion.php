<?php
session_start();
$Errores = [];

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $nombre =trim($_POST["nombre"]);
    $email = trim($_POST["email"]);
    $telefono = trim($_POST["telefono"]);
    $contraseña = trim($_POST["contraseña"]);
    $confirmContraseña = trim($_POST["confirmContraseña"]);

    if(empty($nombre)){
        $Errores["nombre"] = "El nombre es obligatorio";
    }

    if(empty($email)){
        $Errores["email"] = "El email es obligatorio";
    }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $Errores["email"] = "El email " .$email. " no tiene un formato valido";
    }

    if(empty($telefono)){
        $Errores["telefono"] = "El telefono es obligatorio";
    }elseif(strlen($telefono) !== 10){
        $Errores["telefono"] = "El telefono " .$telefono. " tiene una cantidad de digitos erronea";
    }elseif(!filter_var($telefono, FILTER_VALIDATE_INT)){
        $Errores["telefono"] = "El telefono " .$telefono. " no tiene un formato valido";
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
        $Errores["contraseña"] = "La contraseña debe tener minimo 1 un número";
    }elseif(!preg_match("/[@$!%*#?&]/",$contraseña)){
        $Errores["contraseña"] = "La contraseña debe tener minimo 1 caracter especial";
    }

    if(empty($confirmContraseña)){
        $Errores["confirmContraseña"] = "Debes confirmar la contraseña";
    }elseif($confirmContraseña !== $contraseña){
        $Errores["confirmContraseña"] = "ERROR CONTRASEÑA INVALIDA";
    }
    
    $_SESSION["Errores"] = $Errores;
    header("Location: index.php");
    exit;
}
?>
