<?php

session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = $_POST['password'];

    // Verifica se o usuário existe
    $stmt = $pdo->prepare("SELECT id, password FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$username, $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Autenticação bem-sucedida
        $_SESSION['user_id'] = $user['id'];
        session_regenerate_id(true); // Regenera o ID da sessão
        header("Location: listar.php"); // Redireciona para a página do usuário
        exit;
    } else {
        $error = "Nome de usuário ou senha incorretos.";
    }
}




// Define o tempo de expiração da sessão (em segundos)
$sessionLifetime = 1800; // 30 minutos

// Verifica se a sessão está ativa e se o tempo de expiração foi atingido
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $sessionLifetime)) {
    session_unset(); // Limpa a sessão
    session_destroy(); // Destroi a sessão
    header("Location: login.php"); // Redireciona para a página de login
    exit;
}
$_SESSION['LAST_ACTIVITY'] = time(); // Atualiza o tempo da última atividade

?>




<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles-login.css">
</head>



<body>

<div class="navbar">
        <div class="menu-icon">&#9776;</div>
        <div class="menu">
            <a href="#">Sobre Nós</a>
            <a href="#">Ajuda</a>
            <a href="index.php">voltar</a>
        </div>
    </div>



    <div class="login-container">
        <h1>Login</h1>
        <?php if (isset($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST" class="login-form">
            <label for="username">Nome de Usuário ou Email:</label>
            <input type="text" id="username" name="username" required autocomplete="off">
            
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required autocomplete="new-password">
            
            <button type="submit">Login</button>
        </form>
        <div class="links">
            <a href="register.php">Registrar</a> | <a href="recover.php">Recuperar Senha</a>
        </div>
    </div>


    <script src="script.js"></script>
</body>
</html>