<?php
// Mostrar errores si existen
if (isset($_GET['error'])) {
    $error = urldecode($_GET['error']);
    echo "<div style='color: red; margin-bottom: 10px;'>$error</div>";
}
if (isset($_GET['errores'])) {
    $errores = urldecode($_GET['errores']);
    echo "<div style='color: red; margin-bottom: 10px;'>$errores</div>";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Crear Usuario</h1>
    <form action="../Controlador/controlador.php" method="POST">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>

        <div class="form-group">
            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" required>
        </div>

        <div class="form-group">
            <label for="contraseña">Contraseña:</label>
            <input type="password" id="contraseña" name="contraseña" required>
        </div>

        <div class="form-group">
            <label for="rol">Rol:</label>
            <select id="rol" name="rol" required>
                <option value="">Seleccione un rol</option>
                <option value="cliente">Cliente</option>
                <option value="administrador">Administrador</option>
                <option value="supervisor">Supervisor</option>
            </select>
        </div>

        <button type="submit" name="crear_usuario">Crear Usuario</button>
    </form>
    <p><a href="lista_usuarios.php">Ver lista de usuarios</a></p>
</body>
</html>