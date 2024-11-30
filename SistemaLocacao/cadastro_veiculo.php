<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Veículo</title>
</head>
<body>
    <h2>Cadastro de Veículo</h2>
    <form action="cadastrar_veiculo.php" method="POST">
        <label for="placa">Placa:</label>
        <input type="text" id="placa" name="placa" required pattern="[A-Z]{3}[0-9]{4}" title="Placa no formato ABC1234"><br><br>
        
        <label for="marca">Marca:</label>
        <input type="text" id="marca" name="marca" required><br><br>
        
        <label for="modelo">Modelo:</label>
        <input type="text" id="modelo" name="modelo" required><br><br>
        
        <label for="cor">Cor:</label>
        <input type="text" id="cor" name="cor" required><br><br>
        
        <label for="ano_fabricacao">Ano de Fabricação:</label>
        <input type="number" id="ano_fabricacao" name="ano_fabricacao" required min="1900" max="2023"><br><br>
        
        <label for="categoria">Categoria:</label>
        <select id="categoria" name="categoria" required>
            <option value="B">Básico (B)</option>
            <option value="I">Intermediário (I)</option>
            <option value="L">Luxo (L)</option>
        </select><br><br>
        
    <label for="estoque">Estoque:</label><br>
    <input type="number" id="estoque" name="estoque" required><br><br>

        <input type="submit" value="Cadastrar Veículo">
    </form>
</body>
</html>
<br>
<a href="index.php"><button>Voltar para página inicial</button></a>