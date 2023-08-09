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
        <h1>Manejo de Productos</h1>
    </header>
    <main>
    <?php if ($producto) { ?>
        
            <form action="<?php echo site_url('ProductoController/guardarCambios/' . $producto->id_producto); ?>" method="POST">
                <div>
                    <label for="editProducto">Nombre de Producto:</label>
                    <input type="text" id="editProducto" name="editProducto" value="<?php echo $producto->producto; ?>" placeholder="Ingrese producto">
                </div>
                <br>
                <div>
                    <i id="icon-select" class="fa-solid fa-users"></i>
                    <select id="editCategoria" name="editCategoria" required>
                        <option disabled>Elegir Categoria</option>
                        <option value="Libro" <?php if ($producto->id_categoria == 1) echo 'selected'; ?>>Libros</option>
                        
                    </select>      
                </div>
                <br>
                <div>
                    <label for="editExistencia">Ingrese clave actual</label>
                    <input type="text" id="editExistencia" name="editExistencia" value="<?php echo $producto->existencia; ?>" placeholder="Ingrese producto">

                </div>
                <br>
             
                <button type="submit" class="rounded-button">Guardar Cambios</button>
            </form>
        <?php } else { ?>
            <p>No se encontró el usuario.</p>
        <?php } ?>

        <!-- Formulario para modificar un producto -->
        

    
    </main>
</body>
</html>