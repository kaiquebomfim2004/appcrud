<?php
include 'db.php'; // Conexão com o banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Inserir dados na tabela 'usuarios'
    $sql = "INSERT INTO usuarios (nome, telefone, email, senha) VALUES ('$nome', '$telefone', '$email', '$senha')";
    if (mysqli_query($conn, $sql)) {
        echo "Usuário cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar usuário: " . mysqli_error($conn);
    }
}
?>

<?php include 'header.php'; ?>

<div class="container mt-5">
    <h2>Cadastro de Usuário</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <div class="form-group">
            <label for="telefone">Telefone:</label>
            <input type="text" class="form-control" id="telefone" name="telefone" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" class="form-control" id="senha" name="senha" required>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
</div>

<?php include 'footer.php'; ?>
