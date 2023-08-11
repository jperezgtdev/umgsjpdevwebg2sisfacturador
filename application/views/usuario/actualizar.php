<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('assets/usuario/consulta.css'); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="crossorigin="anonymous">
        <title>Consulta de Usuarios</title>
</head>
<body>
<?php $this->load->view('navbar'); ?>

    <header>
        <h1>Actualizar Usuario</h1>
    </header>  
    <main >
        <?php if ($usuario) { ?>
            <form action="<?php echo site_url('UsuarioController/guardarCambios/' . $usuario->id_usuario); ?>" method="POST">
                <div>
                    <label for="editUsuario">Nombre de Usuario:</label>
                    <input type="text" id="editUsuario" name="editUsuario" value="<?php echo $usuario->usuario; ?>" placeholder="Ingrese el nombre de usuario">
                </div>
                <br>
                <div>
                    <i id="icon-select" class="fa-solid fa-users"></i>
                    <select id="editRol" name="editRol" required>
                        <option disabled>elija un rol</option>
                        <option value="administrador" <?php if ($usuario->id_rol == 1) echo 'selected'; ?>>Administrador</option>
                        <option value="usuario" <?php if ($usuario->id_rol == 2) echo 'selected'; ?>>Usuario</option>
                    </select>      
                </div>
                <br>
                <div>
                    <label for="editClave">Ingrese clave actual</label>
                    <input type="password" id="claveIngresado" name="claveIngresado" placeholder="Ingrese la clave">
                    <input id="clave" name="clave" type="hidden" value="<?php echo $usuario->clave; ?>" />
                </div>
                <br>
                <div>
                    <label for="editClave">Nueva clave:</label>
                    <input type="password" id="editClave" name="editClave" placeholder="Ingrese la clave">
                </div>
                <br>
                <div>
                    <label for="editClave">confirmar clave: </label>
                    <input type="password" id="confirmarClave" name="confirmarClave" placeholder="Ingrese la clave">
                </div>
                <br>
                <button type="submit" class="rounded-button">Guardar Cambios</button>
            </form>
        <?php } else { ?>
            <p>No se encontró el usuario.</p>
        <?php } ?>
    </main>
   
</body>
</html>
