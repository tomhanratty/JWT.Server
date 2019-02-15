<?php
require 'database.php';

function addUser($userName,$password,$memType){
    
    global $db;
    $query = "INSERT INTO users (username,password,type)"
            . "VALUES (:username,:password,:memType)";
    $statement = $db->prepare($query);
    $statement->bindParam(':username', $userName);
    $statement->bindParam(':password', $password);
    $statement->bindParam(':memType', $memType);

    try {
        $statement->execute();
    } catch (PDOException $ex) {
        header("Location:error.php?msg=" . $ex->getMessage());
        exit();
    }
    $statement->closeCursor();
}
