<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Conectar ao banco de dados
    $conn = new mysqli('localhost', 'root', 'root123', 'filmesWEB');

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Dados do formulário
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // Verificar as credenciais
    $query = "SELECT * FROM users WHERE username='$username' AND password_user='$password'";
    $result = $conn->query($query);

    if ($result->num_rows === 1) {
        // Iniciar a sessão
        session_start(); // Inicia a sessão
    
        // Definir a variável de sessão para o nome de usuário
        $_SESSION['username'] = $username; // Armazenar o nome de usuário na sessão
    
        echo "<p>Login bem-sucedido! Redirecionando para a página principal...</p>";
        header("refresh:2;url=principal.php"); // Redireciona para a página principal
    } else {
        echo "<p>Usuário ou senha incorretos.</p>";
    }
    

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="caixa">
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <label for="username">Nome de Usuário:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>
