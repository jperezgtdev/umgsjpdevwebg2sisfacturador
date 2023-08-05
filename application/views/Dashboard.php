<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Bienvenido</h1>
    <br> <br>
    <form action="<?php echo site_url('LogoutController/logout'); ?>" method="post">
    <button type="submit">Cerrar sesión</button>
</form>
</body>
</html>
