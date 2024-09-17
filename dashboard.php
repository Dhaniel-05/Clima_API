<?php
session_start();
// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Bienvenido a la aplicación climática</h1>

    <!-- Contenido del dashboard -->

    <!-- Formulario para cerrar sesión -->
    <form action="logout.php" method="post">
        <button type="submit">Cerrar sesión</button>
    </form>
</body>
</html>
