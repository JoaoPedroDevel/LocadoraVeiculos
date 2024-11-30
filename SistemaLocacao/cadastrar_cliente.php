<?php
// Incluindo a classe Cliente
require_once 'Cliente.php';

// Criando a conexão com o banco de dados (a conexão PDO)
$pdo = new PDO('mysql:host=localhost;dbname=locadora_veiculos', 'root', '');

// Criando a instância da classe Cliente
$cliente = new Cliente($pdo);

// Verificando se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebendo os dados do formulário
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $data_nascimento = $_POST['data_nascimento'];

    // Cadastrando o cliente
    if ($cliente->cadastrar($nome, $cpf, $data_nascimento)) {
        echo "Cliente cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar cliente!";
    }
}
?>
<br>
<a href="index.php"><button>Voltar para página inicial</button></a>