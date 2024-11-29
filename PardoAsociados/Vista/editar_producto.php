<?php include '../Controlador/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <!-- Cabecera -->
    <header class="bg-yellow-500 text-white shadow-md">
        <div class="container mx-auto flex justify-between items-center p-4">
            <h1 class="text-xl font-bold">Gestión de Productos</h1>
            <nav class="space-x-4">
                <a href="index.php" class="hover:underline">Inicio</a>
                <a href="listar_productos.php" class="hover:underline">Lista de Productos</a>
            </nav>
        </div>
    </header>

    <!-- Contenido principal -->
    <div class="container mx-auto mt-8 p-4 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-semibold text-center mb-6">Editar Producto</h2>

        <?php
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $sql = "SELECT * FROM Productos WHERE id_producto = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            } else {
                echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded'>Producto no encontrado.</div>";
                exit;
            }
        } else {
            echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded'>ID no especificado.</div>";
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = htmlspecialchars($_POST['nombre_producto']);
            $tipo = htmlspecialchars($_POST['tipo_producto']);
            $cantidad = intval($_POST['cantidad_disponible']);
            $precio = floatval($_POST['precio_unitario']);
            $unidad = htmlspecialchars($_POST['unidad_medida']);
            $estado = htmlspecialchars($_POST['estado_rotacion']);

            $sql = "UPDATE Productos 
                    SET nombre_producto = ?, tipo_producto = ?, cantidad_disponible = ?, precio_unitario = ?, unidad_medida = ?, estado_rotacion = ?
                    WHERE id_producto = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssidssi", $nombre, $tipo, $cantidad, $precio, $unidad, $estado, $id);

            if ($stmt->execute()) {
                echo "<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded'>Producto actualizado correctamente.</div>";
            } else {
                echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded'>Error: " . $stmt->error . "</div>";
            }
        }
        ?>

        <!-- Formulario -->
        <form method="POST" class="space-y-4">
            <div>
                <label for="nombre_producto" class="block font-medium">Nombre del Producto</label>
                <input type="text" class="w-full px-3 py-2 border rounded-md" id="nombre_producto" name="nombre_producto" value="<?= htmlspecialchars($row['nombre_producto']) ?>" required>
            </div>
            <div>
                <label for="tipo_producto" class="block font-medium">Tipo de Producto</label>
                <input type="text" class="w-full px-3 py-2 border rounded-md" id="tipo_producto" name="tipo_producto" value="<?= htmlspecialchars($row['tipo_producto']) ?>" required>
            </div>
            <div>
                <label for="cantidad_disponible" class="block font-medium">Cantidad Disponible</label>
                <input type="number" class="w-full px-3 py-2 border rounded-md" id="cantidad_disponible" name="cantidad_disponible" value="<?= $row['cantidad_disponible'] ?>" required>
            </div>
            <div>
                <label for="precio_unitario" class="block font-medium">Precio Unitario</label>
                <input type="number" class="w-full px-3 py-2 border rounded-md" id="precio_unitario" name="precio_unitario" step="0.01" value="<?= $row['precio_unitario'] ?>" required>
            </div>
            <div>
                <label for="unidad_medida" class="block font-medium">Unidad de Medida</label>
                <input type="text" class="w-full px-3 py-2 border rounded-md" id="unidad_medida" name="unidad_medida" value="<?= htmlspecialchars($row['unidad_medida']) ?>" required>
            </div>
            <div>
                <label for="estado_rotacion" class="block font-medium">Estado de Rotación</label>
                <input type="text" class="w-full px-3 py-2 border rounded-md" id="estado_rotacion" name="estado_rotacion" value="<?= htmlspecialchars($row['estado_rotacion']) ?>" required>
            </div>
            <div class="flex justify-end space-x-4">
                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600">Actualizar Producto</button>
                <a href="listar_productos.php" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">Regresar</a>
            </div>
        </form>
    </div>
</body>
</html>
