<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente</title>
</head>
<body>
    <h2>Cadastro de Cliente</h2>
    <form action="cadastrar_cliente.php" method="POST">
        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" required pattern="\d{11}" title="Digite um CPF válido (11 dígitos)"><br><br>
        
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>
        
        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" id="data_nascimento" name="data_nascimento" required><br><br>
        
        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" required><br><br>
        
        <input type="submit" value="Cadastrar Cliente">
    </form>
</body>
</html>
<br>
<a href="index.php"><button>Voltar para página inicial</button></a>