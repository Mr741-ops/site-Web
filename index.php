<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "seu_usuario";
$password = "sua_senha";
$dbname = "nome_do_banco";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consulta para buscar imagens
$sql = "SELECT nome_imagem, caminho_imagem FROM imagens";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeria de Imagens</title>
</head>
<body>
    <h1>Galeria de Imagens</h1>
    <div>
        <?php
        if ($result->num_rows > 0) {
            // Loop para exibir cada imagem
            while($row = $result->fetch_assoc()) {
                echo "<div>";
                echo "<h2>" . $row['nome_imagem'] . "</h2>";
                echo "<img src='" . $row['caminho_imagem'] . "' alt='" . $row['nome_imagem'] . "' width='300'>";
                echo "</div>";
            }
        } else {
            echo "Nenhuma imagem encontrada.";
        }
        ?>
    </div>
</body>
</html>