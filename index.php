<?php
session_start();
$Errores = $_SESSION["Errores"] ?? [];
unset($_SESSION["Errores"]);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registro</title>
  <link rel="stylesheet" href="style.css" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
  <main class="w-1/3  container">
    <?php if (empty($Errores)){ ?>
          <p class="text-green-500 text-sm mt-1 ">TODO CORRECTO</p>
        <?php } ?>
    <h1 class="text-lg  mb-2 ">Registro</h1>
    <form  method="POST" action="validacion.php">

      <div class="mb-4">
        <label for="name">Nombre</label>
        <input type="text" id="name" class="h-10 " name="nombre"/>
        <?php if (isset($Errores["nombre"])){ ?>
          <p class="text-red-500 text-sm mt-1"><?= $Errores['nombre'] ?></p>
        <?php } ?>
      </div>

      <div class="mb-4">  
        <label for="email">Email</label>
        <input type="email" id="email" class="h-10" name="email"/>
        <?php if (isset($Errores["email"])){ ?>
          <p class="text-red-500 text-sm mt-1 "><?= $Errores['email'] ?></p>
        <?php } ?>
      </div>

      <div class="mb-4">
        <label for="phone">Teléfono</label>
        <input type="tel" id="phone" class="h-10 " name="telefono"/>
        <?php if (isset($Errores["telefono"])){ ?>
          <p class="text-red-500 text-sm mt-1"><?= $Errores['telefono'] ?></p>
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
        <label for="confirmPassword">Confirmar contraseña</label>
        <input type="password" id="confirmContraseña" class="h-10 " name="confirmContraseña"/>
        <?php if (isset($Errores["confirmContraseña"])){ ?>
          <p class="text-red-500 text-sm mt-1"><?= $Errores['confirmContraseña'] ?></p>
        <?php } ?>
      </div>

      <button type="submit" class="py-4 px-4 mt-3 ">Registrarse</button>
    </form>
  </main>
</body>
</html>
