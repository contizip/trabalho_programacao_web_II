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
$sql = "INSERT INTO products (name, price, quantity, image) VALUES
('$name', '$price', '$quantity', '$image')";
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
</head>
<body>
<form method="post" action="add_product.php"
enctype="multipart/form-data">
<label>Nome:</label>
<input type="text" name="name" required>
<label>Preço:</label>
<input type="text" name="price" required>
<label>Quantidade:</label>
<input type="text" name="quantity" required>
<label>Imagem:</label>
<input type="file" name="image" required>
<button type="submit">Cadastrar</button>
</form>
</body>
</html>