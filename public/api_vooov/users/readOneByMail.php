<?php
    include_once '../tabs/tabs.php';

    // Expected table
    $table = "users"; // Change with the good BDD table name

    $theOneToGet ="email"; // Change with the good column

    $arguments = $tabUsersRead;// Replace with the good tab

    $sql = "SELECT ". implode(', ', array_map(function($argument) 
    { return $argument; }, $arguments)) . " FROM " . $table ."
    WHERE LOWER(". $theOneToGet .") = LOWER(?) LIMIT 0,1";

    include_once '../generic_cruds/generic_readOne.php';