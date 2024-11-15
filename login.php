<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica se o login é válido
    $sql = "SELECT nome FROM usuarios WHERE email = '$email' AND senha = '$senha'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Inicia a sessão com o nome do usuário
        $_SESSION['email'] = $email;
        $_SESSION['nome'] = mysqli_fetch_assoc($result)['nome'];

        // Redireciona para a página principal
        header("Location: principal.php");
    } else {
        echo "Login ou senha inválidos.";
    }
}
?>
