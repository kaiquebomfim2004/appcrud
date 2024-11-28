<?php
session_start();

// Verifica se foi redirecionado após finalizar a compra
if (!isset($_SESSION['carrinho_finalizado']) || $_SESSION['carrinho_finalizado'] !== true) {
    header("Location: principal.php");
    exit();
}

// Limpa a flag de finalização para evitar acesso posterior
unset($_SESSION['carrinho_finalizado']);

// Limpa o carrinho após finalizar a compra
unset($_SESSION['carrinho']);

include 'header.php';
?>

<div class="container py-5 text-center">
    <h2>Compra Finalizada com Sucesso!</h2>
    <p class="mt-3">Obrigado por comprar conosco! Seu pedido foi processado com sucesso.</p>

    <div class="mt-4">
        <a href="principal.php" class="btn btn-primary">Voltar aos Produtos</a>
        <a href="index.php" class="btn btn-secondary">Página Inicial</a>
    </div>
</div>

<?php include 'footer.php'; ?>
