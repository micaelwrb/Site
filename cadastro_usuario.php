<?php
include 'conexao.php';

// Mensagem inicial vazia
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cpf = $_POST["cpf"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $data_entrada = $_POST["data_entrada"];
    $data_saida = $_POST["data_saida"];
    $situacao = $_POST["situacao"];
    $ativo = $_POST["ativo"];
    $valor_aluguel = $_POST["valor_aluguel"];
    $senha_visivel = $_POST["senha"]; // Senha visível
    $observacoes = $_POST["observacoes"];

    // Criptografar a senha visível para armazenamento seguro no banco de dados
    $senha_hash = password_hash($senha_visivel, PASSWORD_DEFAULT);

    // Verificar se o CPF já está cadastrado
    $sql_check_cpf = "SELECT * FROM cadastro_inquilinos WHERE cpf = '$cpf'";
    $result_check_cpf = $conn->query($sql_check_cpf);

    if ($result_check_cpf->num_rows > 0) {
        $msg = "CPF já cadastrado. Por favor, escolha outro CPF.";
    } else {
        // Inserir os dados na tabela cadastro_inquilinos
        $sql_insert = "INSERT INTO cadastro_inquilinos (cpf, nome, telefone, email, data_entrada, data_saida, situacao, ativo, valor_aluguel, senha_visivel, senha_hash, observacoes) 
                       VALUES ('$cpf', '$nome', '$telefone', '$email', '$data_entrada', '$data_saida', '$situacao', '$ativo', '$valor_aluguel', '$senha_visivel', '$senha_hash', '$observacoes')";

        if ($conn->query($sql_insert) === TRUE) {
            $msg = "Inquilino cadastrado com sucesso!";
        } else {
            $msg = "Erro ao cadastrar inquilino: " . $conn->error;
        }
    }
}

$conn->close();

?>
