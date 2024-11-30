<?php
require_once 'Devolucao.php';
require_once 'Database.php';  // Incluindo a classe de conexão com o banco de dados

// Conectar ao banco de dados usando a classe Database
$pdo = Database::connect();  // Certifique-se que essa função retorna a conexão PDO

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Criar objeto de devolução
    $devolucao = new Devolucao($pdo);

    // Receber os dados do formulário
    $id_locacao = $_POST['id_locacao'];
    $data_devolucao = $_POST['data_devolucao'];

    // Registrar a devolução
    $devolucao->registrarDevolucao($id_locacao, $data_devolucao);
}
?>