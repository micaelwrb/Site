<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cpf_pesquisa = $_POST["cpf_pesquisa"];

    $sql = "SELECT * FROM cadastro_inquilinos WHERE cpf = '$cpf_pesquisa'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Exibe os resultados da pesquisa
        echo "<h3>Resultados da Pesquisa:</h3>";
        while ($row = $result->fetch_assoc()) {
            echo "<p>Nome: " . $row["nome"] . "</p>";
            echo "<p>Email: " . $row["email"] . "</p>";
            echo "<p>Telefone: " . $row["telefone"] . "</p>";
            echo "<p>Senha: " . $row["senha_visivel"] . "</p>";
        }
    } else {
        // Caso nenhum usuário seja encontrado, exibe o pop-up de cadastro
        echo "<h3>Nenhum usuário encontrado para o CPF informado. Por favor, cadastre um novo usuário:</h3>";
        echo '<script>mostrarPopup();</script>';

        // Aqui vamos fechar o bloco PHP antes de inserir o HTML
        ?>
        <div class="popup">
            <div class="popup-content">
                <span class="close" onclick="fecharPopup()">&times;</span>
                <h3>Cadastro de Novo Usuário:</h3>
                <form action="cadastro_usuario.php" method="post">
                    <label for="cpf">CPF:</label>
                    <input type="text" name="cpf" required>

                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" required>

                    <label for="telefone">Telefone:</label>
                    <input type="tel" name="telefone" required>

                    <label for="email">Email:</label>
                    <input type="email" name="email" required>

                    <label for="data_entrada">Data de Entrada:</label>
                    <input type="date" name="data_entrada" required>

                    <label for="data_saida">Data de Saída:</label>
                    <input type="date" name="data_saida">

                    <label for="situacao">Situação:</label>
                    <input type="text" name="situacao">

                    <label for="valor_aluguel">Valor do Aluguel:</label>
                    <input type="text" name="valor_aluguel">

                    <label for="ativo">Ativo:</label>
                    <input type="text" name="ativo">

                    <label for="observacoes">Observações:</label>
                    <textarea name="observacoes"></textarea>

                    <button type="submit">Cadastrar</button>
                </form>
            </div>
        </div>
        <?php
    }

    $conn->close();
}
?>
