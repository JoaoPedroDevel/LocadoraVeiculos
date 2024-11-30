<?php
// Incluindo a classe Veiculo
require_once 'Veiculo.php';

// Criando a conexão com o banco de dados (a conexão PDO)
$pdo = new PDO('mysql:host=localhost;dbname=locadora_veiculos', 'root', '');

// Criando a instância da classe Veiculo
$veiculo = new Veiculo($pdo);

// Verificando se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebendo os dados do formulário
    $placa = $_POST['placa'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $cor = $_POST['cor'];
    $ano_fabricacao = $_POST['ano_fabricacao'];
    $categoria = $_POST['categoria'];
    $estoque = $_POST['estoque'];

    // Atribuindo os dados ao objeto veiculo
    $veiculo->placa = $placa;
    $veiculo->marca = $marca;
    $veiculo->modelo = $modelo;
    $veiculo->cor = $cor;
    $veiculo->ano_fabricacao = $ano_fabricacao;
    $veiculo->categoria = $categoria;
    $veiculo->estoque = $estoque;

    // Cadastrando o veículo
    if ($veiculo->cadastrar()) {
        echo "Veículo cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar veículo!";
    }
}
?>

<br>
<a href="index.php"><button>Voltar para página inicial</button></a>