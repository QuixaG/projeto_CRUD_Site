<?php
    switch ($_REQUEST["acao"]) {
        case 'cadastrar':
            $nome = $_POST["nome"];
            $email = $_POST["email"];
            $faixa = $_POST["faixa"];
            $data_nasc = $_POST["data_nasc"];
            
            $sql = "INSERT INTO alunos (nome, email, faixa, data_nasc) VALUES ('{$nome}','{$email}','{$faixa}','{$data_nasc}')";

            $res = $conn->query($sql);

            if ($res==true) {
                print "<script>alert('Cadastro com sucesso!');</script>";
                print "<script>location.href='?page=listar';</script>";
            }else{
                print "<script>alert('Não foi possível cadastrar!');</script>";
                print "<script>location.href='?page=listar';</script>";
            }
            break;

        case 'editar':
            $nome = $_POST["nome"];
            $email = $_POST["email"];
            $faixa = $_POST["faixa"];
            $data_nasc = $_POST["data_nasc"];

            $sql = "UPDATE alunos SET
                        nome='{$nome}',
                        email='{$email}',
                        faixa='{$faixa}',
                        data_nasc='{$data_nasc}'
                    WHERE 
                        id=".$_REQUEST["id"];


            $res = $conn->query($sql);

            if ($res==true) {
                print "<script>alert('Editado com sucesso!');</script>";
                print "<script>location.href='?page=listar';</script>";
            }else{
                print "<script>alert('Não foi possível editar!');</script>";
                print "<script>location.href='?page=listar';</script>";
            }
            break;

        case 'excluir':
        
            $sql = "DELETE FROM alunos WHERE id=".$_REQUEST["id"];

            $res = $conn->query($sql);

            if ($res==true) {
                print "<script>alert('Excluído com sucesso!');</script>";
                print "<script>location.href='?page=listar';</script>";
            }else{
                print "<script>alert('Não foi possível excluir!');</script>";
                print "<script>location.href='?page=listar';</script>";
            }
            break;

        default:
            # code...
            break;
    }
    ?>
