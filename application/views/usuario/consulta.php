<!DOCTYPE html>
<html>

<head>
    <style>
        /* Estilos generales */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
 
    flex-direction: column;
    min-height: 100vh; /* Asegura que el contenido ocupe al menos el 100% del viewport */
}

header {
    background-color: #1d3557;
    color: #fff;
    padding: 10px;
    text-align: center;
}

main {
    flex: 1; /* Permite que el contenido ocupe el espacio disponible restante */
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

footer {
    text-align: center;
    padding: 10px;
    background-color: #1d3557;
    color: #fff;
    position: fixed; /* Mantiene el footer fijo en la parte inferior de la pantalla */
    bottom: 0;
    left: 0;
    width: 100%;
}

/* Formulario */
form {

    flex-wrap: wrap;
    justify-content: space-between;
    margin-bottom: 20px;
}

label,
input,
button {
    margin-bottom: 10px;
    
}

input[type="text"] {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    padding: 8px 15px;
    background-color: #1d3557;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

/* Lista de usuarios */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    padding: 10px;
    border-bottom: 1px solid #1d3557;
    text-align: center;
}

thead {
    background-color: #f1faee;
}

.user-item td:last-child {
    display: flex;
    gap: 10px;
}

.edit-btn,
.delete-btn {
    padding: 6px 12px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.edit-btn {
    background-color: #007bff;
    color: #fff;
}

.delete-btn {
    background-color: #dc3545;
    color: #fff;
}

/* Otros estilos */
h1 {
    margin-top: 0;
}

p {
    margin: 0;
}

.td_boton {
    text-align: center; /* Alinea el contenido a la derecha */
}
    </style>
    <link rel="stylesheet" href= "css/consulta.css"> 
    <title>Consulta de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous">
</head>

<body>
    <header>
        <h1>Consulta de Usuarios</h1>
    </header>
    <main>
	<form class="form-group" action=" method="post">
            <label for="firstName">Nombre:</label>
            <input type="text" id="firstName" name="firstName" placeholder="Ingrese el nombre">
            <button type="submit">Buscar</button>
        </form>
        <br>
        <div id="userList">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>
                            <i class="fa-solid fa-user fa-lg" style="color: #e63946;"></i>
                            Nombre
                        </th>
                        <th><i class="fa-solid fa-users-gear fa-lg" style="color: #e63946;"></i>
                            Rol</th>
                        <th>
                        <i class="fa-solid fa-lock" style="color: #e63946;"></i>
                            Contraseña</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($prueba_data as $row): ?>
            <tr>
            <td><?php echo $row->usuario; ?></td>

                <td><?php echo $row->rol; ?></td>
                <td><?php echo $row->clave; ?></td>
                <td class="td_boton">


                <a href="<?= site_url('controlador/obtenerDatos/' . $row->id_usuario); ?>" class="edit-btn">Editar</a>



                            <button class="delete-btn">Eliminar</button>
                        
            </tr>
         <?php endforeach; ?> 
                  
                    
                    
                </tbody>
            </table>
        </div>

        
    </div>
 
    </main>
    <footer>
        <p>Consulta de Usuarios</p>
    </footer>

</body>

</html>