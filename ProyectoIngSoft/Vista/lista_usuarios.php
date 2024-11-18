<?php
require_once '../Modelo/usuario.php';

// Obtener página actual
$pagina = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
$porPagina = 10;

// Manejar eliminación
if (isset($_POST['eliminar'])) {
    $id = (int) $_POST['id'];
    if (Usuario::eliminar($id)) {
        header('Location: lista_usuarios.php?mensaje=' . urlencode('Usuario eliminado con éxito'));
        exit;
    }
}

// Obtener usuarios y total
$usuarios = Usuario::obtenerUsuarios($pagina, $porPagina);
$total = Usuario::contarUsuarios();
$totalPaginas = ceil($total / $porPagina);

// Mostrar mensaje de éxito si existe
if (isset($_GET['mensaje'])) {
    $mensaje = urldecode($_GET['mensaje']);
    echo "<div style='color: green; margin-bottom: 10px;'>$mensaje</div>";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f5f5f5;
        }

        .pagination {
            margin-top: 20px;
        }

        .pagination a {
            padding: 5px 10px;
            margin: 0 5px;
            border: 1px solid #ddd;
            text-decoration: none;
        }

        .pagination a.active {
            background-color: #4CAF50;
            color: white;
        }

        .button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
            margin-bottom: 20px;
        }

        /* Estilo específico para el botón de editar */
        .button-edit {
            background-color: #2196F3;
            color: white;
            cursor: pointer
            /* Asegura que el texto sea blanco */
        }

        /* Estilo específico para el botón de eliminar */
        .button-delete {
            background-color: #f44336;
            color: white;
            cursor: pointer
            /* Asegura que el texto sea blanco */
        }

        .actions {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            gap: 10px;
        }



        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: white;
            margin: 15% auto;
            padding: 20px;
            border-radius: 5px;
            width: 80%;
            max-width: 500px;
        }

        .close {
            float: right;
            cursor: pointer;
            font-size: 28px;
        }
    </style>
</head>

<body>
    <h1>Usuarios Registrados</h1>
    <a href="crear_usuario.php" class="button">Crear Nuevo Usuario</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?= htmlspecialchars($usuario['id']) ?></td>
                <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                <td><?= htmlspecialchars($usuario['correo']) ?></td>
                <td><?= htmlspecialchars($usuario['rol']) ?></td>
                <td class="actions">
                    <!-- Botón de editar -->
                    <form method="GET" action="editar_usuario.php" style="display: inline;">
                        <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
                        <button type="submit" class="button button-edit">Editar</button>
                    </form>

                    <!-- Botón de eliminar -->
                    <form method="POST" style="display: inline;"
                        onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
                        <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
                        <button type="submit" name="eliminar" class="button button-delete">Eliminar</button>
                    </form>
                </td>

            </tr>
        <?php endforeach; ?>
    </table>

    <?php if ($totalPaginas > 1): ?>
        <div class="pagination">
            <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                <a href="?pagina=<?= $i ?>" <?= $i === $pagina ? 'class="active"' : '' ?>><?= $i ?></a>
            <?php endfor; ?>
        </div>
    <?php endif; ?>
</body>

</html>