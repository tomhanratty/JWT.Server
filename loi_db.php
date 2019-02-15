<?php

require 'database.php';



function getTeams() {
    global $db;

    $query = "SELECT * "
            . " FROM teams ";
    $statement = $db->prepare($query);
    try {
        $statement->execute();
    } catch (Exception $ex) {
        header("Location:../view/error.php?msg=" . $ex->getMessage());
        exit();
    }
    
   
    $teams = $statement->fetchAll();
    $statement->closeCursor();
    
    return json_encode($teams, TRUE);
    
}



function getSingleResults($var) {
    global $db;

    $query = "SELECT * "
            . " FROM results "
            . "WHERE homeTeam = $var";
    $statement = $db->prepare($query);
    try {
        $statement->execute();
    } catch (Exception $ex) {
        header("Location:../view/error.php?msg=" . $ex->getMessage());
        exit();
    }
    
   
    $results3 = $statement->fetchAll();
    $statement->closeCursor();
    
    return json_encode($results3, TRUE);
    
}

function getDoubleResults($var,$var2) {
    global $db;

    $query = "SELECT * "
            . " FROM results "
            . "WHERE homeTeam = $var "
            . "AND awayTeam = $var2 ";
    $statement = $db->prepare($query);
    try {
        $statement->execute();
    } catch (Exception $ex) {
        header("Location:../view/error.php?msg=" . $ex->getMessage());
        exit();
    }
    
   
    $results4 = $statement->fetchAll();
    $statement->closeCursor();
    
    return json_encode($results4, TRUE);
    
}
