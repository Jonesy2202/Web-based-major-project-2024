<?php

require 'GetDBConnection.php';
$conn = get_db_connection();

//This query gets all of the user information to display it on the admin page.
$getUsersQuery = $conn->prepare("SELECT * FROM users");
$getUsersQuery->execute();

$users = $getUsersQuery->fetchAll(PDO::FETCH_ASSOC);

//Returns all of the users.
echo json_encode(array("success" => true, "users" => $users));