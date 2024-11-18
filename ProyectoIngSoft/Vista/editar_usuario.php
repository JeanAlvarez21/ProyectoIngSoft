<?php
require_once '../Modelo/usuario.php';

// Verificar si se proporcionó un ID
if (!isset($_GET['id'])) {
    header('Location: lista_usuarios.php');
    exit;
}

$id = (int)$_GET['id'];
$usuario = Usuario::obtenerPorId($id);

if (!$usuario) {
    header('Location: lista_usuarios.php');
    exit;
}

// Procesar el formulario de actualización
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $rol = $_POST['rol'];
    
    // La contraseña es opcional en la actualización
    $contraseña = !empty($_POST['contraseña']) ? $_POST['contraseña'] : null;
    
    if (Usuario::actualizar($id, $nombre, $correo, $contraseña, $rol)) {
        header('Location: lista_usuarios.php?mensaje=' . urlencode('Usuario actualizado con éxito'));
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
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
        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .button-secondary {
            background-color: #666;
        }
    </style>
</head>
<body>
    <h1>Editar Usuario</h1>
    
    <form method="POST">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>
        </div>
        
        <div class="form-group">
            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" value="<?= htmlspecialchars($usuario['correo']) ?>" required>
        </div>
        
        <div class="form-group">
            <label for="contraseña">Contraseña (dejar en blanco para mantener la actual):</label>
            <input type="password" id="contraseña" name="contraseña">
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
        
        <div class="form-group">
            <button type="submit" class="button">Guardar Cambios</button>
            <a href="lista_usuarios.php" class="button button-secondary">Cancelar</a>
        </div>
    </form>
</body>
</html>