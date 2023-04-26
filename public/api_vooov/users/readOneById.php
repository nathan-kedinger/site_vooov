<?php
include_once '../tabs/tabs.php';

// Expected table
$table = "users"; // Change with the good BDD table name

$theOneToGet ="id"; // Change with the good column

$arguments = $tabUsersRead;// Replace with the good tab

$useStoredProcedure = true; // Set to true if you want to use the stored procedure

if ($useStoredProcedure) {
    $sql = 'CALL get_users_by_id(:user_id)';
} else {
    $sql = "SELECT ". implode(', ', array_map(function($argument)
        { return $argument; }, $arguments)) . " FROM " . $table ."
    WHERE ". $theOneToGet ." = ? LIMIT 0,1";
}

include_once '../generic_cruds/generic_readOne.php';