<?php

// Open a connection to the database as a PDO
require 'GetDBConnection.php';
$conn = get_db_connection();

// Session start to save variables across multiple php files and web pages.
session_start();

// Gets the password from the user
$passwordInput = $_POST['password'];
$usernameInput = $_POST['username'];

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

// Prepare and execute query to get data by username. This gets all users with a set username (should only be one as there are checks to make sure there can only be one).
$userCheckQuery = $conn->prepare("SELECT * FROM users WHERE username = :username");
$userCheckQuery->bindParam(':username', $usernameInput);
$userCheckQuery->execute();

// Fetch user data from the database
$userInfo = $userCheckQuery->fetch(PDO::FETCH_ASSOC);

// Verify password - checks if the username is correct with user info and verifies the password using password_verify.
// If the password is fine, it will check to see what type of user the person attempting to log in is and will echo the array back to the JS file to direct them to the correct page.
// As the data is getting sent back in json, the js file will be able to do variablename.success to decide if the result is good or not to deal with it correctly. If the success is true, the the redirect item in the array will be used to navigate to the appropriate page.

// Session is started beforehand to save the users username to be able to access it on other pages when wanting to display their planner or user information.

if ($userInfo && password_verify($passwordInput, $userInfo['password'])) {

    $admin = 'admin';
    $_SESSION['username'] = $userInfo['username'];

    if ($userInfo['usertype'] === $admin) {
        echo json_encode(array("success" => true, "redirect" => "../View/AdminPage.php"));
    } else {
        echo json_encode(array("success" => true, "redirect" => "../View/HomePage.php"));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Login not successful"));
}

$conn = null;
