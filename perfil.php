<?php
session_start();

// Configuração de conexão com o banco de dados usando PDO
$dsn = 'mysql:host=localhost;dbname=filmesWEB';
$username = 'root';
$password = 'root123';
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die("Erro de conexão com o banco de dados: " . $e->getMessage());
}

// Verifica se o usuário está logado
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['username'];

// Obtém os dados do usuário logado
$query = "SELECT id_users, nome, username FROM users WHERE username = :username";
$stmt = $pdo->prepare($query);
$stmt->execute(['username' => $username]);
$user = $stmt->fetch();

if (!$user) {
    die("Usuário não encontrado.");
}

$userId = $user['id_users'];

// Atualiza os dados do usuário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novoNome = trim($_POST['nome']);
    $novoUsername = trim($_POST['username']);

    if ($novoNome && $novoUsername) {
        $updateQuery = "UPDATE users SET nome = :nome, username = :username WHERE id_users = :id_users";
        $updateStmt = $pdo->prepare($updateQuery);
        $updateStmt->execute([
            'nome' => $novoNome,
            'username' => $novoUsername,
            'id_users' => $userId,
        ]);

        // Atualiza os dados exibidos após a alteração
        $user['nome'] = $novoNome;
        $user['username'] = $novoUsername;

        echo "<p1>Dados atualizados com sucesso!</p1>";
    } else {
        echo "<p>Por favor, preencha todos os campos.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário</title>
    <link rel="stylesheet" href="perfil.css">
</head>
<body>
    <h1>Perfil do Usuário</h1>
    <form method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($user['nome']) ?>" required>

        <label for="username">Nome de Usuário:</label>
        <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>

        <button type="submit">Salvar Alterações</button>
    </form>

    <a href="logout.php">Sair do Perfil</a>

    <a href="login.php" class="voltar">Voltar ao Menu</a>
</body>
</html>