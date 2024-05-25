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
</head>
<body>
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
<td><img src="images/<?php echo $row['image']; ?>"
width="50"></td>
<td>
<a href="edit_product.php?id=<?php echo $row['id'];
?>">Editar</a>
<a href="delete_product.php?id=<?php echo $row['id'];
?>">Excluir</a>
</td>
</tr>
<?php } ?>
</table>
</body>
</html>
