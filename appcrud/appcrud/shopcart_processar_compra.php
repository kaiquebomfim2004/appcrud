<?php
session_start();
include 'db.php';  // Certifique-se de incluir o arquivo de conexão com o banco de dados
include 'shopcart_controller.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

// Pega o ID do usuário
$id_usuario = $_SESSION['id'];  // Supondo que o ID do usuário esteja armazenado na sessão

// Função para salvar o pedido
function salvarPedido($carrinho, $total, $id_usuario) {
    global $conn;

    // Insere o pedido no banco
    $data_pedido = date('Y-m-d H:i:s');
    $sql = "INSERT INTO pedidos (id_usuario, total, data_pedido) VALUES ('$id_usuario', '$total', '$data_pedido')";
    if ($conn->query($sql) === TRUE) {
        $pedido_id = $conn->insert_id;  // Obtém o ID do pedido inserido
        
        // Insere os itens do pedido
        foreach ($carrinho as $id_produto => $item) {
            $produto_id = $item['id_produto'];
            $quantidade = $item['quantidade'];
            $subtotal = $item['subtotal'];
            
            $sql_item = "INSERT INTO itens_pedido (pedido_id, produto_id, quantidade, subtotal) VALUES ('$pedido_id', '$produto_id', '$quantidade', '$subtotal')";
            if ($conn->query($sql_item) === FALSE) {
                // Se falhar, reverte o pedido
                throw new Exception("Erro ao inserir item do pedido: " . $conn->error);
            }
        }
        
        return true;
    } else {
        throw new Exception("Erro ao inserir pedido: " . $conn->error);
    }
}

// Verifica se a ação de finalizar foi acionada
if (isset($_POST['acao']) && $_POST['acao'] == 'finalizar') {
    $total = calcularTotalCarrinho();  // Calcula o total do carrinho
    $erro = salvarPedido($_SESSION['carrinho'], $total, $id_usuario);

    if ($erro === true) {
        // Limpa o carrinho após finalizar a compra
        unset($_SESSION['carrinho']);

        // Redireciona para a página de sucesso
        header("Location: shopcart_sucesso_compra.php");
        exit();
    } else {
        // Em caso de erro, redireciona para a página de erro
        $_SESSION['erro_compra'] = $erro;  // Armazena o erro na sessão
        header("Location: shopcart_erro_compra.php");
        exit();
    }
} else {
    // Se não for uma ação válida, redireciona para a página inicial
    header("Location: principal.php");
    exit();
}
?>
