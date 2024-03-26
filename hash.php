<?php
$servername = "127.0.0.1";
$username_db = "root";
$password_db = "";
$dbname = "usuarios_db";

// Conectar ao banco de dados
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Senha que você deseja inserir no banco de dados
$senha_original = "inquilino123";

// Hash da senha usando password_hash
$senha_hasheada = password_hash($senha_original, PASSWORD_DEFAULT);

// Inserir usuário com a senha hasheada no banco de dados
$sql = "INSERT INTO dados (username, password, tipo, nome) VALUES ('inquilino', '$senha_hasheada', 'normal', 'Fulano')";
$result = $conn->query($sql);

if ($result) {
    echo "Senha hasheada e inserida no banco de dados com sucesso!";
} else {
    echo "Erro ao inserir no banco de dados: " . $conn->error;
}

$conn->close();
?>
