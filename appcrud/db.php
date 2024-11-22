<?php
$servername = "localhost:3307"; // Alterado para usar a porta 3307
$username = "root"; // padrão do XAMPP
$password = ""; // senha em branco
$dbname = "sistema"; // substitua pelo nome do seu banco de dados

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
