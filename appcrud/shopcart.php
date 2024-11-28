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
    <form action="shopcart_controller.php" method="POST">
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
                    <td>
                        <input type="number" name="quantidade[<?php echo $id_produto; ?>]" value="<?php echo $item['quantidade']; ?>" min="1" class="form-control form-control-sm">
                    </td>
                    <td>R$ <?php echo number_format($item['preco'] * $item['quantidade'], 2, ',', '.'); ?></td>
                    <td>
                        <a href="shopcart_controller.php?remover=<?php echo $id_produto; ?>" class="btn btn-danger btn-sm">Remover</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="5">
                        <button type="submit" class="btn btn-primary">Atualizar Carrinho</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
    <form action="shopcart_finalizar_compra.php" method="POST">
        <button type="submit" class="btn btn-success">Finalizar Compra</button>
    </form>
    <?php else: ?>
    <p>Seu carrinho está vazio.</p>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
