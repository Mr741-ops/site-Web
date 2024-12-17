<?php
// Configurações do banco de dados
$host = 'localhost';
$dbname = 'filmesWEB';
$username = 'root';
$password = 'root123'; 

try {
    // Conexão com o banco de dados
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verifica se o ID foi passado na URL
    if (!isset($_GET['id'])) {
        die("Filme não especificado.");
    }


    $id = (int) $_GET['id'];

    $query = "SELECT nome, url_imagem, rating FROM filmes WHERE id_filmes = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $filme = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$filme) {
        die("Filme não encontrado.");
    }
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($filme['nome']); ?></title>
    <link rel="stylesheet" href="filme.css">
</head>
<body>
    <header>
        <h1><?php echo htmlspecialchars($filme['nome']); ?></h1>
    </header>
    <main>
        <div class="movie-detail">
            <img src="<?php echo htmlspecialchars($filme['url_imagem']); ?>" alt="<?php echo htmlspecialchars($filme['nome']); ?>" class="movie-image">
            <div class="details">
                <p>Rating: <?php echo htmlspecialchars(number_format($filme['rating'], 1)); ?></p>
            </div>
        </div>
    </main>
</body>
</html>