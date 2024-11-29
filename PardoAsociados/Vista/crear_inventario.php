<?php include '../Controlador/db.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar al Inventario</title>
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
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">Agregar al Inventario</h2>

        <!-- Mensajes PHP -->
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_producto = $_POST['id_producto'];
            $fecha_entrada = $_POST['fecha_entrada'];
            $cantidad_entrada = $_POST['cantidad_entrada'];
            $fecha_salida = $_POST['fecha_salida'] ?? null;
            $cantidad_salida = $_POST['cantidad_salida'] ?? 0;
            $ubicacion_almacen = $_POST['ubicacion_almacen'];

            $sql_check = "SELECT * FROM Productos WHERE id_producto = '$id_producto'";
            $result = $conn->query($sql_check);

            if ($result->num_rows == 0) {
                echo "<div class='bg-red-100 text-red-800 p-4 rounded-md mb-4'>El producto con ID $id_producto no existe. ¿Quieres crearlo?</div>";
            } else {
                $sql = "INSERT INTO Inventario (id_producto, fecha_entrada, cantidad_entrada, fecha_salida, cantidad_salida, ubicacion_almacen)
                        VALUES ('$id_producto', '$fecha_entrada', '$cantidad_entrada', " . ($fecha_salida ? "'$fecha_salida'" : "NULL") . ", '$cantidad_salida', '$ubicacion_almacen')";

                if ($conn->query($sql) === TRUE) {
                    echo "<div class='bg-green-100 text-green-800 p-4 rounded-md mb-4'>Registro agregado correctamente</div>";
                } else {
                    echo "<div class='bg-red-100 text-red-800 p-4 rounded-md mb-4'>Error: " . $conn->error . "</div>";
                }
            }
        }
        ?>

        <!-- Formulario -->
        <form method="POST" class="bg-white p-8 rounded-lg shadow-lg">
            <div class="mb-4">
                <label for="id_producto" class="block text-sm font-medium text-gray-700">ID Producto</label>
                <input type="number" id="id_producto" name="id_producto" class="mt-1 p-2 block w-full border border-gray-300 rounded-md focus:ring-yellow-500 focus:border-yellow-500" required>
            </div>
            <div class="mb-4">
                <label for="fecha_entrada" class="block text-sm font-medium text-gray-700">Fecha de Entrada</label>
                <input type="date" id="fecha_entrada" name="fecha_entrada" class="mt-1 p-2 block w-full border border-gray-300 rounded-md focus:ring-yellow-500 focus:border-yellow-500" required>
            </div>
            <div class="mb-4">
                <label for="cantidad_entrada" class="block text-sm font-medium text-gray-700">Cantidad Entrada</label>
                <input type="number" id="cantidad_entrada" name="cantidad_entrada" class="mt-1 p-2 block w-full border border-gray-300 rounded-md focus:ring-yellow-500 focus:border-yellow-500" required>
            </div>
            <div class="mb-4">
                <label for="fecha_salida" class="block text-sm font-medium text-gray-700">Fecha de Salida (opcional)</label>
                <input type="date" id="fecha_salida" name="fecha_salida" class="mt-1 p-2 block w-full border border-gray-300 rounded-md focus:ring-yellow-500 focus:border-yellow-500">
            </div>
            <div class="mb-4">
                <label for="cantidad_salida" class="block text-sm font-medium text-gray-700">Cantidad Salida (opcional)</label>
                <input type="number" id="cantidad_salida" name="cantidad_salida" class="mt-1 p-2 block w-full border border-gray-300 rounded-md focus:ring-yellow-500 focus:border-yellow-500">
            </div>
            <div class="mb-4">
                <label for="ubicacion_almacen" class="block text-sm font-medium text-gray-700">Ubicación del Almacén</label>
                <input type="text" id="ubicacion_almacen" name="ubicacion_almacen" class="mt-1 p-2 block w-full border border-gray-300 rounded-md focus:ring-yellow-500 focus:border-yellow-500" required>
            </div>

            <div class="flex justify-between mt-6">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">Agregar</button>
                <a href="crear_producto.php" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Crear Producto</a>
                <a href="index.php" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">Volver</a>
            </div>
        </form>
    </div>
</body>

</html>
