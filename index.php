<?php
session_start();
require_once("conexao.php");

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

$sql = "SELECT * FROM treinos WHERE usuario_id = $usuario_id";
$result = $conn->query($sql);

if ($result === false) {
    die("Erro na consulta: ");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>GymDesk</title>
    <link rel="stylesheet" type="text/css" href="style.css">

    
</head>
<body>
    <div class="container">
        <h1>GymDesk</h1>
        <a href="adicionar_treino.php">Adicionar Treino</a> </br>
        
        <h2>Seus Treinos</h2>
        <ul>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <li>
                <a href="excluir_treino.php?id=<?= $row['id'] ?>">Excluir Treino</a>
                    <strong>Data:</strong> <?= $row['data'] ?><br>
                    <strong>Descrição:</strong> <?= $row['descricao'] ?>
                </li>
            <?php endwhile; ?>
        </ul>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
