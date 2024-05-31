<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include 'db_config.php';

$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Visualizar Produtos</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 18px;
            text-align: left;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .container {
            margin: 20px auto;
            padding: 20px;
            max-width: 1200px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            background-color: #fff;
        }
        img {
            width: 100px; /* Aumentei o tamanho da imagem */
            border-radius: 5px;
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
            <h1>Lista de Produtos</h1>
            <table>
                <tr>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Imagem</th>
                    <th>Ações</th>
                </tr>
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><img src="images/<?php echo $row['image']; ?>" width="100"></td> <!-- Aumentei o tamanho da imagem -->
                    <td>
                        <a href="edit_product.php?id=<?php echo $row['id']; ?>">Editar</a>
                        <a href="delete_product.php?id=<?php echo $row['id']; ?>">Excluir</a>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </main>
</body>
</html>
