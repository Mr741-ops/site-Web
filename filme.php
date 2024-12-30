<?php
// Configurações do banco de dados
$host = 'localhost';
$dbname = 'filmesWEB';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (!isset($_GET['id']) || empty($_GET['id'])) {
        die("Filme não especificado.");
    }

    $id = (int) $_GET['id'];

    // Check if a rating was submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rating'])) {
        $rating = (int) $_POST['rating'];

        // Save the rating to the database
        $updateQuery = "UPDATE filmes SET rating = :rating WHERE id_filmes = :id";
        $updateStmt = $pdo->prepare($updateQuery);
        $updateStmt->bindParam(':rating', $rating, PDO::PARAM_INT);
        $updateStmt->bindParam(':id', $id, PDO::PARAM_INT);
        $updateStmt->execute();
    }

    // Retrieve the movie details again (with the updated rating)
    $query = "SELECT nome, url_imagem, rating, descr FROM filmes WHERE id_filmes = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $filme = $stmt->fetch(PDO::FETCH_ASSOC);

    $currentRating = 0;

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
        <a href="main.php">
            <button type="button">Home</button>
        </a>
    </header>
    <main>
        <div class="movie-detail">
            <div class="details">
                <img src="<?php echo htmlspecialchars($filme['url_imagem']); ?>" alt="<?php echo htmlspecialchars($filme['nome']); ?>" class="movie-image">
                <h1><?php echo htmlspecialchars($filme['nome']); ?></h1>
                <p>Descrição: <?php $filme['descr'] ?></p>
            </div>
           
            <div class="ratings">
                <p>Rating: <?php echo htmlspecialchars(number_format($filme['rating'], 1)); ?></p>
                <form method="POST" action="">
                    <div class="star-rating">
                        <?php 
                            for ($i = 5; $i > 0; $i--) {
                                $checked = ($currentRating == $i) ? 'checked' : '';
                                echo "<input type=\"radio\" id=\"star{$i}\" name=\"rating\" value=\"{$i}\" {$checked}>";
                                echo "<label for=\"star{$i}\">&#9733</label>";
                            } ?>
                        </div>
                    <button type="submit">Rate</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
