<?php
// Incluye la conexión a la base de datos
include('../Controlador/db.php');

session_start(); // Asegúrate de iniciar la sesión al inicio del script

// Inicializar mensaje de error
$error_mensaje = '';

// Si se envían los datos del primer formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombres']) && !isset($_POST['email'])) {
    // Almacenar temporalmente los datos del primer formulario en la sesión
    $_SESSION['nombres'] = trim($_POST['nombres']);
    $_SESSION['apellidos'] = trim($_POST['apellidos']);
    $_SESSION['direccion'] = trim($_POST['direccion']);
    $_SESSION['cedula'] = trim($_POST['cedula']);
    $_SESSION['telefono'] = trim($_POST['telefono']);
}

// Si se envían los datos del segundo formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    // Recuperar datos del primer formulario de la sesión
    $nombres = $_SESSION['nombres'];
    $apellidos = $_SESSION['apellidos'];
    $direccion = $_SESSION['direccion'];
    $cedula = $_SESSION['cedula'];
    $telefono = $_SESSION['telefono'];

    // Datos del segundo formulario
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validar que no haya campos vacíos
    if (empty($email) || empty($password)) {
        $error_mensaje = "Por favor, completa todos los campos.";
    } else {
        // Comprobar si el correo ya está registrado en la base de datos
        $sql = "SELECT COUNT(*) as total FROM usuarios WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row['total'] > 0) {
            // Define el mensaje de error
            $error_mensaje = "El correo electrónico ya está registrado. Por favor, utiliza otro.";
        } else {
            // Si el correo no está registrado, continúa con el registro
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $id_rol = 3;

            // Prepara la consulta SQL para insertar los datos
            $sql = "INSERT INTO usuarios (nombres, apellidos, direccion_usuario, cedula, telefono_usuario, email, contraseña, id_rol)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssssi", $nombres, $apellidos, $direccion, $cedula, $telefono, $email, $password_hash, $id_rol);

            // Ejecuta la consulta
            if ($stmt->execute()) {
                // Limpiar datos de sesión
                session_unset();
                session_destroy();

                // Redirige al login
                header("Location: login.php");
                exit();
            } else {
                $error_mensaje = "Error en el registro: " . $stmt->error;
            }
        }
    }

    // Cierra la declaración y la conexión
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrate</title>
    <link rel="stylesheet" href="CSS/styles_register2.css">
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

            <!-- Formulario de registro 2 -->
            <form action="register_2.php" method="POST">
                <!-- Datos recibidos del primer formulario -->
                <input type="hidden" name="nombres" value="<?php echo htmlspecialchars($_SESSION['nombres'] ?? ''); ?>">
                <input type="hidden" name="apellidos" value="<?php echo htmlspecialchars($_SESSION['apellidos'] ?? ''); ?>">
                <input type="hidden" name="direccion" value="<?php echo htmlspecialchars($_SESSION['direccion'] ?? ''); ?>">
                <input type="hidden" name="cedula" value="<?php echo htmlspecialchars($_SESSION['cedula'] ?? ''); ?>">
                <input type="hidden" name="telefono" value="<?php echo htmlspecialchars($_SESSION['telefono'] ?? ''); ?>">

                <!-- Formulario de correo y contraseña -->
                <label for="email">Correo Electrónico:</label>
                <input type="text" id="email" name="email" required>

                <label for="password">Contraseña:</label>
                <input type="text" id="password" name="password" required>

                <a> </a>
                <input type="submit" value="Finalizar Registro">
            </form>
        </div>
    </div>
</body>

</html>
