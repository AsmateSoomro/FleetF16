<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/users.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare users object
$users = new Users($db);
 
// query users
$stmt = $users->read();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
 
    // users array
    $users_arr=array();
    $users_arr["users"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $users_item=array(
            "id" => $id,
            "name" => $name,
            "email" => $email,
            "password" => $password,
            "phone" => $phone,
            "gender" => $gender,
            "address" => $address,
            "created" => $created,
            "usertype" => $usertype
        );
        array_push($users_arr["users"], $users_item);
    }
 
    echo json_encode($users_arr["users"]);
}
else{
    echo json_encode(array());
}
?>