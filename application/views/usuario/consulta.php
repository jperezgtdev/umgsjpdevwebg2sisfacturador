<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('assets/usuario/consulta.css'); ?>">
    <title>Consulta de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="crossorigin="anonymous">
</head>

<body>
    <?php $this->load->view('navbar'); ?>
    <header>
        <h1>Consulta de Usuarios</h1>
    </header>
    <main>
        <form class="form-group" action="<?= site_url('ConsultaUsuarioController/buscarPorNombre'); ?>" method="post">
            <label for="firstName">Nombre:</label>
            <input type="text" id="firstName" name="firstName" placeholder="Ingrese el nombre">
            <button type="submit">Buscar</button>
        </form>
        <br>
        <div id="userList">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>
                            <i class="fa-solid fa-user fa-lg" style="color: #e63946;"></i>
                            Nombre
                        </th>
                        <th>
                            <i class="fa-solid fa-users-gear fa-lg" style="color: #e63946;"></i>
                            Rol
                        </th>
                        <th>
                            <i class="fa-solid fa-lock" style="color: #e63946;"></i>
                            Contraseña
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($prueba_data as $row): ?>
                    <tr>
                        <td><?php echo $row->usuario; ?></td>
                        <td><?php echo $row->rol; ?></td>
                        <td><?php echo $row->clave; ?></td>
                        <td class="td_boton">
                            <a href="<?= site_url('ConsultaUsuarioController/obtenerDatos/' . $row->id_usuario); ?>" class="edit-btn">Editar</a>
                            <button class="delete-btn">Eliminar</button>
                        </td>       
                    </tr>
                    <?php endforeach; ?> 
                </tbody>
            </table>
        </div>
    </main>
    <footer>
        <p>Consulta de Usuarios</p>
    </footer>

</body>

</html>