<?php
require_once 'Database.php'; // Conexão com o banco de dados

class Cliente {
    private $id_cliente;
    private $nome;
    private $cpf;
    private $data_nascimento;
    private $pdo;

    // Construtor da classe
    public function __construct($pdo) {
        $this->pdo = $pdo; // Armazenando a conexão PDO
    }

    // Método para cadastrar um cliente
    public function cadastrar($nome, $cpf, $data_nascimento) {
        // Verificando se o cliente já existe (pelo CPF)
        if ($this->verificarCpfExistente($cpf)) {
            echo "CPF já cadastrado!";
            return false;
        }

        // SQL para inserir um novo cliente no banco de dados
        $sql = "INSERT INTO clientes (nome, cpf, data_nascimento) VALUES (:nome, :cpf, :data_nascimento)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':data_nascimento', $data_nascimento);
        
        // Executando a query e verificando se a inserção foi bem-sucedida
        if ($stmt->execute()) {
            echo "Cliente cadastrado com sucesso!";
            return true;
        } else {
            echo "Erro ao cadastrar cliente.";
            return false;
        }
    }

    // Método para verificar se o CPF já está cadastrado
    private function verificarCpfExistente($cpf) {
        $sql = "SELECT * FROM clientes WHERE cpf = :cpf";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    // Método para obter um cliente pelo ID
    public function obterPorId($id_cliente) {
        $sql = "SELECT * FROM clientes WHERE id_cliente = :id_cliente";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_cliente', $id_cliente);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para listar todos os clientes
    public function listarClientes() {
        $sql = "SELECT * FROM clientes";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Método para atualizar os dados do cliente
    public function atualizar($id_cliente, $nome, $cpf, $data_nascimento) {
        $sql = "UPDATE clientes SET nome = :nome, cpf = :cpf, data_nascimento = :data_nascimento WHERE id_cliente = :id_cliente";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_cliente', $id_cliente);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':data_nascimento', $data_nascimento);
        return $stmt->execute();
    }

    // Método para excluir um cliente
    public function excluir($id_cliente) {
        $sql = "DELETE FROM clientes WHERE id_cliente = :id_cliente";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_cliente', $id_cliente);
        return $stmt->execute();
    }

    // Getters e Setters
    public function getIdCliente() {
        return $this->id_cliente;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function getDataNascimento() {
        return $this->data_nascimento;
    }

    public function setIdCliente($id_cliente) {
        $this->id_cliente = $id_cliente;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function setDataNascimento($data_nascimento) {
        $this->data_nascimento = $data_nascimento;
    }
}
?>
