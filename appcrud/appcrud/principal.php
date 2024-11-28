<?php
include 'db.php';
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

// Obtém produtos do banco
function getProdutos() {
    global $conn;
    $query = "SELECT * FROM produtos";
    $result = $conn->query($query);
    return $result->fetch_all(MYSQLI_ASSOC);
}

$produtos = getProdutos();
include 'header.php';
?>

<div class="container py-4">
    <div class="row">
        <?php foreach ($produtos as $produto): ?>
        <div class="col-md-4 mb-3">
            <div class="card">
                <img src="<?php echo $produto['url_img']; ?>" class="card-img-top" alt="Imagem">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($produto['nome']); ?></h5>
                    <p class="card-text">R$ <?php echo number_format($produto['valorunitario'], 2, ',', '.'); ?></p>
                    <form method="POST" action="shopcart_controller.php">
                        <input type="hidden" name="id_produto" value="<?php echo $produto['id']; ?>">
                        <button type="submit" name="adicionar" class="btn btn-primary btn-block">Adicionar ao Carrinho</button>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'footer.php'; ?>
