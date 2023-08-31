<?php require_once APPPATH . 'views/Dashboard/partesuperior.php'?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo base_url('assets/usuario/consulta.css'); ?>">
        <title>Formulario de Creación de Cliente</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <link rel="stylesheet" href="<?php echo base_url('assets/usuario/alta.css'); ?>"> 
    </head>
    <body>
        <section>
            <div class="form-box">
                <div class="form-value">
                    <h2>Crear Cliente</h2>
                    <form id="userForm" action="<?= site_url('ClienteController/crear_cliente') ?>" method="post">
                        <div class="inputbox">
                            <i class="fa-solid fa-user fa-lg"></i>
                            <input type="text" id="nombreC" name="nombreC" required>
                            <label for="nombreCliente">Nombre </label>
                        </div>
                        <div class="inputbox">
                            <i class="fa-solid fa-pen"></i>
                            <input type="text" id="nit" name="nit" required>
                            <label for="NIT">NIT</label>
                        </div>
                        <div class="inputbox">
                            <i class="fa-solid fa-house"></i>
                            <input type="text" id="Direccion" name="Direccion" required>
                            <label for="Direccion">Direccion</label>
                        </div>
                        <div class="inputbox">
                            <i class="fa-solid fa-phone"></i>
                            <input type="text" id="Telefono" name="Telefono" required>
                            <label for="Telefono">Teléfono</label>
                        </div>
                        <button type="submit">Crear Cliente</button>
                    </form>
                </div>
            </div>
        </section>
        <script 
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
        </script>
    </body>
</html>
