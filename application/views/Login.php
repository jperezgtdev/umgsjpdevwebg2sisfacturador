<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url('assets/login.css'); ?>">

  </head>
  <body>
    <div class="wrapper">
    <div class="box">
      <form action="<?php echo site_url('LoginController/login'); ?>" method="post">
        <h2>Iniciar Sesión</h2><br>
        <div class="inputBox">
            <input type="text" id="username" name="usuario" required>
            <div class="icon"><i class="fas fa-user"></i></div>
            <label for="usuario">Nombre de Usuario</label>
            <i></i>
          </div><br>
        <div class="inputBox">
            <input type="password" id="password" name="clave" required>
            <div class="icon"><i class="fas fa-key"></i></div>
            <label for="clave">Contraseña</label>
            <i></i>
          </div>
        <br><br>
        <input type="submit" value="Login" onclick="encriptar_pass();">       
    </form>
    </div>
  </div>

  <script>
    function encriptar_pass(){
      var pass = $('#password').val();
      var encriptada = btoa(pass);
      $("#password").val(encriptada);
    }
  </script>

  <script type="text/javascript" src=<?php echo base_url('public/js/jquery.js') ?>></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>
