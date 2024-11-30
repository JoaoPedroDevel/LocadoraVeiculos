<?php
class Locacao {
    private $pdo;
    private $id_cliente;
    private $id_veiculo;
    private $data_locacao;
    private $data_devolucao;
    private $estoque;
    private $quantidade_dias;

    // Construtor
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Verifica se o cliente é maior de 18 anos
    public function verificarIdade($id_cliente) {
        $sql = "SELECT * FROM clientes WHERE id_cliente = :id_cliente";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_cliente', $id_cliente);
        $stmt->execute();
        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($cliente) {
            $data_nascimento = new DateTime($cliente['data_nascimento']);
            $hoje = new DateTime();
            $idade = $hoje->diff($data_nascimento)->y;

            if ($idade < 18) {
                throw new Exception("O cliente precisa ser maior de 18 anos para realizar a locação.");
            }
        } else {
            throw new Exception("Cliente não encontrado.");
        }
    }

    // Verifica o estoque de veículos disponível
    public function verificarEstoque($id_veiculo) {
        $sql = "SELECT estoque FROM veiculos WHERE id_veiculo = :id_veiculo";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_veiculo', $id_veiculo);
        $stmt->execute();
        $veiculo = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($veiculo) {
            $estoque = $veiculo['estoque'];
            if ($estoque < 1) {
                throw new Exception("Não há veículos disponíveis para locação.");
            }
        } else {
            throw new Exception("Veículo não encontrado.");
        }
    }

    // Registrar locação
    public function registrarLocacao($id_cliente, $id_veiculo, $data_locacao, $data_devolucao) {
        // Verifica se o cliente é maior de 18 anos
        $this->verificarIdade($id_cliente);

        // Verifica o estoque de veículos
        $this->verificarEstoque($id_veiculo);

        // Verifica se a data de devolução é válida
        if (strtotime($data_devolucao) < strtotime($data_locacao)) {
            throw new Exception("A data de devolução não pode ser anterior à data da locação.");
        }

        // Calcula a quantidade de dias da locação
        $this->calcularDiasLocacao($data_locacao, $data_devolucao);

        // Insere a locação no banco de dados
        $sql = "INSERT INTO locacoes (id_cliente, id_veiculo, data_locacao, data_devolucao, quantidade_dias, status)
                VALUES (:id_cliente, :id_veiculo, :data_locacao, :data_devolucao, :quantidade_dias, 'ativa')";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_cliente', $id_cliente);
        $stmt->bindParam(':id_veiculo', $id_veiculo);
        $stmt->bindParam(':data_locacao', $data_locacao);
        $stmt->bindParam(':data_devolucao', $data_devolucao);
        $stmt->bindParam(':quantidade_dias', $this->quantidade_dias);

        if ($stmt->execute()) {
            // Atualiza o estoque do veículo após a locação
            $this->atualizarEstoque($id_veiculo);
            echo "Locação registrada com sucesso!";
        } else {
            throw new Exception("Erro ao registrar a locação.");
        }
    }

    // Calcular a quantidade de dias da locação
    private function calcularDiasLocacao($data_locacao, $data_devolucao) {
        $data_inicio = new DateTime($data_locacao);
        $data_fim = new DateTime($data_devolucao);
        $intervalo = $data_inicio->diff($data_fim);
        $this->quantidade_dias = $intervalo->days;
    }

    // Atualiza o estoque do veículo após a locação
    private function atualizarEstoque($id_veiculo) {
        $sql = "UPDATE veiculos SET estoque = estoque - 1 WHERE id_veiculo = :id_veiculo";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_veiculo', $id_veiculo);
        $stmt->execute();
    }
}
?>
