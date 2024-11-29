<?php
// Incluye la conexión a la base de datos
include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtén los datos del formulario
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Consulta para verificar al usuario
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();

        // Verifica la contraseña
        if (password_verify($password, $usuario['contraseña'])) {
            // Redirige según el rol del usuario
            $id_rol = $usuario['id_rol'];

            switch ($id_rol) {
                case 1: // Administrador
                    header("Location: ../Vista/index.php");
                    break;
                case 2: // Empleado
                    header("Location: ../Vista/index_empleado.php");
                    break;
                case 3: // Cliente
                    header("Location: ../Vista/index_cliente.php");
                    break;
                default:
                    echo "Rol no reconocido.";
                    break;
            }
            exit();
        } else {
            // Contraseña incorrecta
            header("Location: ../Vista/login_err.php");
            exit();
        }
    } else {
        // Usuario no encontrado
        echo "No existe un usuario con ese correo.";
    }

    // Cierra la declaración y la conexión
    $stmt->close();
    $conn->close();
}
?>
