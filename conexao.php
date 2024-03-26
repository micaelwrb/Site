<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "usuarios_db"; // Alterado para o nome do seu banco de dados

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
