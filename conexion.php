<?php
// db_config.php
$servername = "localhost";
$username = "root"; // por defecto en XAMPP o MAMP
$password = ""; // por defecto, es vacío
$dbname = "sistema_clima";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Configura PDO para que arroje excepciones en caso de error
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}
?>
