<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Bem-vindo ao Painel Administrativo</h1>
    <ul>
        <li><a href="add_product.php">Cadastrar Produto</a></li>
        <li><a href="view_products.php">Visualizar Produtos</a></li>
        <li><a href="sales_report.php">Relatório de Vendas</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</body>
</html>
