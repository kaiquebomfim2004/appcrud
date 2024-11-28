<?php
// Verifica se já existe uma sessão ativa
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <!-- Cabeçalho -->
    <header class="bg-primary text-white p-4">
        <div class="container text-center">
            <h1>Sistema e-Commerce</h1>
        </div>
    </header>
    <!-- Navegação -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="principal.php">Home</a>
            <a class="navbar-brand" href="usuarios_cadastro.php">Usuários</a>
            <a class="navbar-brand" href="produtos.php">Produtos</a>
            <div class="ml-auto">
                <a class="navbar-brand" href="logout.php">Logout</a>
                <!-- Ícone de Carrinho -->
                <a href="shopcart.php" class="navbar-brand">
                    <i class="fas fa-shopping-cart"></i> Carrinho
                    <?php
                    // Exibe o número de itens no carrinho
                    $carrinhoCount = isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : 0;
                    echo "($carrinhoCount)";
                    ?>
                </a>
            </div>
        </div>
    </nav>
