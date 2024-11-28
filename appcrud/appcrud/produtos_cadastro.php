<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $valorunitario = $_POST['valorunitario'];
    $categoria = $_POST['categoria'];
    $url_img = $_POST['url_img'];

    $sql = "INSERT INTO produtos (nome, descricao, marca, modelo, valorunitario, categoria, url_img) VALUES ('$nome', '$descricao', '$marca', '$modelo', '$valorunitario', '$categoria', '$url_img')";

    if ($conn->query($sql) === TRUE) {
        echo "Novo produto cadastrado com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <!-- Cabeçalho -->
    <header class="bg-primary text-white p-4">
        <div class="container text-center">
            <h1>Sistema de Cadastro</h1>
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
        <h2>Cadastro de Produtos</h2>
        <form method="post" action="produtos_cadastro.php">
            <div class="form-group">
                <label for="nome">Nome do Produto</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" required></textarea>
            </div>
            <div class="form-group">
                <label for="marca">Marca</label>
                <input type="text" class="form-control" id="marca" name="marca" required>
            </div>
            <div class="form-group">
                <label for="modelo">Modelo</label>
                <input type="text" class="form-control" id="modelo" name="modelo" required>
            </div>
            <div class="form-group">
                <label for="valorunitario">Valor Unitário</label>
                <input type="number" class="form-control" id="valorunitario" name="valorunitario" required>
            </div>
            <div class="form-group">
                <label for="categoria">Categoria</label>
                <input type="text" class="form-control" id="categoria" name="categoria" required>
            </div>
            <div class="form-group">
                <label for="url_img">URL da Imagem</label>
                <input type="text" class="form-control" id="url_img" name="url_img" required>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar Produto</button>
        </form>
    </main>
</body>
</html>
