<?php
require_once 'Locacao.php';
require_once 'Cliente.php';
require_once 'Veiculo.php';

try {
    // Verificar se o formulário foi submetido
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Conectar ao banco de dados (substitua os parâmetros conforme necessário)
        $pdo = new PDO('mysql:host=localhost;dbname=locadora_veiculos', 'root', '');

        // Recebe os dados do formulário
        $id_cliente = $_POST['id_cliente'];  // ID do cliente
        $id_veiculo = $_POST['id_veiculo'];  // ID do veículo
        $data_locacao = $_POST['data_locacao'];  // Data da locação
        $data_devolucao = $_POST['data_devolucao'];  // Data da devolução

        // Cria uma instância da classe Locacao
        $locacao = new Locacao($pdo);

        // Registrar a locação
        $locacao->registrarLocacao($id_cliente, $id_veiculo, $data_locacao, $data_devolucao);
    }
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}
?>

<a href="index.php"><button>Voltar para página inicial</button></a>