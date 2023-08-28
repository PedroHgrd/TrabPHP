<?php
session_start();
require_once("conexao.php");

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $treino_id = $_GET['id'];
    $usuario_id = $_SESSION['usuario_id'];

    // Verificar se o treino pertence ao usuário antes de excluir
    $sql = "DELETE FROM treinos WHERE id = $treino_id AND usuario_id = $usuario_id";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        $erro = "Erro ao excluir o treino: ";
    }
}

$conn->close();
?>
