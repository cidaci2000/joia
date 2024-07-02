<?php
include_once('config.php');

// Checkar conexão
if ($conexao->connect_error) {
    die("Erro de conexão com o banco de dados: " . $conexao->connect_error);
}

// Receber dados do formulário
if (isset($_POST['Nome']) && isset($_POST['email']) && isset($_POST['Senha']) && isset($_POST['ConfirmarSenha'])) {
    $Nome = $_POST['Nome'];
    $email = $_POST['email'];
    $Senha = $_POST['Senha'];
    $Confirmar_Senha = $_POST['ConfirmarSenha'];
} else {
    echo "Erro: Dados do formulário não enviados corretamente.";
}

// Verificar se o e-mail já existe
$sql_verifica_email = "SELECT COUNT(*) FROM usuarios WHERE email = '$email'";
$resultado_verifica = $conexao->query($sql_verifica_email);

if ($resultado_verifica->fetch_row()[0] > 0) {
    echo "Erro: E-mail já cadastrado. Tente outro e-mail.";
} else {
    // Se o e-mail não existir, prosseguir com a inserção
    $sql = "INSERT INTO usuarios (Nome, email, Senha, ConfirmarSenha) VALUES ('$Nome', '$email', '$Senha', '$confirmarSenha')";

    if ($conexao->query($sql) === TRUE) {
        echo "Usuário cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar o usuário: " . $conexao->error;
    }
}

$conexao->close();


?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente</title>
    <link rel="stylesheet" href="cliente.css">
</head>
<body>
    <div class="container">
        <h1>Cadastro de Cliente</h1>
        <form action="cliente.php" method="post">
            <label for="nome">Nome Completo:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <label for="confirmarSenha">Confirmar Senha:</label>
            <input type="password" id="confirmarSenha" name="confirmarSenha" required>

            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>