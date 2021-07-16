<?php


class UserController
{
public function create()
{
    $db=DB::getInstance();
    $email = $_POST['email'];
    $sql = "SELECT id, email FROM users WHERE email =:email";
    $stmt = $db->getConnection()->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    if($res = $stmt->fetchAll()) {
        echo "E-mail is already in use.";
    } else {
        $query = "INSERT INTO users (first_name, last_name, email) VALUES (:first_name, :last_name, :email)";
        $stmt = $db->getConnection()->prepare($query);
        $values = [$_POST['first_name'], $_POST['last_name'], $_POST['email']];
        $stmt->execute($values);
    }
}
}