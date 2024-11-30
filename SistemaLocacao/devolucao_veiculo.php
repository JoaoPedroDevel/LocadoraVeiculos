<!-- Formulário de devolução -->
<h2>
    Devolução
</h2>
<form method="POST" action="registrar_devolucao.php">
    <label for="id_locacao">ID da Locação:</label>
    <input type="text" id="id_locacao" name="id_locacao" required><br>
    <br>
    <label for="data_devolucao">Data da Devolução:</label>
    <input type="date" id="data_devolucao" name="data_devolucao" required><br>
    <br>
    <input type="submit" value="Registrar Devolução">
</form>
<br>
<a href="index.php"><button>Voltar para página inicial</button></a>