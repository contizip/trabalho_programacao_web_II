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
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
<div class="container">
    <h1>Editar Produto</h1>
    <form
