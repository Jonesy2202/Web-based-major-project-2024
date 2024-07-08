<?php

require 'GetDBConnection.php';
$conn = get_db_connection();

// Session start to save variables across multiple php files and web pages.
session_start();

$username = $_SESSION['username'];
$action = $_POST['action'];
$recipeID = $_SESSION['recipeID'];
$day = $_POST['day'];

//uses $action to decide what needs to be completed in this file.
if ($action == "add") {
    //This adds a recipe to a specific user's planner using the recipe they selected and their username that is stored in a session variable.
    $addToPlannerQuery = $conn->prepare("UPDATE planners SET $day = :recipeID WHERE username = :username");
    $addToPlannerQuery->bindParam(':username', $username);
    $addToPlannerQuery->bindParam(':recipeID', $recipeID);
    $addToPlannerQuery->execute();

    //Once completed, it tells the javascript file that it was successful and gives the filepath of the page that is needed.
    echo json_encode(array("success" => true, "redirect" => "../View/HomePage.php"));
} else if ($action == "remove") {
    //This removes a recipe from the planner using the username stored in the session variable.
    $removeFromPlannerQuery = $conn->prepare("UPDATE planners SET $day = null WHERE username = :username");
    $removeFromPlannerQuery->bindParam(':username', $username);
    $removeFromPlannerQuery->execute();

    //Once the query is complete a message is echoed to be displayed in an alert.
    echo json_encode(array("success" => true, "message" => "Recipe has been removed from your planner."));
}

$addToPlannerQuery = null;
$removeFromPlannerQuery = null;
$conn = null;
