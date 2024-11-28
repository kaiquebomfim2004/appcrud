<?php
session_start(); // Inicia a sessão para poder manipular a variável $_SESSION

include 'db.php'; // Conexão com o banco de dados

// Verifica se a ID do produto foi passada pela URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Consulta o produto pelo ID
    $sql = "SELECT * FROM produtos WHERE id = $product_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Se o produto existe, recupera as informações
        $product = $result->fetch_assoc();

        // Cria um array associativo para o produto
        $product_data = array(
            'id' => $product['id'],
            'nome' => $product['nome'],
            'descricao' => $product['descricao'],
            'valorunitario' => $product['valorunitario'],
            'quantidade' => 1, // Inicializa com 1 unidade do produto
            'imagem' => $product['url_img'] // Supondo que 'url_img' é o campo que armazena a URL da imagem
        );

        // Se o carrinho ainda não foi criado, cria uma nova variável de sessão
        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = array();
        }

        // Verifica se o produto já existe no carrinho
        $found = false;
        foreach ($_SESSION['carrinho'] as $key => $item) {
            if ($item['id'] == $product_id) {
                // Se o produto já estiver no carrinho, atualiza a quantidade
                $_SESSION['carrinho'][$key]['quantidade'] += 1;
                $found = true;
                break;
            }
        }

        // Se o produto não foi encontrado, adiciona ao carrinho
        if (!$found) {
            $_SESSION['carrinho'][] = $product_data;
        }

        // Redireciona o usuário para a página do carrinho
        header('Location: carrinho.php');
        exit;
    } else {
        echo 'Produto não encontrado.';
    }
}
?>
