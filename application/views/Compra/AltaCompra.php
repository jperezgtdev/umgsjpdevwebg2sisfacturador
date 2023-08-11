<?php require_once APPPATH . 'views/Dashboard/partesuperior.php' ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url('assets/compra/alta.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/compra/select2.css'); ?>">
    <title>Formulario de Ingreso de Compra</title>
</head>
<header>
    <h1>Ingreso de Compra</h1>
</header>
<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <h2>Ingresar Compra</h2>
                <form id="userForm" action="<?= site_url('CompraController/crear_compra') ?>" method="post" onsubmit="return validateForm()">
                    <div class="rol-select">
                        <div class="row-select">
                            <i class="fa-solid fa-caret-down"></i>
                        </div>
                        <i id= "icon-select" class="fa-solid fa-users"></i>
                        <select id="proveedor" name="proveedor" required>
                            <option selected disabled>seleccione un proveedor</option>
                            <?php foreach ($proveedores as $proveedor): ?>
                            <option value="<?php echo $proveedor['id_proveedor']; ?>"><?php echo $proveedor['nombre']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="producto">
                        <i class="fa-solid fa-tag"></i>
                        <select id="producto" name="producto" class="custom-select2">
                            
                        </select>
                    </div>
                    <div class="inputbox">
                        <i class="fa-solid fa-circle-plus"></i>
                        <input type="text" id="cantidad" name="cantidad" required>
                        <label for="cantidad">Cantidad</label>
                    </div>
                    <div class="inputbox">
                        <i class="fa-solid fa-piggy-bank"></i>
                        <input type="text" id="precio" name="precio" required>
                        <label for="precio">Precio de compra</label>
                    </div>
                    <button type="submit">Ingresar</button>
                </form>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        function validateForm() {
            const proveedorSelect = document.getElementById("proveedor");
            const selectedProveedor = proveedorSelect.value;
            const productoSelect = $('.custom-select2');
            const selectedProducto = productoSelect.val();

            if (selectedProveedor === "seleccione un proveedor") {
                alert("Por favor, seleccione un proveedor antes de enviar.");
                return false; // Evita que el formulario se envíe.
            } else if (selectedProducto === "" || selectedProducto === null) {
                alert("Por favor, seleccione un producto antes de enviar.");
                return false; // Evita que el formulario se envíe.
            }

            return true; // Permite que el formulario se envíe si se ha seleccionado un proveedor y un producto.
        }

        $(document).ready(function() {
            $('.custom-select2').select2({
                placeholder: 'Seleccione un producto',
                minimumInputLength: 1,
                ajax: {
                    url: '<?= site_url('CompraController/cargar_productos') ?>',
                    dataType: 'json',
                    processResults: function(data) {
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
<script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"crossorigin="anonymous">
</script>
</html>
<?php //require_once APPPATH . 'views/Dashboard/parteinferior.php'?>