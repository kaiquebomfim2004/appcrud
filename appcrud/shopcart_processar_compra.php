<?php
session_start();
include 'db.php';  // Inclua a conexão com o banco de dados

// Verificar se o carrinho não está vazio
if (empty($_SESSION['carrinho'])) {
    header('Location: shopcart_erro_compra.php');
    exit();
}

// Simula o processamento da compra
$usuario_id = $_SESSION['usuario_id'];  // Supondo que você tenha um usuário logado
$total = 0;

foreach ($_SESSION['carrinho'] as $id_produto => $quantidade) {
    $sql = "SELECT valorunitario FROM produtos WHERE id = $id_produto";
    $result = $conn->query($sql);
    $produto = $result->fetch_assoc();
    
    $total += $produto['valorunitario'] * $quantidade;
}

// Insere a compra no banco de dados (estoque, pedidos, etc.)
// Aqui você pode adicionar um código para registrar o pedido no banco, descontar o estoque, etc.

// Se o processo for bem-sucedido, redireciona para a página de sucesso
header('Location: shopcart_sucesso_compra.php');
exit();
?>
