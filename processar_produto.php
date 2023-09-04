<?php
session_start();
include_once 'sanitizar.php';

// Sanitização dos dados do Formulário
$dadosform = sanitizar($_POST);

$errovalidacao = false;

// Aplicar a Validação dos Dados segundo as regras de negócio
if (empty($dadosform['preco'])) {
    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Verifique os Campos em Vermelho.</div>';
    $_SESSION['erropreco'] = 'Este campo deve ser preenchido';
    $errovalidacao = true;
}

if ($errovalidacao) { // Houve erro na validação
    // Guarda os dados do POST na Session para reapresentar os dados
    $_SESSION['form'] = $dadosform;

    if (isset($dadosform['id'])) {
        header("Location: editarProduto.php?id=" . $dadosform['id']); // Retorna à página de edição
    } else {
        header("Location: cadastrarProdutos.php"); // Retorna à página de cadastro
    }

    die(); // Isso é necessário senão ele vai continuar e cadastrar o produto!!!
}

// Credenciais para conexão com o Banco
$dbhost = 'localhost:3306';
$dbuser = 'root';
$dbpass = '';
$dbname = 'crudproduto';

// Abre conexão com o MySQL   
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
    die('Falha ao conectar com o MySQL: ' . $conn->connect_error);
}

// Altera a codificação de caracteres para utf8
$conn->set_charset("utf8");

if (isset($dadosform['id'])) {
    // Estamos editando um produto existente
    $idProduto = $dadosform['id'];

    $nome = $dadosform["nome"];
    $descricao = $dadosform["descricao"];
    $preco = $dadosform["preco"];
    $quantidade = $dadosform["quantidade"];

    $sql = "UPDATE Produto SET nome='$nome', descricao='$descricao', preco='$preco', quantidade='$quantidade' WHERE id='$idProduto'";
} else {
    // Estamos cadastrando um novo produto
    $nome = $dadosform["nome"];
    $descricao = $dadosform["descricao"];
    $preco = $dadosform["preco"];
    $quantidade = $dadosform["quantidade"];

    $sql = "INSERT INTO Produto(nome, descricao, preco, quantidade) VALUES('$nome', '$descricao', '$preco', '$quantidade')";
}

$result = mysqli_query($conn, $sql); // A query seleciona as linhas da Tabela

if ($result) {
    $_SESSION['success_msg'] = 'Produto ' . (isset($dadosform['id']) ? 'editado' : 'cadastrado') . ' com sucesso.';
} else {
    $_SESSION['error_msg'] = 'Erro ao ' . (isset($dadosform['id']) ? 'editar' : 'cadastrar') . ' o produto.';
}

// Redirecionamento
if (isset($dadosform['id'])) {
    header("Location: editarProduto.php?id=" . $dadosform['id']);
} else {
    header("Location: cadastrarProduto.php");
}
?>