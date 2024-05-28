<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include 'db_config.php';

$salesData = [];
$sql = "SELECT DATE(order_date) as order_date, SUM(total_price) as total_sales FROM orders GROUP BY DATE(order_date)";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $salesData[] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Relatório de Vendas</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <style>
        #salesChart {
            width: 100%;
            min-height: 400px;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul class="navbar">
                <li><a href="dashboard.php">Home</a></li>
                <li><a href="add_product.php">Cadastrar Produto</a></li>
                <li><a href="view_products.php">Visualizar Produtos</a></li>
                <li><a href="add_sale.php">Registrar Venda</a></li>
                <li><a href="sales_report.php">Relatório de Vendas</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="container">
            <h1>Relatório de Vendas</h1>
            <div id="salesChart"></div>
            <script>
                // Preparar os dados do PHP para JavaScript
                var salesData = <?php echo json_encode($salesData); ?>;

                // Extrair datas e valores das vendas
                var dates = salesData.map(function(data) { return data.order_date; });
                var sales = salesData.map(function(data) { return data.total_sales; });

                var trace = {
                    x: dates,
                    y: sales,
                    type: 'scatter'
                };

                var data = [trace];

                var layout = {
                    title: 'Relatório de Vendas',
                    xaxis: {
                        title: 'Data'
                    },
                    yaxis: {
                        title: 'Total de Vendas'
                    },
                    margin: {
                        t: 50
                    }
                };

                Plotly.newPlot('salesChart', data, layout);
            </script>
        </div>
    </main>
</body>
</html>
