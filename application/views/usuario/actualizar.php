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
        <h1>Actualizar Usuario</h1>
    </header>    
    <main >
        
    <?php if ($usuario) { ?>
        <form action="<?php echo site_url('controlador/guardarCambios/' . $usuario->id_usuario); ?>" method="POST">
        <div>
        <label for="editUsuario">Nombre de Usuario:</label>
            <input type="text" id="editUsuario" name="editUsuario" value="<?php echo $usuario->usuario; ?>" placeholder="Ingrese el nombre de usuario">

        </div>
        <br>
        
        <label for="editRol">Rol:</label>
        <input type="text" id="editRol" name="editRol" value="<?php echo $usuario->rol; ?>" placeholder="Ingrese el rol del usuario">
        <br>
        <label for="editClave">Clave:</label>
        <input type="password" id="editClave" name="editClave" value="<?php echo $usuario->clave; ?>" placeholder="Ingrese la clave">

        <br>

            <button type="submit">Guardar Cambios</button>
        </form>
    <?php } else { ?>
        <p>No se encontró el usuario.</p>
    <?php } ?>
</main>
   
</body>
</html>
