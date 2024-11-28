<?php
session_start();
include 'db.php';  // Inclua a conexão com o banco de dados

$total = 0;
echo '<h2>Finalizar Compra</h2>';
echo '<form method="POST" action="shopcart_processar_compra.php">';  // Envia para processar a compra

foreach ($_SESSION['carrinho'] as $id_produto => $quantidade) {
    // Consulta os dados do produto
    $sql = "SELECT nome, valorunitario FROM produtos WHERE id = $id_produto";
    $result = $conn->query($sql);
    $produto = $result->fetch_assoc();

    $subtotal = $produto['valorunitario'] * $quantidade;
    $total += $subtotal;

    echo "<p>{$produto['nome']} - Quantidade: $quantidade - Subtotal: R$ " . number_format($subtotal, 2, ',', '.') . "</p>";
}

echo "<h4>Total: R$ " . number_format($total, 2, ',', '.') . "</h4>";
echo '<button type="submit" class="btn btn-success">Confirmar Compra</button>';
echo '</form>';
?>
