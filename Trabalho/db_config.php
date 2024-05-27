<?php
$servername = "localhost";
$username = "root";  // Usuário padrão do MySQL no XAMPP
$password = "";      // Senha padrão do MySQL no XAMPP (geralmente em branco)
$dbname = "ecommerce";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>