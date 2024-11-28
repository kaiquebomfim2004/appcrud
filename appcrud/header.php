<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="d-flex flex-column min-vh-100 bg-light">
    <header class="bg-info text-center py-3">
        <h1>Sistema e-Commerce</h1>
    </header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="principal.php">Home</a>
            <a class="navbar-brand" href="usuarios_cadastro.php">Usuários</a>
            <a class="navbar-brand" href="produtos_cadastro.php">Produtos</a>
            <a class="navbar-brand" href="shopcart.php">Carrinho</a>

            <!-- Verifica se o usuário está logado e exibe seu nome ou email -->
            <?php
            // Verifica se a sessão já foi iniciada antes de chamá-la
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            if (isset($_SESSION['email'])) {
                // Exibe o nome ou email do usuário logado
                $usuario_logado = $_SESSION['email']; // ou $_SESSION['nome'] se você salvar o nome também
                echo "<div class='ml-auto text-light'>
                          <span>Bem-vindo, $usuario_logado</span>
                          <a href='logout.php' class='btn btn-sm btn-outline-danger ms-2'>Sair</a>
                      </div>";
            }
            ?>
        </div>
    </nav>
</body>
</html>
