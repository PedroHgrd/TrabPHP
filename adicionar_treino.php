<?php
session_start();
require_once("conexao.php");

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST['data'];
    $descricao = $_POST['descricao'];
    $usuario_id = $_SESSION['usuario_id'];

    $sql = "INSERT INTO treinos (usuario_id, data, descricao) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $usuario_id, $data, $descricao);
    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        $erro = "Erro ao adicionar o treino: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Adicionar Treino</title>
    <link rel="stylesheet" type="text/css" href="style.css">

    <link rel="stylesheet" type="text/css" href="agenda.css">
</head>
<body>
    <div class="container">
        <h1>Adicionar Treino</h1>
        <a href="index.php">Voltar para a Agenda</a>
        <h2>Preencha os Detalhes do Treino</h2>
        <?php if (isset($erro)) { echo '<p class="erro">' . $erro . '</p>'; } ?>
        <form method="post" action="adicionar_treino.php">
            <label>Data:</label>
            <input type="date" name="data" required><br>
            <label>Descrição:</label>
            <textarea name="descricao" required></textarea><br>
            <input type="submit" value="Adicionar Treino">
        </form>
    </div>
</body>
</html>
