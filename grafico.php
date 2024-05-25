<?php
session_start();
if (!isset($_SESSION['user'])) {
header("Location: login.php");
exit();
}
include 'db_config.php';
$salesData = [];
$sql = "SELECT DATE(order_date) as order_date, SUM(total_price) as
total_sales FROM orders GROUP BY DATE(order_date)";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
$salesData[] = $row;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Relatório de Vendas</title>
<script src="https://cdn.jsdelivr.net/npm/chart