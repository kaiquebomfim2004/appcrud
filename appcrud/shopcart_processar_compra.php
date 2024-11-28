<?php
session_start();

// Verifica se o carrinho está vazio
if (!isset($_SESSION['carrinho']) || count($_SESSION['carrinho']) === 0) {
    header("Location: shopcart.php");
    exit();
}

// Verifica se o usuário está logado
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Aqui você pode implementar lógica para salvar o pedido no banco de dados, se necessário.
// Exemplo:
include 'db.php';

$email_usuario = $_SESSION['email'];
$total_pedido = 0;

// Itera sobre os itens do carrinho para salvar os dados
foreach ($_SESSION['carrinho'] as $id_produto => $item) {
    $nome_produto = $item['nome'];
    $quantidade = $item['quantidade'];
    $preco = $item['preco'];
    $subtotal = $quantidade * $preco;
    $total_pedido += $subtotal;

    // Insere cada item do pedido no banco de dados
    $query = "INSERT INTO pedidos (email_usuario, id_produto, nome_produto, quantidade, preco_unitario, subtotal, data_pedido)
              VALUES ('$email_usuario', $id_produto, '$nome_produto', $quantidade, $preco, $subtotal, NOW())";
    $conn->query($query);
}

// Define uma flag indicando que o pedido foi processado
$_SESSION['carrinho_finalizado'] = true;

// Redireciona para a página de sucesso
header("Location: shopcart_sucesso_compra.php");
exit();
