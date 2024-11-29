
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Inventario</title>
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
        <div class="flex space-x-4">
            <button class="bg-white p-2 rounded-full shadow">
                <img src="Media/user_icon.jpeg" alt="User" class="h-5 w-5">
            </button>
            <button class="bg-white p-2 rounded-full shadow">
                <img src="Media/notify_icon.jpeg" alt="Settings" class="h-5 w-5">
            </button>
            <form action="logout.php" method="post" class="inline">
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 shadow">
                    Logout
                </button>
            </form>
        </div>
    </nav>

</html>

<?php 
    echo "Bienvenido al dashboard de clientes";
?>