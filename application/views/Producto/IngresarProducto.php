<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('assets/producto/consulta.css'); ?>">
    <title>Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="crossorigin="anonymous">

    <title>Manejo de Productos</title>
</head>
<body>
<?php $this->load->view('navbar'); ?>
    <header>
        <h1>Agregar de Productos</h1>
    </header>
    <main>
    <section>
    <div class="form-box">
        <div class="form-value">
            <h2>Ingreso de producto</h2>
            <form id="userForm" action="<?= site_url('ProductoController/nuevoProducto') ?>" method="post">
                <div>
                    <label for="editProducto">Nombre de Producto:</label>
                    <input type="text" id="editProducto" name="editProducto" required placeholder="Ingrese producto">
                </div>
                <br>
                <div>
                    <i id="icon-select" class="fa-solid fa-users"></i>
                    <select id="editCategoria" name="editCategoria" required>
                        <option disabled selected>Elegir Categoría</option>
                        <option value="1">Libros</option>
                        <!-- Otras opciones de categoría si las tienes -->
                    </select>
                </div>
                <br>
                <div>
                    <label for="editExistencia">Ingrese la existencia:</label>
                    <input type="text" id="editExistencia" name="editExistencia" required placeholder="Ingrese la cantidad">
                </div>
                <br>
                <button type="submit">Crear Producto</button>
            </form>
        </div>
    </div>
</section>


        

    
    </main>
</body>
</html>