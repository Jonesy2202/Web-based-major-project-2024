<?php

require 'GetDBConnection.php';
$conn = get_db_connection();

// Session start to save variables across multiple php files and web pages.
session_start();

$username = $_SESSION['username'];
$action = $_POST['action'];

//Uses action to decide what needs to run. This allows multiple tasks to be completed in one file.
if ($action === "getMyRecipes") {

    //This query gets all recipes created by the logged in user.
    $getMyRecipesQuery = $conn->prepare("SELECT * FROM recipes WHERE creator = :username");
    $getMyRecipesQuery->bindParam(':username', $username);
    $getMyRecipesQuery->execute();

    $myRecipes = $getMyRecipesQuery->fetchAll(PDO::FETCH_ASSOC);

    //Makes sure that the recipes exist before returning them.
    if ($myRecipes) {
        json_encode($myRecipes);
        echo json_encode(array("success" => true, "myRecipes" => $myRecipes));
    } else {
        echo json_encode(array("success" => false, "message" => "It appears you don't have any recipes just yet. Create one for it to be added to your My Recipes page."));
    }
} else if ($action === "toEditPage") {

    //This navigates the user to the edit recipe page. It also gets the recipe id and saves it in a session variable.
    $_SESSION['recipeID'] = $_POST['recipeID'];

    echo json_encode(array("success" => true, "redirect" => "../View/EditRecipe.php"));
} else if ($action === "deleteRecipe") {
    //This deletes a recipe from the recipes table. It firstly removes the image from the folder where the images are stored then removes the record for that recipe.
    $recipeID = $_POST['recipeID'];

    // Delete image file
    $getImageDirQuery = $conn->prepare("SELECT imagefilepath FROM recipes WHERE recipeid=:recipeid");
    $getImageDirQuery->bindParam(':recipeid', $recipeID);
    $getImageDirQuery->execute();
    $imageFilePath = $getImageDirQuery->fetchColumn();
    //Check to see if the image exists.
    if ($imageFilePath) {
        unlink($imageFilePath);
    }

    //Goes through each of the days in planner to remove the reference to the old recipeid. Uses case when to go through each part on the condition that the id is the recipe trying to be deleted.
    $removeRecipeReferenceQuery = $conn->prepare("
UPDATE planners
SET 
    monday = CASE WHEN monday = :recipeid THEN NULL ELSE monday END,
    tuesday = CASE WHEN tuesday = :recipeid THEN NULL ELSE tuesday END,
    wednesday = CASE WHEN wednesday = :recipeid THEN NULL ELSE wednesday END,
    thursday = CASE WHEN thursday = :recipeid THEN NULL ELSE thursday END,
    friday = CASE WHEN friday = :recipeid THEN NULL ELSE friday END,
    saturday = CASE WHEN saturday = :recipeid THEN NULL ELSE saturday END,
    sunday = CASE WHEN sunday = :recipeid THEN NULL ELSE sunday END;");
    $removeRecipeReferenceQuery->bindParam(':recipeid', $recipeID);
    $removeRecipeReferenceQuery->execute();

    // Delete recipe from the database
    $deleteMyRecipeQuery = $conn->prepare("DELETE FROM recipes WHERE recipeid = :recipeid");
    $deleteMyRecipeQuery->bindParam(':recipeid', $recipeID);
    $success = $deleteMyRecipeQuery->execute();

    //If the deletion of the record was a success an appropriate message will be returned to be displayed.
    if ($success) {
        echo json_encode(array("success" => true, "message" => "Your recipe has been deleted."));
    } else {
        echo json_encode(array("success" => false, "message" => "Failed to delete the recipe."));
    }
}

$getPlannerQuery = null;
$deleteMyRecipeQuery = null;
$conn = null;

// case when - https://www.w3schools.com/sql/sql_case.asp