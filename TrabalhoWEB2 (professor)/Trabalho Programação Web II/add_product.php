<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $image = $_FILES['image']['name'];
    $target = "images/".basename($image);
    $sql = "INSERT INTO products (name, price, quantity, image) VALUES ('$name', '$price', '$quantity', '$image')";
    if (mysqli_query($conn, $sql)) {
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        echo "Produto cadastrado com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cadastrar Produto</title>
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
            <h1>Cadastrar Produto</h1>
            <form method="post" action="add_product.php" enctype="multipart/form-data">
                <label for="name">Nome:</label>
                <input type="text" name="name" id="name" required>
                <label for="price">Preço:</label>
                <input type="text" name="price" id="price" required>
                <label for="quantity">Quantidade:</label>
                <input type="text" name="quantity" id="quantity" required>
                <label for="image">Imagem:</label>
                <input type="file" name="image" id="image" required>
                <button type="submit">Cadastrar</button>
            </form>
        </div>
    </main>
</body>
</html>
