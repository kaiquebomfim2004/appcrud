<?php
session_start();

// Verifica se a ação de adicionar ao carrinho foi passada
if (isset($_POST['adicionar'])) {
    $id_produto = $_POST['id_produto'];

    // Obtém o produto do banco de dados
    include 'db.php';
    $query = "SELECT * FROM produtos WHERE id = $id_produto";
    $result = $conn->query($query);
    $produto = $result->fetch_assoc();

    if ($produto) {
        // Verifica se o produto já está no carrinho
        if (isset($_SESSION['carrinho'][$id_produto])) {
            $_SESSION['carrinho'][$id_produto]['quantidade']++;
        } else {
            $_SESSION['carrinho'][$id_produto] = [
                'nome' => $produto['nome'],
                'preco' => $produto['valorunitario'],
                'quantidade' => 1
            ];
        }
    }

    // Redireciona de volta para a página do carrinho
    header('Location: shopcart.php');
    exit;
}

// Verifica se a ação de remover foi passada na URL
if (isset($_GET['remover'])) {
    $id_produto = $_GET['remover'];

    // Verifica se o produto existe no carrinho
    if (isset($_SESSION['carrinho'][$id_produto])) {
        // Remove o item do carrinho
        unset($_SESSION['carrinho'][$id_produto]);
    }

    // Redireciona de volta para o carrinho
    header('Location: shopcart.php');
    exit;
}

// Atualiza as quantidades no carrinho
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quantidade'])) {
    foreach ($_POST['quantidade'] as $id_produto => $novaQuantidade) {
        if (isset($_SESSION['carrinho'][$id_produto]) && $novaQuantidade > 0) {
            $_SESSION['carrinho'][$id_produto]['quantidade'] = (int)$novaQuantidade;
        }
    }
    $_SESSION['mensagem'] = "Carrinho atualizado com sucesso!";
    header('Location: shopcart.php');
    exit;
}
