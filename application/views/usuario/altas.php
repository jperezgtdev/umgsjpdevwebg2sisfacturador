
<?php require_once APPPATH . 'views/Dashboard/partesuperior.php'?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
            integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
            crossorigin="anonymous">

            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
            
    <link rel="stylesheet" href="<?php echo base_url('assets/usuario/alta.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/usuario/consulta.css'); ?>">

    <title>Formulario de Creación de Usuario</title>
</head>
<header>
        <h1>Registro de Usuario</h1>
    </header>
<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <h2>Crear Usuario</h2>
                <form id="userForm" action="<?= site_url('AltasUsuarioController/crear_usuario') ?>" method="post" onsubmit="return validateForm()">
                    <div class="inputbox">
                        <i class="fa-solid fa-person"></i>
                        <input type="text" id="person" name="person" required>
                        <label for="username">Nombre de Empleado</label>
                    </div>
                    <div class="inputbox">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" id="username" name="username" required>
                        <label for="username">Nombre de Usuario</label>
                    </div>
                    <div class="inputbox">
                        <i class="fa-solid fa-key"></i>
                        <input type="password" id="password" name="password" required>
                        <label for="password">Contraseña</label>
                    </div>
                    <div class="inputbox">
                        <i class="fa-solid fa-key"></i>
                        <input type="password" id="confirm_password" name="confirm_password" required>
                        <label for="confirm_password">Confirmar Contraseña</label>
                    </div>
                    <div class="rol-select">
                        <div class="row-select">
                            <i class="fa-solid fa-caret-down"></i>
                        </div>
                        <i id= "icon-select" class="fa-solid fa-users"></i>
                        <select id="role" name="role" required>
                            <option selected disabled>seleccione un rol</option>
                            <option value="administrador">Administrador</option>
                            <option value="usuario">Usuario</option>
                        </select>
                        
                    </div>
                    <button type="submit">Crear Usuario</button>
                </form>
            </div>
        </div>
    </section>
    <script>
        function validateForm() {
            const roleSelect = document.getElementById("role");
            const selectedRole = roleSelect.value;

            if (selectedRole === "seleccione un rol") {
                alert("Por favor, seleccione un rol antes de enviar.");
                return false; 

            return true;
        }
    </script>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</html>
