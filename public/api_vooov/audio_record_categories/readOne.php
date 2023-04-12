<?php
    include_once '../tabs/tabs.php';

    $table = "audio_record_categories"; // Change with the good BDD table name

    $theOneToGet = "id"; // Change with the good column

    $arguments = $tabAudioRecordCategoriesRead;// Replace with the good tab

    $sql = "SELECT ". implode(', ', array_map(function($argument)
    { return $argument; }, $arguments)) . " FROM " . $table ."
    WHERE ". $theOneToGet ." = ? LIMIT 0,1";

    include_once '../generic_cruds/generic_readOne.php';