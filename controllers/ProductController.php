<?php


class ProductController
{
    public function getAll()
    {
        $db=DB::getInstance();
        $query = "SELECT * FROM products";
        $stmt = $db->getConnection()->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll();
        return $results;
    }

    public function create()
    {
        $db=DB::getInstance();
        $query = "INSERT INTO products (name, description, price) VALUES (:name, :description, :price)";
        $stmt = $db->getConnection()->prepare($query);
        $values = [$_POST['name'], $_POST['description'], $_POST['price']];
        $stmt->execute($values);
    }

}