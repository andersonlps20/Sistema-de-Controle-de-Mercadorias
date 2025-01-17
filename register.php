<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $repeat_password = $_POST['repeat_password'];

    // Verifica se as senhas coincidem
    if ($password !== $repeat_password) {
        echo "As senhas não coincidem.";
        exit;
    }

    // Hash da senha
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insere o novo usuário no banco de dados
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$username, $email, $hashedPassword]);

    echo "Usuário registrado com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Registrar</title>
    <link rel="stylesheet" href="styles-login.css">
</head>
<body>

<div class="navbar">
    <div class="menu-icon">&#9776;</div>
    <div class="menu">
        <a href="#">Sobre Nós</a>
        <a href="#">Ajuda</a>
    </div>
</div>
<br><br><br>


<h1>Registrar</h1>
<form method="POST" id="registerForm">
    <label>Nome de Usuário:</label>
    <input type="text" name="username" required  autocomplete="off">
    <br>
    <label>Email:</label>
    <input type="email" name="email" required autocomplete="off">
    <br>
    <label>Senha:</label>
    <input type="password" name="password" id="password" required autocomplete="new-password">
    <br>
    <label>Repetir Senha:</label>
    <input type="password" name="repeat_password" id="repeat_password" required autocomplete="off">
    <br>
    <div id="passwordError" class="error-message" style="display: none;">As senhas não coincidem.</div>
    <button type="submit">Registrar</button>
    <br><br>
    <a id="voltar-login" href="login.php">Voltar ao Login</a>
</form>

<script src="script.js"></script>
<script>
    // Validação de senha
    document.getElementById('registerForm').addEventListener('submit', function(event) {
        const password = document.getElementById('password').value;
        const repeatPassword = document.getElementById('repeat_password').value;
        const passwordError = document.getElementById('passwordError');

        if (password !== repeatPassword) {
            passwordError.style.display = 'block';
            event.preventDefault(); // Impede o envio do formulário
        } else {
            passwordError.style.display = 'none';
        }
    });
</script>

</body>
</html>