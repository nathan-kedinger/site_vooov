<?php
// Headers

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

try {
    /**
     * Script to handle a GET request for one data
     *
     * @throws InvalidArgumentException if the request method is not GET
     */
    // Verification that used method is correct
    if ($_SERVER['REQUEST_METHOD'] != 'GET') {
        throw new Exception("Invalid request method. Only GET is allowed", 405);
    }
    // Including files for config and data access
    include_once '../models/CRUD.php';
    include_once '../tabs/tabs.php';

    // Expected table
    $table = "users"; // Change with the good BDD table name

    $theOneToGet = "id"; // Change with the good column

    $arguments = $tabUsersRead;// Replace with the good tab

    $sql = 'CALL get_users_by_id(:user_id)';
    include_once '../../Database.php';

    // DDB instanciation
    $database = new Database();
    $db = $database->getConnection();

    // crudObject instanciation
    $crudObject = new CRUD($db);

    // Get uuid from url Remplacer par oneToGet
    $uuid = $_GET[$theOneToGet];

    $params = [
        ':user_id' => $uuid
    ];
    // Verifying that we have at least one crudObject
    if ($uuid) {

        $crudObject->uuid = $uuid;

        $crudObject->readOneWithProcedure($arguments, $sql, $params);

        $oneShowedData = [];
        foreach ($arguments as $argument) {
            $oneShowedData[$argument] = $crudObject->$argument;
        }

        http_response_code(200);

        echo json_encode($oneShowedData);

    } else {
        http_response_code(404);
        echo json_encode(array("message" => "This ref doesn't exists."));
    }

} catch (Exception $e) {
    http_response_code($e->getCode());
    echo json_encode(["Message" => $e->getMessage()]);
    error_log($e->getMessage(), 0, "logs.txt");
}