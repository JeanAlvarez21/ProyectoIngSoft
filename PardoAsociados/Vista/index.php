<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Inventario y Usuarios</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }

        .navbar {
            background-color: #ffc107;
        }

        .navbar a {
            color: #000;
            font-weight: 600;
        }

        .navbar a:hover {
            text-decoration: underline;
        }

        .btn-primary {
            background-color: #343a40;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #495057;
        }
    </style>
</head>

<body class="bg-gray-100">
    <!-- Cabecera -->
    <nav class="navbar flex justify-between items-center px-6 py-0.1 shadow-md">
        <div class="flex items-center">
            <img src="Media/Diseño sin título.jpg" alt="Logo" class="h-20 w-20 mr-3">
        </div>
        <div class="space-x-6">
            <a href="#" class="hover:underline">Menú</a>
            <a href="#" class="hover:underline">Productos</a>
            <a href="#" class="hover:underline">Proyectos</a>
            <a href="#" class="hover:underline">Carpinteros</a>
            <a href="#" class="hover:underline">Contacto</a>
        </div>
        <div class="flex items-center space-x-4">
            <button class="bg-white p-2 rounded-full shadow">
                <img src="Media/user_icon.jpeg" alt="User" class="h-5 w-5">
            </button>
            <button class="bg-white p-2 rounded-full shadow">
                <img src="Media/notify_icon.jpeg" alt="Settings" class="h-5 w-5">
            </button>
            <!-- Botón de Logout -->
            <form action="logout.php" method="post" class="inline">
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 shadow">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container mx-auto px-4 py-8">
        <!-- Gestión de Inventario -->
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Gestión de Inventario</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <a href="listar_inventario.php" class="block bg-yellow-100 hover:bg-yellow-200 p-6 rounded-lg shadow text-center">
                <h3 class="text-lg font-bold text-gray-800">Listar Inventario</h3>
                <p class="text-gray-600 mt-2">Consulta y gestiona todos los elementos en inventario.</p>
            </a>
            <a href="listar_productos.php" class="block bg-blue-100 hover:bg-blue-200 p-6 rounded-lg shadow text-center">
                <h3 class="text-lg font-bold text-gray-800">Listar Productos</h3>
                <p class="text-gray-600 mt-2">Revisa la lista completa de productos disponibles.</p>
            </a>
            <a href="crear_inventario.php" class="block bg-green-100 hover:bg-green-200 p-6 rounded-lg shadow text-center">
                <h3 class="text-lg font-bold text-gray-800">Agregar al Inventario</h3>
                <p class="text-gray-600 mt-2">Añade nuevos productos o materiales al inventario.</p>
            </a>
        </div>

        <!-- Gestión de Usuarios -->
        <h2 class="text-2xl font-bold text-gray-800 mb-6 mt-10 text-center">Gestión de Usuarios</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <a href="ver_usuarios.php" class="block bg-purple-100 hover:bg-purple-200 p-6 rounded-lg shadow text-center">
                <h3 class="text-lg font-bold text-gray-800">Ver Usuarios</h3>
                <p class="text-gray-600 mt-2">Consulta la lista de usuarios registrados en el sistema.</p>
            </a>
            <a href="crear_usuarios.php" class="block bg-teal-100 hover:bg-teal-200 p-6 rounded-lg shadow text-center">
                <h3 class="text-lg font-bold text-gray-800">Crear Usuario</h3>
                <p class="text-gray-600 mt-2">Añade nuevos usuarios al sistema de gestión.</p>
            </a>
        </div>
    </div>
</body>

</html>
