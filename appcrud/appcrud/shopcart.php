<?php
session_start();
include 'header.php';
?>

<div class="container py-4">
    <h3>Seu Carrinho</h3>
    
    <!-- Exibe a mensagem de feedback -->
    <?php if (isset($_SESSION['mensagem'])): ?>
        <div class="alert alert-info">
            <?php echo $_SESSION['mensagem']; ?>
        </div>
        <?php unset($_SESSION['mensagem']); // Limpa a mensagem após exibição ?>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0): ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Produto</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Total</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION['carrinho'] as $id_produto => $item): ?>
            <tr>
                <td><?php echo htmlspecialchars($item['nome']); ?></td>
                <td>R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></td>
                <td><?php echo $item['quantidade']; ?></td>
                <td>R$ <?php echo number_format($item['preco'] * $item['quantidade'], 2, ',', '.'); ?></td>
                <td>
                    <a href="shopcart_controller.php?remover=<?php echo $id_produto; ?>" class="btn btn-danger btn-sm">Remover</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <p>Seu carrinho está vazio.</p>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
