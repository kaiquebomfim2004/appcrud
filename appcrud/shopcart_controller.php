<?php
session_start();
include 'db.php';  // Inclua a conexão com o banco de dados

if (isset($_GET['acao'])) {
    $acao = $_GET['acao'];
    $id_produto = (int)$_GET['id'];

    if ($acao == 'remover') {
        // Remove o produto do carrinho
        unset($_SESSION['carrinho'][$id_produto]);
    }

    header('Location: shopcart.php');  // Redireciona de volta para o carrinho
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Atualiza a quantidade de produtos no carrinho
    foreach ($_POST['quantidade'] as $id_produto => $quantidade) {
        $_SESSION['carrinho'][$id_produto] = (int)$quantidade;
    }

    header('Location: shopcart.php');  // Redireciona de volta para o carrinho
    exit();
}
?>
