<?php
session_start();

// Função para validar entrada do usuário
    function validarEntrada($conn, $input) {
        return mysqli_real_escape_string($conn, $input);
    }

    if(empty($_POST) or (empty($_POST["email"])) or (empty($_POST["senha"]))) {
     header("Location: index.php");
        exit();
    }

include('config.php');

$email = validarEntrada($conn, $_POST["email"]);
$senha = validarEntrada($conn, $_POST["senha"]);

$sql = "SELECT * FROM sensei WHERE email = '{$email}' AND senha = '{$senha}'";

$res = $conn->query($sql) or die($conn->error);

$row = $res->fetch_object();

$qtd = $res->num_rows;

    if($qtd > 0) {
        // Configurações de sessão seguras
        $session_lifetime = 3600; // 1 hora
        $cookie_params = session_get_cookie_params();
        session_set_cookie_params($session_lifetime, $cookie_params["path"], $cookie_params["domain"], true, true);
    
        // Regenera o ID da sessão
        session_regenerate_id(true);
    
        // Define as variáveis de sessão
        $_SESSION["email"] = $email;
        $_SESSION["senha"] = $senha;
        $_SESSION["usuario"] = $row->usuario;
    
        // Define mensagem de sucesso
        $_SESSION["mensagem"] = 'Sua conexão é segura e sua sessão está protegida.';
        $_SESSION["tipo_mensagem"] = 'success';
        header("Location: dashboard.php");
        exit();
    } else {
        // Define mensagem de erro usando cookie
        setcookie("mensagem", "Email e/ou senha incorreto(s).", time() + 10, "/");
        setcookie("tipo_mensagem", "danger", time() + 10, "/");
        header("Location: index.php");
        exit();
    }
?>
