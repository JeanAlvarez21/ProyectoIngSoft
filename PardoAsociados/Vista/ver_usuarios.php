<?php include '../Controlador/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
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
        <h2 class="text-2xl font-semibold text-center mb-6">Lista de Usuarios</h2>
        <a href="index.php" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 mb-4 inline-block">Volver</a>

        <table class="min-w-full table-auto border-collapse">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b text-left">ID</th>
                    <th class="px-4 py-2 border-b text-left">Cédula</th>
                    <th class="px-4 py-2 border-b text-left">Nombres</th>
                    <th class="px-4 py-2 border-b text-left">Apellidos</th>
                    <th class="px-4 py-2 border-b text-left">Email</th>
                    <th class="px-4 py-2 border-b text-left">Rol</th>
                    <th class="px-4 py-2 border-b text-left">Teléfono</th>
                    <th class="px-4 py-2 border-b text-left">Dirección</th>
                    <th class="px-4 py-2 border-b text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Consulta para obtener los usuarios y sus roles
                $sql = "SELECT 
                            Usuarios.id_usuario, 
                            Usuarios.cedula, 
                            Usuarios.nombres,
                            Usuarios.apellidos, 
                            Usuarios.email, 
                            Roles.nombre_rol, 
                            Usuarios.telefono_usuario, 
                            Usuarios.direccion_usuario 
                        FROM Usuarios
                        LEFT JOIN Roles ON Usuarios.id_rol = Roles.id_rol";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td class='px-4 py-2 border-b'>{$row['id_usuario']}</td>
                            <td class='px-4 py-2 border-b'>{$row['cedula']}</td>
                            <td class='px-4 py-2 border-b'>{$row['nombres']}</td>
                            <td class='px-4 py-2 border-b'>{$row['apellidos']}</td>
                            <td class='px-4 py-2 border-b'>{$row['email']}</td>
                            <td class='px-4 py-2 border-b'>" . ($row['nombre_rol'] ?? 'Sin Rol') . "</td>
                            <td class='px-4 py-2 border-b'>{$row['telefono_usuario']}</td>
                            <td class='px-4 py-2 border-b'>{$row['direccion_usuario']}</td>
                            <td class='px-4 py-2 border-b'>
                                <a href='editar_usuario.php?id={$row['id_usuario']}' class='bg-yellow-500 text-white px-3 py-1 rounded-md hover:bg-yellow-600'>Editar</a>
                                <a href='eliminar_usuario.php?id={$row['id_usuario']}' class='bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 ml-2'>Eliminar</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8' class='px-4 py-2 border-b text-center'>No hay usuarios registrados</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
