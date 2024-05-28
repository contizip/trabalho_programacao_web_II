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
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
<div class="container">
    <h1>Bem-vindo ao Painel Administrativo</h1>
    <div class="nav">
        <a href="add_product.php">Cadastrar Produto</a>
        <a href="view_products.php">Visualizar Produtos</a>
        <a href="sales_report.php">Relatório de Vendas</a>
        <a href="logout.php">Logout</a>
    </div>
</div>
</body>
</html>
