<?php
class Veiculo {
    private $pdo;

    public $placa;
    public $marca;
    public $modelo;
    public $cor;
    public $ano_fabricacao;
    public $categoria;
    public $estoque;

    // Construtor
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function controleEstoque($estoque) {
        // Verificando se o valor de estoque é numérico e não negativo
        if (!is_numeric($estoque)) {
            throw new InvalidArgumentException("O valor de estoque deve ser um número.");
        }
    
        if ($estoque < 0) {
            throw new InvalidArgumentException("Você não pode usar um número negativo!");
        }
    }

    // Função para cadastrar um veículo no banco de dados
    public function cadastrar() {
        // SQL para inserir um novo veículo na tabela
        $sql = "INSERT INTO veiculos (placa, marca, modelo, cor, ano_fabricacao, categoria, estoque)
                VALUES (:placa, :marca, :modelo, :cor, :ano_fabricacao, :categoria, :estoque)";
        
        if ($this->estoque < 0) {
            die("Erro: O estoque não pode ser negativo!");
        }

        // Preparando a consulta
        $stmt = $this->pdo->prepare($sql);
        
        // Vinculando os parâmetros
        $stmt->bindParam(':placa', $this->placa);
        $stmt->bindParam(':marca', $this->marca);
        $stmt->bindParam(':modelo', $this->modelo);
        $stmt->bindParam(':cor', $this->cor);
        $stmt->bindParam(':ano_fabricacao', $this->ano_fabricacao);
        $stmt->bindParam(':categoria', $this->categoria);
        $stmt->bindParam(':estoque', $this->estoque);

        // Executando a consulta e retornando o resultado
        return $stmt->execute();
    }
    
    public function atualizarEstoque($id_veiculo, $estoque) {
        // Verifica se o estoque é válido antes de atualizar
        $this->controleEstoque($estoque);

        // SQL para atualizar estoque
        $sql = "UPDATE veiculos SET estoque = :estoque WHERE id_veiculo = :id_veiculo";
        $stmt = $this->pdo->prepare($sql);
        
        // Bind dos parâmetros
        $stmt->bindParam(':estoque', $estoque);
        $stmt->bindParam(':id_veiculo', $id_veiculo);
        
        // Executa a atualização no banco
        $stmt->execute();
    }
}

