<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url('assets/style.css'); ?>">

  </head>
  <body>
    <div class="wrapper">
    <div class="box">
      <form action="<?php echo site_url('LoginController/login'); ?>" method="post">
        <h2>Iniciar Sesión</h2><br>
        <div class="inputBox">
            <input type="text" name="usuario" required>
            <div class="icon"><i class="fas fa-user"></i></div>
            <label for="usuario">Nombre de Usuario</label>
            <i></i>
          </div><br>
        <div class="inputBox">
            <input type="password" name="clave" required>
            <div class="icon"><i class="fas fa-key"></i></div>
            <label for="clave">Contraseña</label>
            <i></i>
          </div>
        <br><br>
        <input type="submit" value="Login">       
    </form>
    </div>
  </div>
  </body>
</html>
