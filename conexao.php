<?php
$host = "localhost";
$database = "gymDesk";
$usuario = "root";
$senha = "";

$conn = new mysqli($host, $usuario, $senha, $database);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>
