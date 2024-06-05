<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $total_price = $_POST['total_price'];

    // Verificar se o product_id existe
    $product_check_sql = "SELECT * FROM products WHERE id = '$product_id'";
    $product_check_result = mysqli_query($conn, $product_check_sql);

    if (mysqli_num_rows($product_check_result) > 0) {
        $sql = "INSERT INTO orders (product_id, quantity, total_price) VALUES ('$product_id', '$quantity', '$total_price')";
        if (mysqli_query($conn, $sql)) {
            echo "Venda registrada com sucesso!";
        } else {
            echo "Erro: " . mysqli_error($conn);
        }
    } else {
        echo "Erro: Produto com ID $product_id não existe.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registrar Venda</title>
    <link rel="stylesheet" href="css/styles.css">
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
            <h1>Registrar Venda</h1>
            <form method="post" action="add_sale.php">
                <label for="product_id">ID do Produto:</label>
                <input type="text" name="product_id" id="product_id" required>
                <label for="quantity">Quantidade:</label>
                <input type="text" name="quantity" id="quantity" required>
                <label for="total_price">Preço Total:</label>
                <input type="text" name="total_price" id="total_price" required>
                <button type="submit">Registrar Venda</button>
            </form>
        </div>
    </main>
</body>
</html>
