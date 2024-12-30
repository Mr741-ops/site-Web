<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Conectar ao banco de dados
    $conn = new mysqli('localhost', 'root', 'root123', 'filmesWEB');

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Dados do formulário
    $nome = $conn->real_escape_string($_POST['nome']);
    $username = $conn->real_escape_string($_POST['username']);
    $mail = $conn->real_escape_string($_POST['mail']);
    $password = $conn->real_escape_string($_POST['password']);

    // Verificar se o usuário ou email já existe
    $checkQuery = "SELECT * FROM users WHERE username='$username' OR mail='$mail'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        echo "<p>Nome de usuário ou email já está em uso.</p>";
    } else {
        // Inserir novo usuário
        $insertQuery = "INSERT INTO users (nome, username, mail, password_user) VALUES ('$nome', '$username', '$mail', '$password')";

        if ($conn->query($insertQuery) === TRUE) {
            echo "<p>Registro bem-sucedido! <a href='login.php'>Faça login aqui</a>.</p>";
        } else {
            echo "<p>Erro: " . $conn->error . "</p>";
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="registo.css">
</head>
<body>
    <div class="caixa">
        <h2>Registrar</h2>
        <form action="registo.php" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="username">Nome de Usuário:</label>
            <input type="text" id="username" name="username" required>

            <label for="mail">Email:</label>
            <input type="email" id="mail" name="mail" required>

            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Registrar</button>
        </form>
    </div>
</body>
</html>