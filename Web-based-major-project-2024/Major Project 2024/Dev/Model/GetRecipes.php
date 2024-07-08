<?php

require 'GetDBConnection.php';
$conn = get_db_connection();

// Session start to save variables across multiple php files and web pages.
session_start();

$username = $_SESSION['username'];
$action = $_POST['action'];

//uses the action to decide what bit of code needs to be ran.
if ($action == "getRecipes") {

    //Gets all recipes from the recipes table.
    $getRecipesQuery = $conn->prepare("SELECT * FROM recipes");
    $getRecipesQuery->execute();

    $recipes = $getRecipesQuery->fetchAll(PDO::FETCH_ASSOC);

    //If it can get the recipes it will return the recipes.
    if ($recipes) {
        json_encode($recipes);
        echo json_encode(array("success" => true, "recipes" => $recipes));
    } else {
        echo json_encode(array("success" => false, "message" => "Unable to display your recipes at this time."));
    }
} else if ($action === "toRecipePage") {

    //redirect to the selected recipe page using the recipe id stored in the session variable.
    $recipeID = $_POST['recipeID'];
    $_SESSION['recipeID'] = $recipeID;

    echo json_encode(array("success" => true, "redirect" => "../View/SelectedRecipe.php"));
    die();

}

$getPlannerQuery = null;
$conn = null;