<?php
include 'db.php'; // Conexão com o banco de dados

// Função para listar todos os usuários
function getUsers() {
    global $conn;
    $result = $conn->query("SELECT id, nome, telefone, email FROM usuarios");
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Processar o formulário de cadastro
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'cadastrar') {
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Hashing da senha

    // Inserir dados na tabela 'usuarios'
    $sql = "INSERT INTO usuarios (nome, telefone, email, senha) VALUES ('$nome', '$telefone', '$email', '$senha')";
    if (mysqli_query($conn, $sql)) {
        echo "Usuário cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar usuário: " . mysqli_error($conn);
    }
}

// Processar o formulário de edição
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'editar') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];

    // Atualizar dados na tabela 'usuarios'
    $sql = "UPDATE usuarios SET nome='$nome', telefone='$telefone', email='$email' WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo "Usuário atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar usuário: " . mysqli_error($conn);
    }
}

// Processar a exclusão de usuário
if (isset($_GET['action']) && $_GET['action'] == 'apagar') {
    $id = $_GET['id'];

    // Apagar dados na tabela 'usuarios'
    $sql = "DELETE FROM usuarios WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo "Usuário apagado com sucesso!";
    } else {
        echo "Erro ao apagar usuário: " . mysqli_error($conn);
    }
}

$usuarios = getUsers();
?>

<?php include 'header.php'; ?>

<div class="container mt-5">
    <h2>Cadastro de Usuário</h2>
    <form method="POST" action="">
        <input type="hidden" name="action" value="cadastrar">
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

    <h2 class="mt-5">Usuários Cadastrados</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?php echo htmlspecialchars($usuario['nome']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['telefone']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                    <td>
                        <a href="?action=editar&id=<?php echo $usuario['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="?action=apagar&id=<?php echo $usuario['id']; ?>" class="btn btn-danger btn-sm">Apagar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
