<?php
session_start(); // Inicia a sessão para acessar os dados do carrinho

// Verifica se o carrinho existe e é um array
if (isset($_SESSION['carrinho']) && is_array($_SESSION['carrinho'])) {
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Carrinho de Compras</h2>
        
        <?php
        // Verifica se o carrinho contém produtos
        if (count($_SESSION['carrinho']) > 0) {
            echo '<table class="table table-striped">';
            echo '<thead><tr><th>Produto</th><th>Preço</th><th>Quantidade</th><th>Total</th></tr></thead>';
            echo '<tbody>';
            $total = 0;

            // Itera sobre os itens do carrinho
            foreach ($_SESSION['carrinho'] as $item) {
                // Verifica se $item é um array
                if (is_array($item)) {
                    $item_total = $item['quantidade'] * $item['valorunitario'];
                    $total += $item_total;

                    // Exibe o produto
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($item['nome']) . '</td>';
                    echo '<td>R$ ' . number_format($item['valorunitario'], 2, ',', '.') . '</td>';
                    echo '<td>' . $item['quantidade'] . '</td>';
                    echo '<td>R$ ' . number_format($item_total, 2, ',', '.') . '</td>';
                    echo '</tr>';
                }
            }

            echo '</tbody>';
            echo '</table>';
            echo '<h4>Total: R$ ' . number_format($total, 2, ',', '.') . '</h4>';
        } else {
            echo '<p>Seu carrinho está vazio.</p>';
        }
        ?>

        <a href="produtos.php" class="btn btn-secondary">Voltar para os Produtos</a>
        <a href="finalizar_compra.php" class="btn btn-success">Finalizar Compra</a>
    </div>
</body>
</html>

<?php
} else {
    // Caso a sessão do carrinho não exista ou não seja um array, exibe uma mensagem
    echo '<p>Seu carrinho está vazio ou não foi inicializado corretamente.</p>';
}
?>
