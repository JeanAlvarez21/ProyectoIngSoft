<?php include '../Controlador/db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Productos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Cabecera -->
    <header class="bg-yellow-500 text-white shadow-lg">
        <div class="container mx-auto flex justify-between items-center p-4">
            <h1 class="text-xl font-bold">Gestión de Productos</h1>
            <nav class="space-x-4">
                <a href="index.php" class="hover:underline">Inicio</a>
                <a href="listar_productos.php" class="hover:underline">Productos</a>
                <a href="crear_producto.php" class="hover:underline">Nuevo Producto</a>
            </nav>
        </div>
    </header>

    <!-- Contenido principal -->
    <div class="container mx-auto mt-8 p-4 bg-white shadow-md rounded-md">
        <h2 class="text-2xl font-semibold text-center mb-6">Listado de Productos</h2>
        <a href="index.php" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 mb-4 inline-block">Regresar al Inicio</a>

        <?php
        $sql = "SELECT * FROM Productos";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table class='min-w-full table-auto border-collapse'>";
            echo "<thead><tr>
                    <th class='px-4 py-2 border-b text-left'>ID Producto</th>
                    <th class='px-4 py-2 border-b text-left'>Nombre</th>
                    <th class='px-4 py-2 border-b text-left'>Tipo</th>
                    <th class='px-4 py-2 border-b text-left'>Cantidad</th>
                    <th class='px-4 py-2 border-b text-left'>Precio Unitario</th>
                    <th class='px-4 py-2 border-b text-left'>Acciones</th>
                  </tr></thead><tbody>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td class='px-4 py-2 border-b'>{$row['id_producto']}</td>";
                echo "<td class='px-4 py-2 border-b'>{$row['nombre_producto']}</td>";
                echo "<td class='px-4 py-2 border-b'>{$row['tipo_producto']}</td>";
                echo "<td class='px-4 py-2 border-b'>{$row['cantidad_disponible']}</td>";
                echo "<td class='px-4 py-2 border-b'>{$row['precio_unitario']}</td>";
                echo "<td class='px-4 py-2 border-b'>
                        <a href='editar_producto.php?id={$row['id_producto']}' class='bg-yellow-500 text-white px-3 py-1 rounded-md hover:bg-yellow-600'>Editar</a>
                        <a href='eliminar_producto.php?id={$row['id_producto']}' class='bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 ml-2' onclick='return confirm(\"¿Seguro que quieres eliminar este producto?\");'>Eliminar</a>
                    </td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<div class='alert alert-warning'>No hay productos registrados.</div>";
        }
        ?>
    </div>

</body>
</html>
