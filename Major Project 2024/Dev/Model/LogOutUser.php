<?php

require 'GetDBConnection.php';
$conn = get_db_connection();

session_start();

//Ends the session if there is a session set.
if (isset($_SESSION)) {
    session_destroy();
}

//gives the filepath for the login page to return the user there once they press the log-out button.
echo json_encode(array("success" => true, "redirect" => "../View/LoginPage.php"));

$conn = null;