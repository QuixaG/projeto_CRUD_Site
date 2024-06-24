<?php 
	include_once('config.php');
        session_start();

            if (!empty($_POST['email']) && !empty($_POST['senha']) && !empty($_POST['usuario'])) {
    
                //include('config.php');

                $email = $_POST['email'];
                $senha = $_POST['senha'];
                $usuario = $_POST['usuario'];

    
                $stmt = $conn->prepare("INSERT INTO sensei (email, senha, usuario) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $email, $senha, $usuario);

                    if ($stmt->execute()) {
                    echo"<script>alert('Cadastrado com sucesso, agora pode logar sensei');</script>";        
                     header('location: index.php');
                    exit;
                    } else {
                        echo "<script>alert('Ocorreu um erro durante o registro. Por favor, tente novamente.');</script>";
                    }

        $stmt->close();
        $conn->close();
    }
                if(empty($_POST) or (empty($_POST["email"])) or (empty($_POST["senha"])) or (empty($_POST["email"]))){
                    print"<script>location.href='index.php';</script>";
                }

?>
