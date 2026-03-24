<?php

session_start();
$Errores = $_SESSION['Errores'] ?? null;
$exito = $_SESSION['exito'] ?? false;
$datos = $_SESSION["datos"] ?? [];
session_unset();
session_destroy();
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
    <form  method="POST" action="validacion.php">

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
