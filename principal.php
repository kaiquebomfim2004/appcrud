<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

$nome = $_SESSION['nome'];
?>

<?php include 'header.php'; ?>

<div class="container mt-5">
    <h2>Olá, <?php echo htmlspecialchars($nome); ?>!</h2>
    <a href="logout.php" class="btn btn-danger">Logout</a>
</div>

<?php include 'footer.php'; ?>
