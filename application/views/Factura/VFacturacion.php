<?php require_once APPPATH . 'views/Dashboard/partesuperior.php' ?>

<?php require_once APPPATH . 'config/timezone_config.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?php echo base_url('assets/Venta/Factura.css'); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <title>Facturacion</title>
</head>

<body>
    <main>
        <form id="userForm" action="<?= site_url('FacturaController/crear_factura') ?>" method="post"
            onsubmit="return validateForm()">

            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-4">
                    <label for="cod_cliente">Cliente:</label><BR>
                    <select id="cliente" name="cliente" class="custom-select2">
                        <!-- Opciones del select -->
                    </select>
                </div>
                <div class="col-md-4">
                    <!-- Input de fecha -->
                    <label for="fecha">Fecha:</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" style="width: 200px;"
                        value="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="col-md-4">
                    <label for="numero_factura" class="mr-2">Factura No.</label>
                    <input type="text" name="numero_factura" id="numero_factura" value="<?php echo $numero_factura; ?>"
                        readonly class="form-control" style="width: 100px;">
                </div>
            </div>
            <br> <br>


            <div id="detalles" class="table-responsive">
                <table id="venta" class="table" style="text-align:center">
                    <thead>
                        <tr>
                            <th>Código de producto</th>
                            <th>Cantidad</th>
                            <th>Precio unitario</th>
                            <th>Subtotal</th>
                            <th><button type="add" class="fas fa-plus btn btn-success" style="font-size: 15px"
                                    onclick="agregarProducto()"> Agregar </button></th>
                        </tr>
                    </thead>
                    <tbody id="productos-tabla">
                        <tr>
                            <td>
                                <select id="producto" name="producto[]" class="custom-selectProducto" min="1" required>
                                </select>
                            </td>
                            <td>
                                <input type="number" name="cantidad[]" min="1" required>
                            </td>
                            <td>
                                <input type="number" name="precio_unitario[]" min="0.01" step="0.01" required>
                            </td>
                            <td>
                                <input type="number" name="monto_total[]" readonly>
                            </td>
                            <td>

                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"><strong></strong></td>
                            <td><label id="total" style="font-size: 25px"></label></td>
                        </tr>
                    </tfoot>
                </table>
            </div>


            <button type="Guardar" class="far fa-save btn btn-info" value="Guardar" style="font-size: 17px"> Guardar
            </button>
            </div>

        </form>
    </main>
    <script>
        function agregarProducto() {
            let table = document.querySelector("table tbody");
            let tr = document.createElement("tr");

            let codigo = document.createElement("td");
            codigo.innerHTML = '<select name="producto[]" class="custom-selectProducto" required></select>';

            let cantidad = document.createElement("td");
            cantidad.innerHTML = '<input type="number" name="cantidad[]" min="1" required>';

            let precio = document.createElement("td");
            precio.innerHTML = '<input type="number" name="precio_unitario[]" min="0.01" step="0.01" required>';

            let total = document.createElement("td");
            total.innerHTML = '<input type="number" name="monto_total[]" readonly>';

            let button = document.createElement("td");
            button.innerHTML = '<button type="button" class="btn btn-danger" onclick="eliminarProducto(this)">Eliminar</button>';

            tr.appendChild(codigo);
            tr.appendChild(cantidad);
            tr.appendChild(precio);
            tr.appendChild(total);
            tr.appendChild(button);
            table.appendChild(tr);

            $(tr).find(".custom-selectProducto").select2({
                placeholder: 'Producto',
                minimumInputLength: 1,
                ajax: {
                    url: '<?= site_url('FacturaController/cargar_producto') ?>',
                    dataType: 'json',
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });
        }

        function eliminarProducto(button) {
            let tr = button.parentNode.parentNode;
            tr.parentNode.removeChild(tr);
            calcularTotal();
        }

        function calcularTotal() {
            let total = 0;
            let monto_total = document.getElementsByName("monto_total[]");
            for (let i = 0; i < monto_total.length; i++) {
                total += parseFloat(monto_total[i].value);
            }
            document.getElementById("total").innerHTML = "Total: Q" + total.toFixed(2);
        }

        let detalles = document.querySelector("#detalles");
        detalles.addEventListener("input", function (event) {
            let target = event.target;
            if (target.name === "cantidad[]" || target.name === "precio_unitario[]") {
                let tr = target.parentNode.parentNode;
                let cantidad = parseFloat(tr.querySelector("[name='cantidad[]']").value);
                let precio = parseFloat(tr.querySelector("[name='precio_unitario[]']").value);
                let total = cantidad * precio;
                tr.querySelector("[name='monto_total[]']").value = total.toFixed(2);
                calcularTotal();
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.all.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <Script>
        $(document).ready(function () {
            $('.custom-select2').select2({
                placeholder: 'Cliente',
                minimumInputLength: 1,
                ajax: {
                    url: '<?= site_url('FacturaController/cargar_cliente') ?>',
                    dataType: 'json',
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });
        });

        $(document).ready(function () {
            $('.custom-selectProducto').select2({
                placeholder: 'Producto',
                minimumInputLength: 1,
                ajax: {
                    url: '<?= site_url('FacturaController/cargar_producto') ?>',
                    dataType: 'json',
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });
        });
    </script>
</body>

</html>