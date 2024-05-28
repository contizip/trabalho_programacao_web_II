<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include 'db_config.php';

$id = $_GET['id'];
$sql = "SELECT * FROM products WHERE id = $id";
$result = mysqli_query($conn, $sql);
$product = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $image = $_FILES['image']['name'];
    $target = "images/".basename($image);
    
    if (!empty($image)) {
        $sql = "UPDATE products SET name='$name', price='$price', quantity='$quantity', image='$image' WHERE id=$id";
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    } else {
        $sql = "UPDATE products SET name='$name', price='$price', quantity='$quantity' WHERE id=$id";
    }
    
    if (mysqli_query($conn, $sql)) {
        echo "Produto atualizado com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Editar Produto</title>
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
            <h1>Editar Produto</h1>
            <form method="post" action="edit_product.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
                <label for="name">Nome:</label>
                <input type="text" name="name" id="name" value="<?php echo $product['name']; ?>" required>
                <label for="price">Preço:</label>
                <input type="text" name="price" id="price" value="<?php echo $product['price']; ?>" required>
                <label for="quantity">Quantidade:</label>
                <input type="text" name="quantity" id="quantity" value="<?php echo $product['quantity']; ?>" required>
                <label for="image">Imagem:</label>
                <input type="file" name="image" id="image">
                <button type="submit">Atualizar</button>
            </form>
        </div>
    </main>
</body>
</html>
