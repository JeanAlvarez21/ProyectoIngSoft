<?php
include '../Controlador/db.php';

// Verificar si el ID del usuario está presente en la URL
if (isset($_GET['id'])) {
    $id_usuario = $_GET['id'];

    // Si el formulario de confirmación ha sido enviado, eliminar el usuario
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Consulta SQL para eliminar el usuario
        $sql = "DELETE FROM Usuarios WHERE id_usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_usuario);

        // Ejecutar la eliminación
        if ($stmt->execute()) {
            // Redirigir a la lista de usuarios después de eliminar
            header("Location: ver_usuarios.php");
            exit();
        } else {
            $error = "Error al eliminar el usuario: " . $conn->error;
        }
        $stmt->close();
    }
} else {
    $error = "ID de usuario no proporcionado.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Usuario</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <!-- Cabecera -->
    <header class="bg-yellow-500 text-white shadow-lg">
        <div class="container mx-auto flex justify-between items-center p-4">
            <h1 class="text-xl font-bold">Gestión de Usuarios</h1>
            <nav class="space-x-4">
                <a href="index.php" class="hover:underline">Inicio</a>
                <a href="ver_usuarios.php" class="hover:underline">Usuarios</a>
                <a href="crear_usuario.php" class="hover:underline">Nuevo Usuario</a>
            </nav>
        </div>
    </header>

    <!-- Contenido principal -->
    <div class="container mx-auto mt-8 p-4 bg-white shadow-md rounded-md">
        <h2 class="text-2xl font-semibold text-center mb-6">Confirmación de Eliminación</h2>

        <?php if (isset($error)): ?>
            <p class="text-red-500 font-bold text-center"><?php echo $error; ?></p>
        <?php endif; ?>

        <p class="text-center">¿Está seguro de que desea eliminar este usuario?</p>

        <!-- Formulario de confirmación -->
        <form action="" method="POST" class="text-center">
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Eliminar Usuario</button>
            <a href="ver_usuarios.php" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 ml-2">Cancelar</a>
        </form>
    </div>
</body>
</html>
