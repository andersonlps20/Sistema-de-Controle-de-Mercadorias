<?php
// Codigo resrvado para buscar o nome do procuto na tela de entrada e saida de mercadorias
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT nome FROM mercadorias WHERE id = ?");
    $stmt->execute([$id]);
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($produto) {
        echo json_encode(['nome' => $produto['nome']]);
    } else {
        echo json_encode(['nome' => null]);
    }
} else {
    echo json_encode(['nome' => null]);
}
?>