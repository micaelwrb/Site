<?php
session_start();

$servername = "127.0.0.1";
$username_db = "root";
$password_db = "";
$dbname = "usuarios_db";

// Conectar ao banco de dados
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verifique se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Consultar o banco de dados
    $sql = "SELECT * FROM dados WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verifica a senha usando password_verify
        if (password_verify($password, $row["password"])) {
            // Senha válida, você pode prosseguir com o restante do código
            $_SESSION['nome_usuario'] = $row['nome'];

            if ($row['tipo'] == 'administrador') {
                $_SESSION['tipo_usuario'] = 'administrador'; // Definir o tipo de usuário como administrador
                header("Location: pagina_administrador.php");
                exit();
            } else {
                header("Location: pagina_logada.php");
                exit();
            }
        } else {
            header("Location: pagina_erro.html?error=invalid_password");
            exit();
        }
    } else {
        header("Location: pagina_erro.html?error=user_not_found");
        exit();
    }
} else {
    header("Location: index.html");
    exit();
}

$conn->close();
?>
