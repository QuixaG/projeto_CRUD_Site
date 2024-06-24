<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="img/espaço marques.jpg" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
</body>
</html>
<?php

include_once('config.php');

$sql = "SELECT titulo, conteudo, data_postagem, usuario,imagem FROM postagens";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<ul class="list-group">';
        echo '<li class="list-group-item">';
        echo '<h3>' . $row['titulo'] . '</h3>';
        echo '<p>' . $row['conteudo'] . '</p>';
        if (!empty($row['imagem'])) {
            echo '<img src=
            "img/' . $row['imagem'] . '" alt="Imagem da Postagem" style="max-width: 100%;">';
        }
        echo '<p class="text-muted"><i class="fas fa-calendar-alt"></i> Data da Postagem: ' . $row['data_postagem'] . '</p>';
        echo '<p class="text-muted"><i class="fas fa-user"></i> Postado por: ' . $row['usuario'] . '</p>';
        echo'</li>';
        echo'</ul>';
    
    }
} else {
    echo 'Nenhuma postagem disponível.';
}
?>
