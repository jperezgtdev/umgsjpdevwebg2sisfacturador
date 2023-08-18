<?php require_once APPPATH . 'views/Dashboard/partesuperior.php' ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('assets/producto/consulta.css'); ?>">
    <title>Consulta de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <title>Manejo de Producto</title>
</head>

<body>
    <header>
        <h1>Manejo de Producto</h1>
    </header>
    <main>
        <!-- modale para ingresar un producto -->
        <a class="btn btn-success" id="new" style="float: right; margin-right: 2px;"
            href="<?= site_url('ProductoController/indexAlta') ?>">
            <i class="fas fa-user-plus"></i> Agregar
        </a>
        <br><br>

        <!-- Lista de productos -->
        <div id="userList">
            <table id="ClienteTable" class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>
                            <i class="fa-solid fa-user fa-lg" style="color: #e63946;"></i>
                            Producto
                        </th>
                        <th>
                            <i class="fa-solid fa-users-gear fa-lg" style="color: #e63946;"></i>
                            Existencia
                        </th>
                        <th>
                            <i class="fa-solid fa-lock" style="color: #e63946;"></i>
                            Categoria
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
                                <?php echo $row->producto; ?>
                            </td>
                            <td>
                                <?php echo $row->existencia; ?>
                            </td>
                            <td>
                                <?php echo $row->categoria; ?>
                            </td>
                            <td class="td_boton">
                                <a href="<?= site_url('ProductoController/obtenerDatos/' . $row->id_producto); ?>"
                                    class="edit-btn" data-bs-toggle="modal" data-bs-target="#editarModal"
                                    data-cliente='<?php echo json_encode($row); ?>'>Editar</a>

                                <a id="EliminarUsuario"
                                    href="<?= site_url('ProductoController/eliminarProducto/' . $row->id_producto); ?>"
                                    class="delete-btn">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>




    </main>

    <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarModalLabel">Datos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" action="" method="POST">
                        <div>
                            <label for="editProducto">Producto</label>
                            <input type="text" id="editProducto" name="editProducto"
                                placeholder="Ingrese el nombre de usuario">
                        </div>

                        <div>
                            <label for="editCategoria">Categoria</label>
                            <input type="text" id="editCategoria" name="editCategoria"
                                placeholder="Ingrese el nombre de usuario">
                        </div>

                        <div>
                            <label for="editExistencia">Existencia:</label>
                            <input type="text" id="editExistencia" name="editExistencia"
                                placeholder="Ingrese el nombre de usuario">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button id="guardarCambiosBtn" type="button" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
            $('#ClienteTable').DataTable();
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editButtons = document.querySelectorAll('.edit-btn');
            const editForm = document.getElementById('editForm');
            const guardarCambiosBtn = document.getElementById('guardarCambiosBtn');
            let saveChangesUrl = ''; // Almacenará la URL para guardar cambios

            editButtons.forEach(button => {
                button.addEventListener('click', function (event) {
                    event.preventDefault();
                    const clienteData = JSON.parse(button.getAttribute('data-cliente'));
                    const editClienteInput = document.getElementById('editProducto');
                    const editCategoriaInput = document.getElementById('editCategoria');
                    const editExistenciaInput = document.getElementById('editExistencia');



                    editClienteInput.value = clienteData.producto;
                    editCategoriaInput.value = clienteData.id_categoria;
                    editExistenciaInput.value = clienteData.existencia;

                    saveChangesUrl = '<?php echo site_url("ProductoController/guardarCambios/' + clienteData.id_producto + '"); ?>';
                    $('#editarModal').modal('show');

                });
            });

            guardarCambiosBtn.addEventListener('click', function (event) {
                if (saveChangesUrl) {
                    editForm.action = saveChangesUrl; // Establece la URL en el atributo action
                    editForm.submit(); // Envía el formulario
                }
            });
        });
    </script>
    <script>
        const deleteLinks = document.querySelectorAll('.delete-btn');

        deleteLinks.forEach(link => {
            link.addEventListener('click', function (event) {
                event.preventDefault();

                const deleteUrl = this.getAttribute('href');

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "El Cliente será eliminado",
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
                            text: 'El Cliente ha sido Eliminado',
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
</body>

</html>