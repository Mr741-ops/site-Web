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

function escreverFilme( $filme) {
    // Heredoc for the movie item
    $html = <<<HTML
        <div class="movie">
            <a href="filme.php?id='{$filme['id_filmes']}">
                <img src="{$filme['url_imagem']}" alt="{$filme['nome']}">
            </a>
            <div class="details">
                <h2>{$filme['nome']}</h2>
            </div>
        </div>
    HTML;

    echo $html;
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filmes</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Filmes</h1>
    </header>
    <main>
        <?php if (!empty($filmes)): 
                foreach ($filmes as $filme): 
                    if ($filme):
                        // str_replace(["'"], ["\'"], $html)
                        escreverFilme($filme);
                    endif;
                endforeach; 
            else: 
                echo "<p>Nenhum filme encontrado.</p>";
            endif;
        ?>    
    </main>
</body>
</html>
