<?php

require_once "UserController.php";

class OrderController
{
    public function create()
    {
       $db = DB::getInstance();
       $sum = 0;
       session_start();
       $qtys = $_SESSION['qty'];
       foreach ($qtys as $productId => $qty) {
           if(!$qty) {
               continue;
           } else {
               $sql = "SELECT `price` FROM `products` WHERE id =:id";
               $stmt = $db->getConnection()->prepare($sql);
               $stmt->bindValue(':id', $productId);
               $stmt->execute();
               $price = $stmt->fetch()['price'];
               $sum += intval($qty) * intval($price);
           }
       }
       $email = $_POST['email'];
       $sql = "SELECT id, email FROM users WHERE email =:email";
       $stmt = $db->getConnection()->prepare($sql);
       $stmt->bindValue(':email', $email);
       $stmt->execute();
       if($res = $stmt->fetchAll()) {
           $lastID = $res[0]['id'];
       } else {
           $user = new UserController();
           $user->create();
           $lastID = $db->getConnection()->lastInsertId();
       }
       $sql = "INSERT INTO orders (user_id, `sum`) VALUES (:lastID, :sum)";
       $values = [':lastID'=>$lastID, ':sum'=>$sum];
       $stmt = $db->getConnection()->prepare($sql);
       $stmt->execute($values);

       $lastID = $db->getConnection()->lastInsertId();
       foreach ($qtys as $productId => $qty) {
           if(!$qty) {
                continue;
           } else {
                $sql = "INSERT INTO order_products (order_id, product_id, qty) VALUES (:lastID, :productID, :qty)";
                $stmt = $db->getConnection()->prepare($sql);
                $values = [$lastID, $productId, $qty];
                $stmt->execute($values);
           }
       }
    }
}