<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('assets/producto/consulta.css'); ?>">
    <title>Consulta de Usuarios</title>
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
        <!-- Formulario para ingresar un producto -->
        <form>
            <h2>Ingresar Producto</h2>
            <label for="productName">Nombre del Producto:</label>
            <input type="text" id="productName" name="productName" placeholder="Ingrese el nombre del producto">
            <button type="submit">Agregar</button>
        </form>

        <!-- Lista de productos -->
        <h2>Lista de Productos</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Producto 1</td>
                    <td>
                        <button class="edit-btn">Editar</button>
                        <button class="delete-btn">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Producto 2</td>
                    <td>
                        <button class="edit-btn">Editar</button>
                        <button class="delete-btn">Eliminar</button>
                    </td>
                </tr>
                <!-- Más filas de productos aquí -->
            </tbody>
        </table>

        <!-- Formulario para modificar un producto -->
        <form>
            <h2>Modificar Producto</h2>
            <label for="editProductName">Nuevo Nombre:</label>
            <input type="text" id="editProductName" name="editProductName" placeholder="Ingrese el nuevo nombre del producto">
            <button type="submit">Guardar Cambios</button>
        </form>
    </main>
</body>
</html>
