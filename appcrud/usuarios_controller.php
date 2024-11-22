<?php
include 'db.php';

// Função para salvar o usuário
function saveUser($nome, $telefone, $email, $senha) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, telefone, email, senha) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nome, $telefone, $email, $senha);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Função para listar todos os usuários
function getUsers() {
    global $conn;
    $result = $conn->query("SELECT id, nome, telefone, email FROM usuarios");
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Processar o formulário de cadastro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Dados do formulário
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Hashing da senha

    // Chamar a função para salvar o usuário
    if (saveUser($nome, $telefone, $email, $senha)) {
        echo "Novo registro criado com sucesso";
    } else {
        echo "Erro ao criar o registro";
    }
}
?>
