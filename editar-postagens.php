<?php
include_once('config.php');

// Verifica se o ID da postagem foi fornecido na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta para recuperar os detalhes da postagem com base no ID
    $sql = "SELECT id, titulo, conteudo, imagem FROM postagens WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $titulo = $row['titulo'];
        $conteudo = $row['conteudo'];
        $imagem_atual = $row['imagem'];
    } else {
        echo "Postagem não encontrada.";
        exit;
    }
} else {
    echo "ID da postagem não fornecido.";
    exit;
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["titulo"]) && isset($_POST["conteudo"])) {
        $novo_titulo = $_POST["titulo"];
        $novo_conteudo = $_POST["conteudo"];

        // Verifica se uma nova imagem foi enviada
        if (isset($_FILES["imagem"]) && $_FILES["imagem"]["error"] == 0) {
            $nova_imagem = $_FILES["imagem"]["name"];
            $imagem_temp = $_FILES["imagem"]["tmp_name"];
            $imagem_destino = "img/" . $nova_imagem;

            // Move a nova imagem para o diretório de uploads
            move_uploaded_file($imagem_temp, $imagem_destino);

            // Atualiza os detalhes da postagem no banco de dados, incluindo a nova imagem
            $sql = "UPDATE postagens SET titulo = ?, conteudo = ?, imagem = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $novo_titulo, $novo_conteudo, $nova_imagem, $id);
        } else {
            // Atualiza os detalhes da postagem no banco de dados, sem alterar a imagem
            $sql = "UPDATE postagens SET titulo = ?, conteudo = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssi", $novo_titulo, $novo_conteudo, $id);
        }

        if ($stmt->execute()) {
            $mensagem = "Postagem atualizada com sucesso.";
            // Atualiza a imagem atual se uma nova imagem foi carregada
            if (isset($nova_imagem)) {
                $imagem_atual = $nova_imagem;
            }
        } else {
            $erro = "Ocorreu um erro ao atualizar a postagem.";
        }
    }
         if ($stmt->execute()) {
            // Redireciona para a página de inicial após a atualização bem-sucedida
            header("Location: dashboard.php");
            exit;
        } else {
            $erro = "Ocorreu um erro ao atualizar a postagem.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Postagem</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="img/espaço marques.jpg" type="image/x-icon">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <h1>Editar Postagem</h1>
    <?php if (isset($mensagem)) : ?>
        <div class="alert alert-success"><?php echo $mensagem; ?></div>
    <?php endif; ?>
    <?php if (isset($erro)) : ?>
        <div class="alert alert-danger"><?php echo $erro; ?></div>
    <?php endif; ?>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" class="form-control" value="<?php echo $titulo; ?>" required>
        </div>
        <div class="mb-3">
            <label for="conteudo">Conteúdo:</label>
            <textarea name="conteudo" class="form-control" rows="4" required><?php echo $conteudo; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="imagem">Imagem:</label>
            <?php if (!empty($imagem_atual)) : ?>
                <p>Imagem Atual: <br><img src="img/<?php echo $imagem_atual; ?>" alt="Imagem Atual" style="max-width: 100px;"></p>
            <?php endif; ?>
            <input type="file" name="imagem" class="form-control-file">
        </div>
        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    </form>
</body>
</html>
