<?php
    define( 'HOST', 'localhost');
    define( 'USER', 'root');
    define( 'PASS', '');
    define( 'BASE', 'cadastro');

    $conn = new MySQLi(HOST,USER,PASS,BASE);

    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }
    
    // Verifique a seleção do banco de dados
    if (!$conn->select_db(BASE)) {
        die("Erro na seleção do banco de dados: " . $conn->error);
    }
?>
