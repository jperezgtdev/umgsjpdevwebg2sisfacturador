<?php require_once APPPATH . 'views/Dashboard/partesuperior.php' ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('assets/usuario/consulta.css'); ?>">
    <title>Consulta de Usuarios</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <link rel="stylesheet" href="<?php echo base_url('assets/usuario/consulta.css'); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

</head>
<header>
    <h1>Usuarios Existentes</h1>
</header>

<body>
    <main>
        <a class="btn btn-success" id="new" style="float: right; margin-right: 2px;" href="<?= site_url('UsuarioController/indexAlta')?>">
            <i class="fas fa-user-plus"></i> Nuevo Usuario
        </a>
        <br><br>
        <br>
        <div id="userList">
            <table id="UsuarioTable" class="table table-hover table-striped">
                <thead>
                    <tr>
                       
                        <th>
                        <br> <br>
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
                        <th>
                            <i class="fa-solid fa-bolt" style="color: #e63946;"></i>
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($prueba_data as $row): ?>
                        <tr>
                            <td>
                                <?php echo $row->usuario; ?>
                            </td>
                            <td>
                                <?php echo $row->rol; ?>
                            </td>
                            <td>
                                <?php echo $row->clave; ?>
                            </td>
                            <td class="td_boton">
                                <a href="<?= site_url('UsuarioController/obtenerDatos/' . $row->id_usuario); ?>"
                                    class="edit-btn">Editar</a>

                                <a id="EliminarUsuario"
                                    href="<?= site_url('UsuarioController/desactivarUsuario/' . $row->id_usuario); ?>"
                                    class="delete-btn">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.all.min.js"></script>


<script>
    const deleteLinks = document.querySelectorAll('.delete-btn');

    deleteLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault();

            const deleteUrl = this.getAttribute('href');

            Swal.fire({
                title: '¿Estás seguro?',
                text: "El usuario será dado de Baja",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Eliminado!',
                        text: 'El usuario ha sido Eliminado',
                        icon: 'success',
                        confirmButtonColor: '#3085d6'
                    }).then(() => {
                        window.location.href = deleteUrl;
                    });
                }
            });
        });
    });
</script>


<script>
    $(document).ready(function () {
        $('#UsuarioTable').DataTable();
    });
</script>

</html>