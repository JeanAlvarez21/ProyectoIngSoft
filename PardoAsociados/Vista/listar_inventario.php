<?php include '../Controlador/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Inventario</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <!-- Cabecera -->
    <header class="bg-yellow-500 text-white shadow-lg">
        <div class="container mx-auto flex justify-between items-center p-4">
            <h1 class="text-xl font-bold">Gestión de Inventario</h1>
            <nav class="space-x-4">
                <a href="index.php" class="hover:underline">Inicio</a>
                <a href="listar_inventario.php" class="hover:underline">Inventario</a>
                <a href="crear_inventario.php" class="hover:underline">Nuevo Inventario</a>
            </nav>
        </div>
    </header>

    <!-- Contenido principal -->
    <div class="container mx-auto mt-8 p-4 bg-white shadow-md rounded-md">
        <h2 class="text-2xl font-semibold text-center mb-6">Inventario</h2>
        <a href="index.php" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 mb-4 inline-block">Volver</a>
        
        <table class="min-w-full table-auto border-collapse">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b text-left">ID Inventario</th>
                    <th class="px-4 py-2 border-b text-left">ID Producto</th>
                    <th class="px-4 py-2 border-b text-left">Fecha Entrada</th>
                    <th class="px-4 py-2 border-b text-left">Cantidad Entrada</th>
                    <th class="px-4 py-2 border-b text-left">Ubicación</th>
                    <th class="px-4 py-2 border-b text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM Inventario";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td class='px-4 py-2 border-b'>{$row['id_inventario']}</td>
                            <td class='px-4 py-2 border-b'>{$row['id_producto']}</td>
                            <td class='px-4 py-2 border-b'>{$row['fecha_entrada']}</td>
                            <td class='px-4 py-2 border-b'>{$row['cantidad_entrada']}</td>
                            <td class='px-4 py-2 border-b'>{$row['ubicacion_almacen']}</td>
                            <td class='px-4 py-2 border-b'>
                                <a href='editar_inventario.php?id={$row['id_inventario']}' class='bg-yellow-500 text-white px-3 py-1 rounded-md hover:bg-yellow-600'>Editar</a>
                                <a href='eliminar_inventario.php?id={$row['id_inventario']}' class='bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 ml-2'>Eliminar</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='px-4 py-2 border-b text-center'>No hay registros</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
