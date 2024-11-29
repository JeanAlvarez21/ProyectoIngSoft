<?php include '../Controlador/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
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
        <h2 class="text-2xl font-semibold text-center mb-6">Registrar Nuevo Usuario</h2>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cedula = $_POST['cedula'];
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $email = $_POST['email'];
            $password = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);
            $id_rol = $_POST['id_rol'] ?: null; // Puede ser NULL
            $direccion_usuario = $_POST['direccion_usuario'];
            $telefono_usuario = $_POST['telefono_usuario'];

            // SQL corregido según la estructura de tu base de datos
            $sql = "INSERT INTO Usuarios (cedula, nombres, apellidos, email, contraseña, id_rol, direccion_usuario, telefono_usuario)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssisss", $cedula, $nombres, $apellidos, $email, $password, $id_rol, $direccion_usuario, $telefono_usuario);

            if ($stmt->execute()) {
                echo "<p class='text-green-500 font-bold'>Usuario registrado exitosamente.</p>";
            } else {
                echo "<p class='text-red-500 font-bold'>Error al registrar el usuario: " . $conn->error . "</p>";
            }
            $stmt->close();
        }
        ?>

        <form action="" method="POST" class="space-y-4">
            <div>
                <label for="cedula" class="block text-sm font-medium">Cédula</label>
                <input type="text" name="cedula" id="cedula" class="w-full border border-gray-300 p-2 rounded-md" required>
            </div>
            <div>
                <label for="nombres" class="block text-sm font-medium">Nombres</label>
                <input type="text" name="nombres" id="nombres" class="w-full border border-gray-300 p-2 rounded-md" required>
            </div>
            <div>
                <label for="apellidos" class="block text-sm font-medium">Apellidos</label>
                <input type="text" name="apellidos" id="apellidos" class="w-full border border-gray-300 p-2 rounded-md" required>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium">Email</label>
                <input type="email" name="email" id="email" class="w-full border border-gray-300 p-2 rounded-md" required>
            </div>
            <div>
                <label for="contraseña" class="block text-sm font-medium">Contraseña</label>
                <input type="password" name="contraseña" id="contraseña" class="w-full border border-gray-300 p-2 rounded-md" required>
            </div>
            <div>
                <label for="id_rol" class="block text-sm font-medium">Rol</label>
                <select name="id_rol" id="id_rol" class="w-full border border-gray-300 p-2 rounded-md">
                    <option value="1">Administrador</option>
                    <option value="2">Empleado</option>
                    <option value="3">Cliente</option>
                </select>
            </div>
            <div>
                <label for="direccion_usuario" class="block text-sm font-medium">Dirección</label>
                <input type="text" name="direccion_usuario" id="direccion_usuario" class="w-full border border-gray-300 p-2 rounded-md">
            </div>
            <div>
                <label for="telefono_usuario" class="block text-sm font-medium">Teléfono</label>
                <input type="text" name="telefono_usuario" id="telefono_usuario" class="w-full border border-gray-300 p-2 rounded-md">
            </div>
            <div class="text-center">
                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600">Registrar Usuario</button>
            </div>
        </form>
    </div>
</body>
</html>
