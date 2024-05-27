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
</head>
<body>
    <form method="post" action="edit_product.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
        <label>Nome:</label>
        <input type="text" name="name" value="<?php echo $product['name']; ?>" required>
        <label>Preço:</label>
        <input type="text" name="price" value="<?php echo $product['price']; ?>" required>
        <label>Quantidade:</label>
        <input type="text" name="quantity" value="<?php echo $product['quantity']; ?>" required>
        <label>Imagem:</label>
        <input type="file" name="image">
        <button type="submit">Atualizar</button>
    </form>
</body>
</html>
