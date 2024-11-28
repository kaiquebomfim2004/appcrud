<?php
include 'db.php';

$sql = "SELECT * FROM produtos WHERE ativo = 1"; // Consulta aos produtos
$result = $conn->query($sql); // Executa a consulta
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
            if ($result->num_rows > 0) {  // Verifica se há produtos no banco de dados
                while($row = $result->fetch_assoc()) {
                    // Exibe as informações de cada produto, incluindo a imagem
                    echo '<div class="col-md-4">';
                    echo '<div class="card">';
                    
                    // Aqui está a parte da imagem, com o link da Coca-Cola 2L
                    echo '<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQizlR_Cl2i7RTwc7aa--JE3hUfeKorkjzQaw&s" 
                             class="card-img-top" 
                             alt="' . htmlspecialchars($row["nome"]) . '" 
                             style="width: 100%; height: 300px; object-fit: contain;">';
                    
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . htmlspecialchars($row["nome"]) . '</h5>';
                    echo '<p class="card-text">' . htmlspecialchars($row["descricao"]) . '</p>';
                    echo '<p class="card-text"><strong>Marca:</strong> ' . htmlspecialchars($row["marca"]) . '</p>';
                    echo '<p class="card-text"><strong>Modelo:</strong> ' . htmlspecialchars($row["modelo"]) . '</p>';
                    echo '<p class="card-text"><strong>Valor:</strong> R$ ' . number_format($row["valorunitario"], 2, ',', '.') . '</p>';
                    echo '<p class="card-text"><strong>Categoria:</strong> ' . htmlspecialchars($row["categoria"]) . '</p>';
                    // Botão Adicionar ao Carrinho
                    echo '<a href="adicionar_ao_carrinho.php?id=' . $row['id'] . '" class="btn btn-primary">Adicionar ao Carrinho</a>';
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
