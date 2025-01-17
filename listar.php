<?php
include 'db.php';

$stmt = $pdo->query("SELECT * FROM mercadorias");
$mercadorias = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Listar Mercadorias</title>

    <link rel="stylesheet" href="styles.css">

</head>
<body>


<div class="navbar">
        <div class="menu-icon">&#9776;</div>
        <div class="menu">
            <a href="cadastrar.php">Cadastrar Mercadoria</a>
            <a href="entrada.php">Registrar Entrada</a>
            <a href="saida.php">Registrar Saída</a>
            <a href="#" style="color:rgb(255, 255, 255); background-color: #494a49; cursor:default;">Listar Mercadorias</a>
            <a href="#">Configurações</a>
            <a href ="#">Relatórios</a>
            <a href="login.php" style="color:rgb(255, 255, 255); background-color:rgb(29, 0, 172);">Login</a>
        </div>
    </div>



    <h1>Listagem de Mercadorias</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Quantidade</th>
        </tr>
        <?php foreach ($mercadorias as $mercadoria): ?>
        <tr>
            <td><?php echo $mercadoria['id']; ?></td>
            <td><?php echo $mercadoria['nome']; ?></td>
            <td><?php echo $mercadoria['quantidade']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <script src="script.js"></script>
</body>
</html>