<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>

    <!-- Estilos da página -->
    <link rel="stylesheet" href="estilos2.css">

    <!-- Favicon -->
    <link rel="shortcut icon" href="Imagem2-removebg-preview.png" type="image/png">
</head>

<body>
    <!-- cabeçalho -->
    <header>
        <a href="pagina_administrador.php">
            <img src="Imagem2-removebg-preview.png" alt="logo_empresa" title="residencial">
        </a>
    </header>

    <!-- navegação -->
    <div class="navegacao-container">
        <h3>Acesso <br> Administrador</h3>
        <nav>
            <a href="">Cadastro de CPF</a><br><br>
            <a href="">Regras do Condomínio</a><br><br>
            <a href="">Entrada de Valores</a><br><br>
            <a href="">Cadastro de Ativos</a>
        </nav>
    </div>

    <!-- botão do WhatsApp -->
    <div class="wpp">
        <a href="https://api.whatsapp.com/send?phone=555511999491243" class="botao-wpp">(11)9.9949-1243
            <img src="whatsapp-logo-24.png" alt="">
        </a>
    </div>

    <!-- Exibe o nome do usuário -->
    <div class="user-info-container">
        <?php
        // Inicia a sessão para recuperar a variável de sessão
        session_start();

        // Exibe o nome do usuário se estiver definido
        if (isset($_SESSION['nome_usuario'])) {
            // Verifica se é o usuário 'test' e exibe o nome personalizado
            if ($_SESSION['nome_usuario'] == 'test') {
                echo "<p>Olá, Caio</p>";
            } else {
                echo "<p>Olá, {$_SESSION['nome_usuario']}</p>";
            }
        }
        ?>
        <a href="logout.php"><button>Sair</button></a>
    </div>

    <!-- Formulário de Pesquisa -->
    <div class="pesquisa-container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="cpf_pesquisa">Pesquisa CPF:</label>
            <input type="text" name="cpf_pesquisa" required>
            <button type="submit" name="pesquisar">Pesquisar</button>
        </form>

        <!-- Resultado da Pesquisa -->
        <div class="resultado-pesquisa">
            <?php
            include 'conexao.php';

            // Verifica se o usuário é um administrador
            if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] == 'administrador') {
                // Acesso permitido apenas para administradores
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pesquisar'])) {
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
                            echo "<p>CPF: " . $row["cpf"] . "</p>";
                            echo "<p>Valor do Aluguel: " . $row["valor_aluguel"] . "</p>";
                            echo "<p>Data de entrada: " . $row["data_entrada"] . "</p>";
                            echo "<p>Data de saída: " . $row["data_saida"] . "</p>";
                            echo "<p>Situação: " . $row["situacao"] . "</p>";
                            echo "<p>Ativo: " . $row["ativo"] . "</p>";
                            echo "<p>Senha Visível: " . $row["senha_visivel"] . "</p>";
                            // Exibe a senha apenas para administradores
                            echo "<p>Observaçoes: " . $row["observacoes"] . "</p>";
                            
                        }
                    } else {
                        // Caso nenhum usuário seja encontrado, exibe o modal de cadastro
                        echo "<script>document.getElementById('myModal').style.display = 'block';</script>";
                    }
                }
            }
            $conn->close();
            ?>
        </div>
    </div>

    <!-- Modal de Cadastro -->
    <div id="myModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Cadastro de Novo Usuário:</h2>
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
                <label for="senha">Senha:</label>
                <input type="text" name="senha" required>
                <label for="observacoes">Observações:</label>
                <textarea name="observacoes"></textarea>
                <button type="submit" name="cadastrar">Cadastrar</button>
            </form>
        </div>
    </div>

    <!-- Script para controlar o modal -->
    <script>
    // Função para abrir o modal
    function openModal() {
        var modal = document.getElementById("myModal");
        modal.style.display = "block";
    }

    // Função para fechar o modal
    function closeModal() {
        var modal = document.getElementById("myModal");
        modal.style.display = "none";
    }
    </script>

    <?php
    // Caso nenhum usuário seja encontrado, exibe o modal de cadastro
    echo "<script>openModal();</script>";
    ?>

</body>

</html>

