<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida</title>
    <link rel="stylesheet" href="CSS/styles_login_err.css">
</head>

<body>
    <div class="container">
        <!-- Mitad izquierda -->
        <div class="left">
        <h2>Juntos transformamos<br>la madera</h2>
            <img src="Media/fondo-home 3.png" alt="Imagen de la empresa">
            
        </div>

        <!-- Mitad derecha -->
        <div class="right">
            <header>
                <h1>Inicia sesión</h1>
                <p>Si ya eres miembro, puedes iniciar sesión con tu dirección de correo electrónico y contraseña.</p>
                <div class="ms_err"> <p>*Usuario o contraseña incorrectos, por favor intente de nuevo*</p></div>
               
            </header>                                       

            <form action="../Controlador/controlador_login.php" method="POST">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>

                <!--<div class="checkbox-container">
                    <label for="remember">Recuerdame: </label>
                    <input type="checkbox" id="remember" name="remember">
                </div>
                -->

                <input type="submit" value="Iniciar Sesión">
                <a href="register_1.php">No tienes una cuenta? Regístrate aquí.</a>
            </form>
        </div>
    </div>
</body>

</html>

