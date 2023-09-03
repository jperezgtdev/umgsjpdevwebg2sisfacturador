<?php require_once APPPATH . 'views/Dashboard/partesuperior.php'?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo base_url('assets/usuario/consulta.css'); ?>">
        <title>Consulta de proveedores</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    </head>

    <body>
        <main>
            <div class="nuevo-producto">
                <a class="btn btn-success" id="new" style="float: right; margin-right: 2px;" href="<?= site_url('ProveedorController/AltaProveedor')?>">
                    <i class="fa-solid fa-boxes-packing"></i> Nuevo proveedor
                </a>
            </div>
            <div id="userList">
                <table id="ProveedorTable" class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th> 
                                <i class="fa-solid fa-pen" style="color: #e63946;"></i>
                                Nit
                            </th>
                            <th>
                                <i class="fa-solid fa-user fa-lg" style="color: #e63946;"></i>
                                Proveedor
                            </th>
                            <th>
                                <i class="fa-solid fa-house" style="color: #e63946;"></i>
                                Direccion
                            </th>
                            <th>
                                <i class="fa-solid fa-phone" style="color: #e63946;"></i>
                                Telefono
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
                                    <?php echo $row->nit; ?>
                                </td>
                                <td>
                                    <?php echo $row->nombre; ?>
                                </td>
                                <td>
                                    <?php echo $row->direccion; ?>
                                </td>
                                <td>
                                    <?php echo $row->telefono; ?>
                                </td>
                                <td class="td_boton">
                                    <a href="<?= site_url('ProveedorController/obtenerProveedores/' . $row->id_proveedor); ?>"
                                        class="edit-btn" data-bs-toggle="modal" data-bs-target="#editarModal"
                                        data-proveedor='<?php echo json_encode($row); ?>'>Editar
                                    </a>
                                    <a id="EliminarProveedor"
                                        href="<?= site_url('ProveedorController/desactivarProveedor/' . $row->id_proveedor); ?>"
                                        class="delete-btn">Eliminar
                                    </a>
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
                        <h5 class="modal-title" id="editarModalLabel">Datos del Proveedor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm" action="" method="POST">
                            <div>
                                <label for="editCliente">Nombre </label>
                                <input type="text" id="editCliente" name="editCliente"
                                    placeholder="Ingrese el nombre de proveedor">
                            </div>
                            <br>
                            <div>
                                <label for="editNit">Nit </label>
                                <input type="text" id="editNit" name="editNit" placeholder="Ingrese el nit">
                            </div>
                            <br>
                            <div>
                                <label for="editDireccion">Direccion </label>
                                <input type="text" id="editDireccion" name="editDireccion" placeholder="Ingrese la dirección">
                            </div>
                            <br>
                            <div>
                                <label for="editTelefono">Telefono </label>
                                <input type="text" id="editTelefono" name="editTelefono" placeholder="Ingrese el teléfono">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button id="guardarCambiosBtn" type="button" class="btn btn-primary">Editar</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function () {
                $('#ProveedorTable').DataTable();
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
                        const proveedorData = JSON.parse(button.getAttribute('data-proveedor'));
                        const editProveedorInput = document.getElementById('editCliente');
                        const editNitInput = document.getElementById('editNit');
                        const editDireccionInput = document.getElementById('editDireccion');
                        const editTelefonoInput = document.getElementById('editTelefono');

                        editProveedorInput.value = proveedorData.nombre;
                        editNitInput.value = proveedorData.nit;
                        editDireccionInput.value = proveedorData.direccion;
                        editTelefonoInput.value = proveedorData.telefono;
                        saveChangesUrl = '<?php echo site_url("ProveedorController/guardarCambios/' + proveedorData.id_proveedor + '"); ?>';
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
                        text: "El proveedor será eliminado",
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
                                text: 'El proveedor ha sido Eliminado',
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

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.all.min.js"></script>
    </body>

</html>