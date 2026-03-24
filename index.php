<?php
$Errores = [];
$exito = false;
$datos = [];

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
        $Errores["contraseña"] = "La contraseña debe tener minimo 1 letra en mayuscula";
    }elseif(!preg_match("/[0-9]/",$contraseña)){
        $Errores["contraseña"] = "La contraseña debe tener minimo 1 letra en mayuscula";
    }elseif(!preg_match("/[@$!%*#?&]/",$contraseña)){
        $Errores["contraseña"] = "La contraseña debe tener minimo 1 letra en mayuscula";
    }

    if(empty($confirmContraseña)){
        $Errores["confirmContraseña"] = "Debes confirmar la contraseña";
    }elseif($confirmContraseña !== $contraseña){
        $Errores["confirmContraseña"] = "ERROR CONTRASEÑA INVALIDA";
    }
    
    if(empty($Errores)){
        $exito = true;
    }else{
        $datos=compact("nombre","email");
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registro</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <main class="w-full sm:w-96 md:w-[450px] lg:w-[500px] mx-auto px-4 container">
    <?php if ($exito){ ?>
          <div class="flex items-center gap-2 bg-green-950 border border-green-500 text-green-400 font-semibold py-3 px-4 rounded-xl mb-4">
            <span>Todo correcto</span>
          </div>
    <?php } ?>
    <h1 class="text-base md:text-lg lg:text-xl mb-2 ">Registro</h1>
    <form  method="POST" action="">

      <div class="mb-4">
        <label for="name">Nombre</label>
        <input type="text" id="name" class="h-10 " name="nombre" value="<?= $datos['nombre'] ?? '' ?>"/>
        <?php if (isset($Errores["nombre"])){ ?>
          <p class="text-red-500 text-sm mt-1"><?= $Errores['nombre'] ?></p>
        <?php } ?>
      </div>

      <div class="mb-4">  
        <label for="email">Email</label>
        <input type="email" id="email" class="h-10" name="email" value="<?= $datos['email'] ?? '' ?>"/>
        <?php if (isset($Errores["email"])){ ?>
          <p class="text-red-500 text-sm mt-1 "><?= $Errores['email'] ?></p>
        <?php } ?>
      </div>

      <div class="mb-4">
        <label for="password">Contraseña</label>
        <input type="password" id="contraseña" class="h-10" name="contraseña" />
        <?php if (isset($Errores["contraseña"])){ ?>
          <p class="text-red-500 text-sm mt-1"><?= $Errores['contraseña'] ?></p>
        <?php } ?>
      </div>

      <div class="mb-4">
        <label for="confirmPassword" class="whitespace-nowrap">Confirmar contraseña</label>
        <input type="password" id="confirmContraseña" class="h-10 " name="confirmContraseña"/>
        <?php if (isset($Errores["confirmContraseña"])){ ?>
          <p class="text-red-500 text-sm mt-1"><?= $Errores['confirmContraseña'] ?></p>
        <?php } ?>
      </div>

      <button type="submit" class="py-4 px-4 mt-3 btn-contrast">Registrarse</button>
    </form>
  </main>
</body>
</html>
