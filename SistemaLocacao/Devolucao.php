<?php
require_once 'Locacao.php';
require_once 'Veiculo.php';

class Devolucao {
    private $pdo;
    private $id_locacao;
    private $data_devolucao;
    private $quantidade_dias;

    // Construtor
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Registrar devolução
    public function registrarDevolucao($id_locacao, $data_devolucao) {
        // Obter a locação
        $locacao = $this->getLocacaoById($id_locacao);
        if (!$locacao) {
            echo "Locação não encontrada.";
            return;
        }

        // Verificar se a data de devolução não é anterior à data de locação
        if (strtotime($data_devolucao) < strtotime($locacao['data_locacao'])) {
            echo "A data de devolução não pode ser anterior à data da locação.";
            return;
        }

        // Calcular os dias de locação
        $this->calcularDiasLocacao($locacao['data_locacao'], $data_devolucao);

        // Atualizar o estoque de veículos
        $this->atualizarEstoque($locacao['id_veiculo']);

        // Finalizar a locação (alterar status e data_devolucao)
        $this->finalizarLocacao($id_locacao, $data_devolucao);

        echo "Devolução registrada com sucesso! Quantidade de dias: " . $this->quantidade_dias;
    }

    // Método para obter a locação pelo ID
    private function getLocacaoById($id_locacao) {
        $sql = "SELECT * FROM locacoes WHERE id_locacao = :id_locacao";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_locacao', $id_locacao);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Calcular o número de dias entre a data de locação e a data de devolução
    private function calcularDiasLocacao($data_locacao, $data_devolucao) {
        $data_inicio = new DateTime($data_locacao);
        $data_fim = new DateTime($data_devolucao);
        $intervalo = $data_inicio->diff($data_fim);

        $this->quantidade_dias = $intervalo->days;
    }

    // Atualizar o estoque de veículos após devolução
    private function atualizarEstoque($id_veiculo) {
        $sql = "UPDATE veiculos SET estoque = estoque + 1 WHERE id_veiculo = :id_veiculo";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_veiculo', $id_veiculo);
        return $stmt->execute();
    }

    // Finalizar a locação (alterar status para 'finalizada' e registrar a data de devolução)
    private function finalizarLocacao($id_locacao, $data_devolucao) {
        $sql = "UPDATE locacoes SET status = 'finalizada', data_devolucao = :data_devolucao WHERE id_locacao = :id_locacao";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_locacao', $id_locacao);
        $stmt->bindParam(':data_devolucao', $data_devolucao);
        return $stmt->execute();
    }
}
?>
