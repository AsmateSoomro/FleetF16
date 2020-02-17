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
$users->name = $_POST['name'];
$users->email = $_POST['email'];
$users->password = base64_encode($_POST['password']);
$users->phone = $_POST['phone'];
$users->gender = $_POST['gender'];
$users->address = $_POST['address'];
$users->created = date('Y-m-d H:i:s');
$users->usertype = $_POST['usertype'];

// create the users
if($users->create()){
    $users_arr=array(
        "status" => true,
        "message" => "Successfully Signup!",
        "id" => $users->id,
        "name" => $users->name,
        "email" => $users->email,
        "phone" => $users->phone,
        "gender" => $users->gender,
        "address" => $users->address,
        "usertype" => $users->usertype
    );
}
else{
    $users_arr=array(
        "status" => false,
        "message" => "Email already exists!"
    );
}
print_r(json_encode($users_arr));
?>