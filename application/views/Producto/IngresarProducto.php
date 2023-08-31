<?php require_once APPPATH . 'views/Dashboard/partesuperior.php' ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <link rel="stylesheet" href="<?php echo base_url('assets/producto/alta.css'); ?>">
        <title>Ingreso de producto</title>
    </head>
    <body>
        <section>
            <div class="form-box">
                <div class="form-value">
                    <h2>Ingresar Producto</h2>
                    <form id="userForm" action="<?= site_url('ProductoController/nuevoProducto') ?>" method="post" onsubmit="return validateForm()">
                        <div class="inputbox">
                            <i class="fa-solid fa-pen-to-square"></i>
                            <input type="text" id="editProducto" name="editProducto" required>
                            <label for="editProducto">nombre de Producto</label>
                        </div>
                        <div class="inputbox">
                            <i class="fa-solid fa-circle-plus"></i>
                            <input type="text" id="editExistencia" name="editExistencia" required>
                            <label for="editExistencia">Cantidad</label>
                        </div>
                        <div class="rol-select">
                            <div class="row-select">
                                <i class="fa-solid fa-caret-down"></i>
                            </div>
                            <i id= "icon-select" class="fa-solid fa-tags"></i>
                            <select id="editCategoria" name="editCategoria" required>
                                <option selected disabled>seleccione una categoria</option>
                                <?php foreach ($categorias as $categoria): ?>
                                <option value="<?php echo $categoria['id_categoria']; ?>"><?php echo $categoria['categoria']; ?></option>
                                <?php endforeach; ?>
                            </select>
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
                const categoriaSelect = document.getElementById("editCategoria");
                const selectedCategoria = categoriaSelect.value;

                if (selectedCategoria === "seleccione una categoria") {
                    alert("Por favor, seleccione una categoria antes de enviar.");
                    return false; 
                }

                return true;
            }
        </script>
        <script 
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"crossorigin="anonymous">
        </script>
    </body>
</html>