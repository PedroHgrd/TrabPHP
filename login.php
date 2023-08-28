<?php
require_once("conexao.php");
session_start();
$sessionTimeout = 1800;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consulta o banco de dados para verificar as credenciais
    $sql = "SELECT id, nome, senha FROM usuarios WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if ($senha === $row['senha']) {
            $_SESSION['usuario_id'] = $row['id'];
            $_SESSION['usuario_nome'] = $row['nome'];
            header("Location: index.php");
            exit();
        } else {
            $erro = "Credenciais inválidas. Tente novamente.";
        }
    } else {
        $erro = "Usuário não encontrado.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
    
    <?php if (isset($erro)) { echo '<p style="color: red;">' . $erro . '</p>'; } ?>
    <form method="post" action="login.php">
    <h1>GymDesk</h1>
    <h2>Login</h2>
    
        <label>Email:</label>
        <input type="email" name="email" required><br>
        <label>Senha:</label>
        <input type="password" name="senha" required><br>
        <input type="submit" value="Entrar">
        <p>Não tem uma conta? <a href="cadastro.php">Cadastre-se</a></p>
    </form>
    
</body>
</html>
