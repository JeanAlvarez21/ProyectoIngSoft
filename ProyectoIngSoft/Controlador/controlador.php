<?php
require_once __DIR__ . '/../Modelo/usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear_usuario'])) {
    $nombre = trim($_POST['nombre'] ?? '');
    $correo = trim($_POST['correo'] ?? '');
    $contraseña = $_POST['contraseña'] ?? '';
    $rol = trim($_POST['rol'] ?? '');
    
    // Validaciones
    $errores = [];
    
    if (empty($nombre)) {
        $errores[] = "El nombre es requerido";
    }
    
    if (empty($correo) || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El correo no es válido";
    }
    
    if (empty($contraseña) || strlen($contraseña) < 6) {
        $errores[] = "La contraseña debe tener al menos 6 caracteres";
    }
    
    if (empty($rol)) {
        $errores[] = "El rol es requerido";
    }
    
    if (empty($errores)) {
        $usuario = new Usuario($nombre, $correo, $contraseña, $rol);
        $resultado = $usuario->guardar();
        
        if (strpos($resultado, 'éxito') !== false) {
            header("Location: ../Vista/lista_usuarios.php?mensaje=" . urlencode($resultado));
        } else {
            header("Location: ../Vista/crear_usuario.php?error=" . urlencode($resultado));
        }
    } else {
        header("Location: ../Vista/crear_usuario.php?errores=" . urlencode(implode(", ", $errores)));
    }
    exit;
}
?>