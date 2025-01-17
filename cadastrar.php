<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obter o maior código de produto existente
    $stmt = $pdo->query("SELECT MAX(codigo) AS max_codigo FROM mercadorias");
    $max_codigo = $stmt->fetch(PDO::FETCH_ASSOC)['max_codigo'];

    // Converter a variável $max_codigo para um número
    $max_codigo = (int) $max_codigo;

    // Incrementar o código para criar um novo
    $codigo = ($max_codigo === null) ? 1 : $max_codigo + 1;

    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $categoria = $_POST['categoria'];
    $subcategoria = $_POST['subcategoria'];
    $marca = $_POST['marca'];
    $quantidade = $_POST['quantidade'];

    // Inserir o novo produto com o código gerado
    $stmt = $pdo->prepare("INSERT INTO mercadorias (codigo, nome, descricao, categoria, subcategoria, marca, quantidade) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$codigo, $nome, $descricao, $categoria, $subcategoria, $marca, $quantidade]);

    echo "Mercadoria cadastrada com sucesso!";
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Mercadoria</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="navbar">
    
    <div class="menu-icon">&#9776;</div>
    <div class="menu">
        <a href="#" style="color:rgb(255, 255, 255); background-color: #494a49; cursor:default;"> Cadastrar Mercadoria</a>
        <a href="entrada.php">Registrar Entrada</a>
        <a href="saida.php">Registrar Saída</a>
        <a href="listar.php">Listar Mercadorias</a>
        <a href="#">Configurações</a>
        <a href="#">Relatórios</a>
        <a href="login.php" style="color:rgb(255, 255, 255); background-color:rgb(29, 0, 172);">Login</a>
    </div>
</div>

<main>
    <h1>Cadastrar Mercadoria</h1>
    
    <form method="POST">
        <label>Código do Produto:</label>
        <input type="text" name="codigo" value="<?php echo $codigo; ?>" readonly>

        <br>
        <label>Nome do Produto:</label>
        <input type="text" name="nome" required>
        <br>
        <label>Descrição:</label>
        <textarea name="descricao" required></textarea>
        <br>
        <label>Categoria:</label>
        <input type="text" name="categoria" required>
        <br>
        <label>Subcategoria:</label>
        <input type="text" name="subcategoria" required>
        <br>
        <label>Marca:</label>
        <input type="text" name="marca" required>
        <br>
        <label>Quantidade:</label>
        <input type="number" name="quantidade" required>
        <br>
        <button type="submit">Cadastrar</button>
    </form>
</main>

<script src="script.js"></script>
</body>
</html>