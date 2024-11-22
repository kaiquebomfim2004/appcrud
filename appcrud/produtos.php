<?php
include 'db.php';

$sql = "SELECT * FROM produtos WHERE ativo = 1";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
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
            </div>
        </div>
    </nav>
    <!-- Conteúdo Principal -->
    <main class="container mt-4">
        <h2>Produtos</h2>
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4">';
                    echo '<div class="card">';
                    echo '<img src="' . $row["url_img"] . '" class="card-img-top" alt="' . $row["nome"] . '">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $row["nome"] . '</h5>';
                    echo '<p class="card-text">' . $row["descricao"] . '</p>';
                    echo '<p class="card-text"><strong>Marca:</strong> ' . $row["marca"] . '</p>';
                    echo '<p class="card-text"><strong>Modelo:</strong> ' . $row["modelo"] . '</p>';
                    echo '<p class="card-text"><strong>Valor:</strong> R$ ' . $row["valorunitario"] . '</p>';
                    echo '<p class="card-text"><strong>Categoria:</strong> ' . $row["categoria"] . '</p>';
                    echo '<a href="#" class="btn btn-primary">Comprar</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>Nenhum produto encontrado.</p>';
            }
            ?>
        </div>
    </main>
</body>
</html>
