<?php include '../Controlador/db.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Producto</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100">
    <!-- Cabecera -->
    <nav class="flex justify-between items-center px-6 py-0.1 bg-yellow-400 shadow-md">
        <div class="flex items-center">
            <img src="Media/Diseño sin título.jpg" alt="Logo" class="h-20 w-20 mr-3">
        </div>
        <div class="space-x-6">
            <a href="#" class="hover:underline font-semibold">Menú</a>
            <a href="#" class="hover:underline font-semibold">Productos</a>
            <a href="#" class="hover:underline font-semibold">Proyectos</a>
            <a href="#" class="hover:underline font-semibold">Carpinteros</a>
            <a href="#" class="hover:underline font-semibold">Contacto</a>
        </div>
        <div class="flex space-x-4">
            <button class="bg-white p-2 rounded-full shadow">
                <img src="Media/user_icon.jpeg" alt="User" class="h-5 w-5">
            </button>
            <button class="bg-white p-2 rounded-full shadow">
                <img src="Media/notify_icon.jpeg" alt="Settings" class="h-5 w-5">
            </button>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container mx-auto px-6 py-10">
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">Crear Nuevo Producto</h2>

        <!-- Mensajes PHP -->
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_producto = $_POST['id_producto'];
            $nombre_producto = $_POST['nombre_producto'];
            $tipo_producto = $_POST['tipo_producto'];
            $cantidad_disponible = $_POST['cantidad_disponible'];
            $precio_unitario = $_POST['precio_unitario'];
            $unidad_medida = $_POST['unidad_medida'];

            $sql = "INSERT INTO Productos (id_producto, nombre_producto, tipo_producto, cantidad_disponible, precio_unitario, unidad_medida)
                    VALUES ('$id_producto', '$nombre_producto', '$tipo_producto', '$cantidad_disponible', '$precio_unitario', '$unidad_medida')";

            if ($conn->query($sql) === TRUE) {
                echo "<div class='bg-green-100 text-green-800 p-4 rounded-md mb-4'>Producto creado correctamente</div>";
                echo "<a href='crear_inventario.php' class='bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600'>Volver al Inventario</a>";
            } else {
                echo "<div class='bg-red-100 text-red-800 p-4 rounded-md mb-4'>Error: " . $conn->error . "</div>";
            }
        }
        ?>

        <!-- Formulario para crear un producto -->
        <form method="POST" class="bg-white p-8 rounded-lg shadow-lg">
            <div class="mb-4">
                <label for="id_producto" class="block text-sm font-medium text-gray-700">ID Producto</label>
                <input type="number" id="id_producto" name="id_producto" class="mt-1 p-2 block w-full border border-gray-300 rounded-md focus:ring-yellow-500 focus:border-yellow-500" required>
            </div>
            <div class="mb-4">
                <label for="nombre_producto" class="block text-sm font-medium text-gray-700">Nombre del Producto</label>
                <input type="text" id="nombre_producto" name="nombre_producto" class="mt-1 p-2 block w-full border border-gray-300 rounded-md focus:ring-yellow-500 focus:border-yellow-500" required>
            </div>
            <div class="mb-4">
                <label for="tipo_producto" class="block text-sm font-medium text-gray-700">Tipo de Producto</label>
                <input type="text" id="tipo_producto" name="tipo_producto" class="mt-1 p-2 block w-full border border-gray-300 rounded-md focus:ring-yellow-500 focus:border-yellow-500" required>
            </div>
            <div class="mb-4">
                <label for="cantidad_disponible" class="block text-sm font-medium text-gray-700">Cantidad Disponible</label>
                <input type="number" id="cantidad_disponible" name="cantidad_disponible" class="mt-1 p-2 block w-full border border-gray-300 rounded-md focus:ring-yellow-500 focus:border-yellow-500" required>
            </div>
            <div class="mb-4">
                <label for="precio_unitario" class="block text-sm font-medium text-gray-700">Precio Unitario</label>
                <input type="number" id="precio_unitario" name="precio_unitario" step="0.01" class="mt-1 p-2 block w-full border border-gray-300 rounded-md focus:ring-yellow-500 focus:border-yellow-500" required>
            </div>
            <div class="mb-4">
                <label for="unidad_medida" class="block text-sm font-medium text-gray-700">Unidad de Medida</label>
                <input type="text" id="unidad_medida" name="unidad_medida" class="mt-1 p-2 block w-full border border-gray-300 rounded-md focus:ring-yellow-500 focus:border-yellow-500" required>
            </div>
            <div class="flex justify-between mt-6">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">Crear Producto</button>
                <a href="crear_inventario.php" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">Cancelar</a>
            </div>
        </form>
    </div>
</body>

</html>
