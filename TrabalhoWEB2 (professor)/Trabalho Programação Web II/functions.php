<?php
function connectDB() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lanchonete";

    // Criar conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    return $conn;
}

function getProducts() {
    $conn = connectDB();
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);

    $products = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }

    $conn->close();
    return $products;
}

function getProductById($id) {
    $conn = connectDB();
    $sql = "SELECT * FROM products WHERE id = $id";
    $result = $conn->query($sql);
    $product = null;

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    }

    $conn->close();
    return $product;
}
?>
