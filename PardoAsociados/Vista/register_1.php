<?php
// Incluye la conexión a la base de datos
include('../Controlador/db.php');

// Inicia la sesión al principio
session_start();

// Variable para almacenar mensajes de error
$error_mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombres'])) {
    // Recibir datos del formulario
    $nombres = trim($_POST['nombres']);
    $apellidos = trim($_POST['apellidos']);
    $direccion = trim($_POST['direccion']);
    $cedula = trim($_POST['cedula']);
    $telefono = trim($_POST['telefono']);

    // Validar datos básicos
    if (empty($nombres) || empty($apellidos) || empty($direccion) || !is_numeric($cedula) || !is_numeric($telefono)) {
        $error_mensaje = "Por favor, revisa los datos ingresados.";
    } else {
        // Comprobar si la cédula ya existe en la base de datos
        $sql = "SELECT COUNT(*) as total FROM usuarios WHERE cedula = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $cedula);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row['total'] > 0) {
            $error_mensaje = "La cédula ya está registrada. Por favor, intenta con otra.";
        } else {
            // Si la cédula no existe, guarda los datos en la sesión
            $_SESSION['nombres'] = $nombres;
            $_SESSION['apellidos'] = $apellidos;
            $_SESSION['direccion'] = $direccion;
            $_SESSION['cedula'] = $cedula;
            $_SESSION['telefono'] = $telefono;

            // Solo redirige si no hay errores
            header("Location: register_2.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrate</title>
    <link rel="stylesheet" href="CSS/styles_register1.css">
</head>

<body>
    <div class="container">
        <!-- Mitad izquierda -->
        <div class="left">
            <h2>Juntos transformamos<br>la madera</h2>
            <img src="Media/fondo-home 3.png" alt="Imagen de la empresa">
        </div>

        <!-- Mitad derecha -->
        <div class="right">
            <header>
                <h1>Regístrate!</h1>
            </header>

            <?php 
            // Mostrar mensaje de error si existe
            if (!empty($error_mensaje)) {
                echo "<div class='error-message' style='color: red; margin-bottom: 15px;'>$error_mensaje</div>";
            }
            ?>
            
            <form action="" method="POST">

                <label for="nombres">Nombres:</label>
                <input type="text" id="nombres" name="nombres" required>

                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" required>

                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" required>

                <label for="cedula">Cédula de Identidad:</label>
                <input type="text" id="cedula" name="cedula" required>

                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" required>

                <a> </a>

                <input type="submit" value="Siguiente">
            </form>
        </div>
    </div>
</body>

</html>
