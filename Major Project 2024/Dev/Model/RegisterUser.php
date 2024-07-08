<?php
require 'GetDBConnection.php';
$conn = get_db_connection();

//gets username and password when user clicks on the submit button. username and password is then validated by the js file on the front end as an extra precaution.
$usernameInput = $_POST['username'];
$passwordInput = $_POST['password'];

$passwordCheck = "/^(?=.*[A-Za-z])(?=.*\\d)(?=.*[@$!%*?&])[A-Za-z\\d@$!%*?&]{8,}/";
$usernameCheck = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{3,15}$/";

// If the password or username doesnt match the regular expressions, the script will cut off and display the error message.
if (!preg_match($usernameCheck, $usernameInput)) {
    echo json_encode(array("success" => false, "message" => "username is in the incorrect format! It must be between 3 and 15 characters and include a number."));
    die();
}

if (!preg_match($passwordCheck, $passwordInput)) {
    echo json_encode(array("success" => false, "message" => "Password needs to be at least 8 characters and contain a capital letter, lowercase letter and a number."));
    die();
}

//Hashes the password using password_default
$hashedPassword = password_hash($passwordInput, PASSWORD_DEFAULT);

// Check if the username already exists. If a row is returned, the username already exists.
$userCheckQuery = $conn->prepare("SELECT * FROM users WHERE username = :username");
$userCheckQuery->bindParam(':username', $usernameInput);
$userCheckQuery->execute();

if ($userCheckQuery->rowCount() > 0) {
    echo json_encode(array("success" => false, "message" => "User already exists"));
} else {
    // Username doesn't exist, insert new user.
    $query = $conn->prepare("INSERT INTO users (username, password) VALUES (:username, :hashedPassword)");
    $query->bindParam(':username', $usernameInput);
    $query->bindParam(':hashedPassword', $hashedPassword);
    $query->execute();

    //the query makes a new record in the planners table that is linked to the users table so the usernames match up and follow the same format. If this was two separate queries with the username being saved as a variable, it wouldn't work, that is why I have made it into one query.
    $createPlannerQuery = $conn->prepare("INSERT INTO planners (username) SELECT username FROM users WHERE username = :username");
    $createPlannerQuery->bindParam(':username', $usernameInput);
    $createPlannerQuery->execute();
    echo json_encode(array("success" => true, "message" => "User registered successfully - Please use your new details."));
}


// Close connections
$query = null;
$userCheckQuery = null;
$conn = null;

//PASSWORD_DEFAULT - Use the bcrypt algorithm (default as of PHP 5.5.0). Note that this constant is designed to change over time as new and stronger algorithms are added to PHP. For that reason, the length of the result from using this identifier can change over time. Therefore, it is recommended to store the result in a database column that can expand beyond 60 characters (255 characters would be a good choice).