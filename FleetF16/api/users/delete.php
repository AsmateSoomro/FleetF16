<?php
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/users.php';

// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare users object
$users = new Users($db);
 
// set users property values
$users->id = $_POST['id'];
 
// remove the user
if($users->delete()){
    $users_arr=array(
        "status" => true,
        "message" => "Successfully Removed!"
    );
}
else{
    $users_arr=array(
        "status" => false,
        "message" => "User Cannot be deleted. may be he's assigned  a vehicle!"
    );
}
print_r(json_encode($users_arr));
?>