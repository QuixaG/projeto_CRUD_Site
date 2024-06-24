<?php
//session_start();

if (empty($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}

include_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["titulo"]) && isset($_POST["conteudo"])) {
        $titulo = $_POST["titulo"];
        $conteudo = $_POST["conteudo"];

        if (isset($_FILES["imagem"]) && $_FILES["imagem"]["error"] == 0) {
            $imagem = $_FILES["imagem"]["name"];
            $imagem_temp = $_FILES["imagem"]["tmp_name"];
            $imagem_destino = "img/" . $imagem;
            move_uploaded_file($imagem_temp, $imagem_destino);
        } else {
            $imagem = null;
        }

        $stmt = $conn->prepare("INSERT INTO postagens (titulo, conteudo, imagem, usuario, data_postagem) VALUES (?, ?, ?, ?, NOW())");
        
        // Verifica se a preparação da consulta falhou
        if ($stmt === false) {
            die("Erro na preparação da consulta: " . htmlspecialchars($conn->error));
        }

        $stmt->bind_param("ssss", $titulo, $conteudo, $imagem, $_SESSION["usuario"]);

        if ($stmt->execute()) {
            $mensagem = "Postagem criada com sucesso.";
        } else {
            $erro = "Ocorreu um erro ao criar a postagem: " . htmlspecialchars($stmt->error);
        }
    }

    if (isset($_POST["excluir"])) {
        $id = $_POST["excluir"];
        $stmt = $conn->prepare("DELETE FROM postagens WHERE id = ?");
        
        // Verifica se a preparação da consulta falhou
        if ($stmt === false) {
            die("Erro na preparação da consulta: " . htmlspecialchars($conn->error));
        }

        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $mensagem = "Postagem excluída com sucesso.";
        } else {
            $erro = "Ocorreu um erro ao excluir a postagem: " . htmlspecialchars($stmt->error);
        }
    }
}

// Recuperar todas as postagens do usuário logado
$sql = "SELECT id, titulo, conteudo, imagem, DATE_FORMAT(data_postagem, '%d/%m/%Y %H:%i:%s') as data_formatada, usuario FROM postagens WHERE usuario = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Erro na preparação da consulta: " . htmlspecialchars($conn->error));
}

$stmt->bind_param("s", $_SESSION['usuario']);
$stmt->execute();
$result = $stmt->get_result();
$postagens = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="img/espaço marques.jpg" type="image/x-icon">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container">
    <h1>Postagens</h1>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="conteudo">Conteúdo:</label>
            <textarea name="conteudo" class="form-control" rows="4" required></textarea>
        </div>
        <div class="mb-3">
            <label for="imagem">Imagem:</label>
            <input type="file" name="imagem" class="form-control-file">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-warning">Criar Postagem</button>
        </div>
    </form>
    <?php if (isset($mensagem)) : ?>
        <div class="alert alert-success"><?php echo $mensagem; ?></div>
    <?php endif; ?>
    <?php if (isset($erro)) : ?>
        <div class="alert alert-danger"><?php echo $erro; ?></div>
    <?php endif; ?>
    <h2>Suas Postagens</h2>
    <ul class="list-group">
        <?php foreach ($postagens as $postagem) : ?>
            <li class="list-group-item">
                <h3><?php echo $postagem["titulo"]; ?></h3>
                <p><?php echo $postagem["conteudo"]; ?></p>
                <?php if ($postagem["imagem"]) : ?>
                    <img src="img/<?php echo $postagem["imagem"]; ?>" alt="Imagem da Postagem" style="max-width: 100%;">
                <?php endif; ?>
                <p class="text-muted"><i class="fas fa-calendar-alt"></i> Data da Postagem: <?php echo $postagem["data_formatada"]; ?></p>
                <p class="text-muted"><i class="fas fa-user"></i> Usuário: <?php echo $postagem["usuario"]; ?></p>
                <form method="POST">
                    <input type="hidden" name="excluir" value="<?php echo $postagem["id"]; ?>">
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
                <a href="editar-postagens.php?id=<?php echo $postagem['id']; ?>" class="btn btn-success">Editar</a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
</body>
</html>
