<?php
session_start();
include 'db.php';  // Inclua a conexão com o banco de dados

// Verifica se o carrinho está vazio
if (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])) {
    echo "<div class='alert alert-warning'>Seu carrinho está vazio! <a href='produtos.php' class='btn btn-link'>Voltar à loja</a></div>";
    exit();
}

echo '<h2>Seu Carrinho de Compras</h2>';
echo '<form method="POST" action="shopcart_controller.php">'; // Formulário para atualizar o carrinho

$total = 0;

echo '<div class="row">';
foreach ($_SESSION['carrinho'] as $id_produto => $quantidade) {
    // Consultar o produto no banco de dados
    $sql = "SELECT nome, valorunitario, url_img FROM produtos WHERE id = $id_produto";
    $result = $conn->query($sql);

    // Verifica se o produto foi encontrado
    if ($result && $produto = $result->fetch_assoc()) {
        $subtotal = $produto['valorunitario'] * $quantidade;
        $total += $subtotal;

        // Exibe o produto no carrinho
        echo '<div class="col-md-4 mb-4">
                <div class="card">
                    <img src="img/' . htmlspecialchars($produto['url_img']) . '" class="card-img-top" alt="' . htmlspecialchars($produto['nome']) . '" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">' . htmlspecialchars($produto['nome']) . '</h5>
                        <p class="card-text">Preço: R$ ' . number_format($produto['valorunitario'], 2, ',', '.') . '</p>
                        <p class="card-text">Quantidade:</p>
                        <input type="number" name="quantidade[' . $id_produto . ']" value="' . $quantidade . '" min="1" class="form-control" style="width: 80px;">
                        <p class="card-text">Subtotal: R$ ' . number_format($subtotal, 2, ',', '.') . '</p>
                        <a href="shopcart_controller.php?acao=remover&id=' . $id_produto . '" class="btn btn-danger btn-sm">Remover</a>
                    </div>
                </div>
              </div>';
    } else {
        // Se o produto não for encontrado, exibe uma mensagem
        echo "<div class='alert alert-danger'>Produto com ID $id_produto não encontrado.</div>";
    }
}

echo '</div>';

echo '<div class="mt-4">
        <h4>Total: R$ ' . number_format($total, 2, ',', '.') . '</h4>
        <a href="produtos.php" class="btn btn-secondary">Voltar para a loja</a>
        <button type="submit" class="btn btn-primary">Atualizar Carrinho</button>
        <a href="shopcart_finalizar_compra.php" class="btn btn-success">Finalizar Compra</a>
      </div>';

echo '</form>';
?>