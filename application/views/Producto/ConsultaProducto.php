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
       
        <!-- Lista de productos -->
        <h2>Lista de Productos</h2>
        <div id="userList">
            <table class="table table-hover table-striped">
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
                        <td><?php echo $row->producto; ?></td>
                        <td><?php echo $row->existencia; ?></td>
                        <td><?php echo $row->categoria; ?></td>
                        <td class="td_boton">
                        <a href="<?= site_url('ProductoController/obtenerDatos/' . $row->id_producto); ?>" class="edit-btn">Editar</a>
                            
                            <a href="" class="delete-btn">Eliminar</a>

                        </td>       
                    </tr>
                    <?php endforeach; ?> 
                </tbody>
            </table>
        </div>


        <!-- Formulario para modificar un producto -->
        

        <form>
            <button type="submit">Agregar Producto</button>
        </form>
    </main>
</body>
</html>
