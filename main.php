<<<<<<< HEAD
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

    // Consulta para obter os filmes
    $query = "SELECT id_filmes, nome, url_imagem FROM filmes";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    // Recupera os resultados
    $filmes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filmes</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <header>
    <h1>Filmes</h1>
    </header>
    <main>
        <?php if (count($filmes) > 0): ?>
            <?php foreach ($filmes as $filme): ?>
                <div class="movie">
                    <a href="filme.php?id=<?php echo htmlspecialchars($filme['id_filmes']); ?>">
                        <img src="<?php echo htmlspecialchars($filme['url_imagem']); ?>" alt="<?php echo htmlspecialchars($filme['nome']); ?>">
                    </a>
                    <div class="details">
                        <h2><?php echo htmlspecialchars($filme['nome']); ?></h2>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nenhum filme encontrado.</p>
        <?php endif; ?>
    </main>
</body>
</html>
=======
<?php 
    $host = "sql306.infinityfree.com";
    $username = "if0_37806044";
    $password = "8T75u2nNx5";
    $database = "if0_37806044_XXX";
?>

<!DOCTYPE HTML>
<html>
    
    <head>

    </head>
    
    <body>
        <main>
            <?php 
                foreach($filme on $flimes){

                }
            ?> 
        </main>
    </body>
>>>>>>> e52b24da764beedc1eb09e3fb5935579bb60142f
</html>