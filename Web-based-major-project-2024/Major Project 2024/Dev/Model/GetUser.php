<?php

require 'GetDBConnection.php';
$conn = get_db_connection();

session_start();

$username = $_SESSION['username'];

//This gets the user information for the logged in user for the account page.
$getUsersQuery = $conn->prepare("SELECT * FROM users WHERE username=:username");
$getUsersQuery->bindParam(':username', $username);
$getUsersQuery->execute();

$user = $getUsersQuery->fetch(PDO::FETCH_ASSOC);

//Returns teh user information.
echo json_encode(array("success" => true, "user" => $user));

$conn = null;