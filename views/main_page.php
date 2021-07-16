<!<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>SHOP</title>
</head>
<body>
<?php
$db = DB::getInstance();
$getAll = $db->getConnection()->prepare("SELECT * FROM products");
$getAll->execute();
$products = $getAll->fetchAll();
?>
<form action = "/?action=order" method="post" >
<table style="border:1px solid">
<tr>
    <th>Name</th>
    <th>Description</th>
    <th>Price</th>
    <th>Quantity</th>
<?php foreach($products as $product) {?>
    <tr>
        <td><?php echo $product['name']?></td>
        <td><?php echo $product['description']?></td>
        <td><?php echo $product['price']?>
        <td><input type="number" value=0 name="qty[<?=$product['id']?>]" "style="width: 60px"></td>
    </tr>
    <?php } ?>
</table>
<button type="submit" style="margin-top: 10px" >ORDER</button>
</form>
<form action = "/?action=addproduct" method="post">
<button type="submit" style="margin-top: 10px">ADD PRODUCT</button>
</form>
</body>
</html>
