<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Locação</title>
</head>
<body>
    <h2>Registro de Locação</h2>
    <form action="registrar_locacao.php" method="POST">
        <label for="id_cliente">ID do Cliente:</label>
        <input type="number" id="id_cliente" name="id_cliente" required><br><br>
        
        <label for="id_veiculo">ID do Veículo:</label>
        <input type="number" id="id_veiculo" name="id_veiculo" required><br><br>
        
        <label for="data_locacao">Data da Locação:</label>
        <input type="date" id="data_locacao" name="data_locacao" required><br><br>
        
        <label for="data_devolucao">Data de Devolução:</label>
        <input type="date" id="data_devolucao" name="data_devolucao" required><br><br>
        
        <input type="submit" value="Registrar Locação">
    </form>

    <br>
    <a href="index.php"><button>Voltar para página inicial</button></a>
</body>
</html>
