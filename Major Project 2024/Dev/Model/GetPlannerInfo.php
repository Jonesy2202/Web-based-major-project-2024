<?php

require 'GetDBConnection.php';
$conn = get_db_connection();

// Session start to save variables across multiple php files and web pages.
session_start();

$username = $_SESSION['username'];

//This gets each of the days in the planner for the logged in user.
$getPlannerQuery = $conn->prepare("SELECT monday, tuesday, wednesday, thursday, friday, saturday, sunday FROM planners WHERE username = :username;");
$getPlannerQuery->bindParam(':username', $username);
$getPlannerQuery->execute();

$planner = $getPlannerQuery->fetch(PDO::FETCH_ASSOC);

//Goes through the recipes in the planner and gets the recipe name, id and ingredients to use them later to display the recipe names for the planner and ingredients for the shopping list.
foreach ($planner as $day => $recipeID) {
    $getRecipeQuery = $conn->prepare("SELECT recipename, recipeid, ingredients FROM recipes WHERE recipeid = :recipeid;");
    $getRecipeQuery->bindParam(':recipeid', $recipeID);
    $getRecipeQuery->execute();

    $recipe = $getRecipeQuery->fetch(PDO::FETCH_ASSOC);

    //assigns the information from the recent query to planner so that they can be returned to be displayed where needed.
    $planner[$day] = $recipe;
}

//If the planner exists it will return the planner. If not, a message is returned.
if ($planner) {
    json_encode($planner);
    echo json_encode(array("success" => true, "planner" => $planner));
} else {
    echo json_encode(array("success" => false, "message" => "Unable to display your planner at this time."));
}

$getPlannerQuery = null;
$conn = null;