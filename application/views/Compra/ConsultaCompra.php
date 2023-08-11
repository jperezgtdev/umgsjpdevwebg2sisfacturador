<?php require_once APPPATH . 'views/Dashboard/partesuperior.php' ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('assets/compra/consulta.css'); ?>">
    <title>Consulta de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
</head>

<body>
    <header>
        <h1>Consulta de Compras</h1>
    </header>
    <main>

        <a class="btn btn-success" id="new" style="float: right; margin-right: 2px;"
            href="<?= site_url('CompraController/indexAlta') ?>">
            <i class="fa-solid fa-cart-plus"></i> Nueva Compra
        </a>
        <br><br>
        <br>
        <div id="userList">
            <table id="ClienteTable" class="table table-hover table-striped">

                <thead>
                    <tr>
                        <th>
                            <br><br>
                            <i class="fa-solid fa-hashtag" style="color: #e63946;"></i>
                            No. Compra
                        </th>
                        <th>
                            <i class="fa-solid fa-tag" style="color: #e63946;"></i>
                            Producto
                        </th>
                        <th>
                            <i class="fa-solid fa-circle-plus" style="color: #e63946;"></i>
                            Cantidad
                        </th>
                        <th>
                            <i class="fa-solid fa-piggy-bank" style="color: #e63946;"></i>
                            Precio
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
                                <?php echo $row->id_compra; ?>
                            </td>
                            <td>
                                <?php echo $row->producto; ?>
                            </td>
                            <td>
                                <?php echo $row->cantidad; ?>
                            </td>
                            <td>
                                <?php echo $row->precio_compra; ?>
                            </td>
                            <td class="td_boton">
                                <a id="EliminarUsuario"
                                    href="<?= site_url('CompraController/desactivarCompra/' . $row->id_compra); ?>"
                                    class="delete-btn">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
    <br><br>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.all.min.js"></script>
</body>

</html>