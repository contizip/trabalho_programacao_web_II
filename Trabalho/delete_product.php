<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include 'db_config.php';

$id = $_GET['id'];
$sql = "DELETE FROM products WHERE id = $id";
if (mysqli_query($conn, $sql)) {
    echo "Produto excluído com sucesso!";
} else {
    echo "Erro: " . mysqli_error($conn);
}
?>

<a href="view_products.php">Voltar para a lista de produtos</a>
