<!<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Order</title>
</head>
<body>
<form action = "http://php_mvc_mysql.loc/?action=confirm" method="post">
    <h1>YOUR ORDER</h1><br>
    <table>
        <tr>
            <td><i><b>Product</b></i></td>
            <td><i><b>Price</b></i></td>
            <td><i><b>Quantity</b></i></td>
<?php
$qtys = $_POST['qty'];
$totalSum = 0;
foreach($qtys as $productId => $qty) {
    if(!$qty) {
        continue;
    }
    else {
        $sql = "SELECT `name`, `price` FROM products WHERE id=:id ";
        $stmt = $db->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $productId);
        $stmt->execute();
        $products = $stmt->fetchAll();
?>
        <tr>
            <td><?php echo $products[0]['name']?></td>
            <td><?php echo $products[0]['price']?></td>
            <td><?php echo $qty?></td>
        </tr>
<?php }
$totalSum += $qty * $products[0]['price'];
}
?>
    </table>
    <br>
    <h4>Total Price: <?php echo $totalSum?></h4>
<input type="text" placeholder="Your Name:" name="first_name"/><br>
<input type="text" placeholder="Your Surname:" name="last_name"/><br>
<input type="email" placeholder="Your e-mail:" name="email"/><br>
<button type="submit" style="margin-top: 10px" ">CONFIRM</button>
</form>
</body>
</html>