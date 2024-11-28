<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

$nome = $_SESSION['nome'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Página Principal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container mt-5">
        <h2>Olá, <?php echo htmlspecialchars($nome); ?>!</h2>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>