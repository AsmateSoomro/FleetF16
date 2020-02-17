<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/users.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare users object
$users = new Users($db);

// set ID property of users to be edited
$users->id = isset($_GET['id']) ? $_GET['id'] : die();

// read the details of users to be edited
$stmt = $users->read_single();

if($stmt->rowCount() > 0){
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // create array
    $users_arr=array(
        "id" => $row['id'],
        "name" => $row['name'],
        "email" => $row['email'],
        "password" => base64_decode($row['password']),
        "phone" => $row['phone'],
        "gender" => $row['gender'],
        "address" => $row['address'],
        "created" => $row['created'],
        "usertype" => $row['usertype']
    );
}
// make it json format
print_r(json_encode($users_arr));
?>