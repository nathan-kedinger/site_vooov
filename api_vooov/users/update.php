<?php
    include_once '../tabs/tabs.php';

    $table = "users"; // Change with the good BDD table name

    // Datas
    $arguments = $tabUsers;// Replace with the good tab

    // SQL request
    $sql = "UPDATE " . $table . " SET ". implode(', ', array_map(function($argument) 
    { return $argument . '=:' . $argument; }, $arguments)) . " WHERE uuid=:uuid"; 

    include_once '../generic_cruds/generic_update.php';
  