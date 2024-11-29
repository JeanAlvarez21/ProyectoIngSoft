<?php include '../Controlador/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Inventario</title>
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
                <a href="crear_producto.php" class="hover:underline">Productos</a>
            </nav>
        </div>
    </header>

    <!-- Contenido principal -->
    <div class="container mx-auto mt-8 p-4 bg-white shadow-md rounded-md">
        <h2 class="text-2xl font-semibold text-center mb-6">Editar Inventario</h2>

        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $sql = "SELECT * FROM Inventario WHERE id_inventario = $id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            } else {
                echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded'>Registro no encontrado</div>";
                exit;
            }
        } else {
            echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded'>ID no especificado</div>";
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_producto = $_POST['id_producto'];
            $fecha_entrada = $_POST['fecha_entrada'];
            $cantidad_entrada = $_POST['cantidad_entrada'];
            $ubicacion_almacen = $_POST['ubicacion_almacen'];

            $sql = "UPDATE Inventario 
                    SET id_producto = '$id_producto', fecha_entrada = '$fecha_entrada', cantidad_entrada = '$cantidad_entrada', ubicacion_almacen = '$ubicacion_almacen'
                    WHERE id_inventario = $id";

            if ($conn->query($sql) === TRUE) {
                echo "<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded'>Registro actualizado correctamente</div>";
            } else {
                echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded'>Error: " . $conn->error . "</div>";
            }
        }
        ?>

        <!-- Formulario -->
        <form method="POST" class="space-y-4">
            <div>
                <label for="id_producto" class="block font-medium">ID Producto</label>
                <input type="number" class="w-full px-3 py-2 border rounded-md" id="id_producto" name="id_producto" value="<?= $row['id_producto'] ?>" required>
            </div>
            <div>
                <label for="fecha_entrada" class="block font-medium">Fecha de Entrada</label>
                <input type="date" class="w-full px-3 py-2 border rounded-md" id="fecha_entrada" name="fecha_entrada" value="<?= $row['fecha_entrada'] ?>" required>
            </div>
            <div>
                <label for="cantidad_entrada" class="block font-medium">Cantidad Entrada</label>
                <input type="number" class="w-full px-3 py-2 border rounded-md" id="cantidad_entrada" name="cantidad_entrada" value="<?= $row['cantidad_entrada'] ?>" required>
            </div>
            <div>
                <label for="ubicacion_almacen" class="block font-medium">Ubicación</label>
                <input type="text" class="w-full px-3 py-2 border rounded-md" id="ubicacion_almacen" name="ubicacion_almacen" value="<?= $row['ubicacion_almacen'] ?>" required>
            </div>
            <div class="flex justify-between">
                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600">Actualizar</button>
                <a href="listar_inventario.php" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>
