<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Barra de Navegación</title>
  <link rel="stylesheet" href="<?php echo base_url('assets/navbar.css'); ?>">
</head>
<body>
  <nav>
    <ul>
      <li><a href="<?= site_url('AltasUsuarioController/index') ?>">Alta</a></li>
      <li><a href="<?= site_url('LoginController/index')?>">Login</a></li>
      <!-- Agrega aquí más elementos de navegación si los necesitas -->
    </ul>
  </nav>
</body>
</html>

