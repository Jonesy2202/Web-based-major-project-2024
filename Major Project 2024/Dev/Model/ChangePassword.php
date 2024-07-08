<?php

require 'GetDBConnection.php';
$conn = get_db_connection();

$newPassword = $_POST['password'];
$username = $_POST['username'];

//This is used to check to see if the password is in the correct format with this regular expression.
$passwordCheck = "/^(?=.*[A-Za-z])(?=.*\\d)(?=.*[@$!%*?&])[A-Za-z\\d@$!%*?&]{8,}/";

//If the password does not match it will echo a message that will be displayed in an alert.
if (!preg_match($passwordCheck, $newPassword)) {
    echo json_encode(array("success" => false, "message" => "Password needs to be at least 8 characters and contain a capital letter, lowercase letter and a number."));
    die();
}
//This hashes the new password before it is stored in the database.
$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

//This puts the new password into the password column for the user that is changing the password.
$query = $conn->prepare("UPDATE users SET password=:hashedPassword WHERE username=:username");
$query->bindParam(':username', $username);
$query->bindParam(':hashedPassword', $hashedPassword);
$query->execute();

//once executed, a message is echoed back to notify the user of the change.
echo json_encode(array("success" => true, "message" => "Your password has been changed."));

$conn = null;
