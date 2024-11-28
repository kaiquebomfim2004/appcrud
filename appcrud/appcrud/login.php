<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT nome, senha FROM usuarios WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($senha, $user['senha'])) {
            $_SESSION['email'] = $email;
            $_SESSION['nome'] = $user['nome'];
            header("Location: principal.php");
            exit();
        } else {
            echo "Senha inválida.";
        }
    } else {
        echo "Email não encontrado.";
    }
}
?>
