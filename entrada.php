<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $quantidade = $_POST['quantidade'];

    $stmt = $pdo->prepare("UPDATE mercadorias SET quantidade = quantidade + ? WHERE id = ?");
    $stmt->execute([$quantidade, $id]);

    echo "Entrada registrada com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Registrar Entrada</title>

    <link rel="stylesheet" href="styles.css">
    
</head>
<body>

<div class="navbar">
        <div class="menu-icon">&#9776;</div>
        <div class="menu">
            <a href="cadastrar.php">Cadastrar Mercadoria</a>
            <a href="#" style="color:rgb(255, 255, 255); background-color: #494a49; cursor:default;">Registrar Entrada</a>
            <a href="saida.php">Registrar Saída</a>
            <a href="listar.php">Listar Mercadorias</a>
            <a href="#">Configurações</a>
            <a href ="#">Relatórios</a>
            <a href="login.php" style="color:rgb(255, 255, 255); background-color:rgb(29, 0, 172);">Login</a>
        </div>
    </div>



    <h1>Registrar Entrada de Mercadoria</h1>
    <form method="POST">
        <label>ID da Mercadoria:</label>
        <input type="number" name="id" required>

        <label>Nome do Produto:</label>
        <div id="nomeProduto" style="margin-bottom: 15px; color: green;"></div>

        <br>
        <label>Quantidade:</label>
        <input type="number" name="quantidade" required>
        <br>
        <button type="submit">Registrar Entrada</button>
    </form>

    <script src="script.js"></script>


    <script>
    //Area do Script para buscar nome doS prudutoS e print na tela ao digitar o ID pelo usuario.
document.addEventListener('DOMContentLoaded', function() {
    const idInput = document.querySelector('input[name="id"]');
    const nomeProduto = document.getElementById('nomeProduto'); 

    idInput.addEventListener('input', function() {
        const id = this.value;

        if (id) {
            fetch(`buscar_nome.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.nome) {
                        nomeProduto.textContent = data.nome; 
                    } else {
                        nomeProduto.textContent = 'Produto não encontrado.';
                    }
                })
                .catch(error => {
                    console.error('Erro ao buscar Nome:', error);
                    nomeProduto.textContent = 'Erro ao buscar Nome.';
                });
        } else {
            nomeProduto.textContent = '';
        }
    });
});
</script>


</body```php
</html>