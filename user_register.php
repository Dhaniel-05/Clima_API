<?php
// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'sistema_clima');

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar formulario de registro
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_usuario = htmlspecialchars($_POST['nombre_usuario']); // Protección contra XSS
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash de la contraseña

    // Verificar si el usuario ya existe
    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "El correo electrónico ya está registrado.";
    } else {
        // Insertar nuevo usuario
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre_usuario, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $nombre_usuario, $email, $password);

        if ($stmt->execute()) {
            echo "Usuario registrado con éxito.";
        } else {
            echo "Error en el registro.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
</head>
<body>
    <h2>Registro de Usuario</h2>
    <form method="POST" action="user_register.php">
        <label for="nombre_usuario">Nombre de Usuario:</label>
        <input type="text" name="nombre_usuario" required>
        <br>
        <label for="email">Correo Electrónico:</label>
        <input type="email" name="email" required>
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit">Registrarse</button>
    </form>
</body>
</html>
