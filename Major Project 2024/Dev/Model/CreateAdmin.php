<?php

//This script was used to create the admin account as there is no way to create an admin account on the site. This site was intended for the use of my close friends and family so I will have access to the admin account and if any new admins are needed, I can create one.

require_once 'GetDBConnection.php';
$conn = get_db_connection();

//Sets the admin username and password.
$adminUsername = 'TheAdmin22';
$adminPassword = 'AdminPass1234!';

//Hashes the password.
$hashedPassword = password_hash($adminPassword, PASSWORD_DEFAULT);

//Inserts the new admin details into the users table.
$insertAdminQuery = $conn->prepare("INSERT INTO Users (username, password, usertype) VALUES (:username, :password, 'admin')");
$insertAdminQuery->bindParam(':username', $adminUsername);
$insertAdminQuery->bindParam(':password', $hashedPassword);
$insertAdminQuery->execute();

//Message to notify that the script has ran fully.
echo "Admin user created successfully.";

$conn = null;
