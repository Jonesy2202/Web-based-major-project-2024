<?php

require 'GetDBConnection.php';
$conn = get_db_connection();

session_start();

$action = $_POST['action'];
$recipeID = $_SESSION['recipeID'];

//Depending on the action that the user wants to do, the correct function will run.
if ($action === "display") {
    displayEditRecipe();
} else if ($action === "newPage") {
    goToEditPage();
} else if ($action === "edit") {
    confirmEditRecipe();
}

//will return the recipe that the user wants to edit.
function displayEditRecipe()
{
    global $conn;
    global $recipeID;

    //Gets the recipe that the user wants to display.
    $getRecipeQuery = $conn->prepare("SELECT * FROM recipes WHERE recipeid = :recipeid;");
    $getRecipeQuery->bindParam(':recipeid', $recipeID);
    $getRecipeQuery->execute();

    $recipe = $getRecipeQuery->fetch(PDO::FETCH_ASSOC);

    //if the recipe exists the recipe will be returned.
    if ($recipe) {
        //converts the recipe to json.
        json_encode($recipe);
        echo json_encode(array("success" => true, "recipe" => $recipe));
    } else {
        echo json_encode(array("success" => false, "message" => "Unable to edit this recipe at this time."));
    }
}

//Is used only to navigate to the edit recipe page while also saving the recipe clicked on in a session variable.
function goToEditPage()
{
    echo json_encode(array("success" => true, "redirect" => "../View/EditRecipe.php"));
}

//Once the user has completed editing the recipe, the recipe will be updated in the recipes table.
function confirmEditRecipe()
{
    global $conn, $recipeID;

    $recipeNameInput = $_POST['recipeName'];
    $instructionsInput = $_POST['instructions'];
    $ingredientsInput = $_POST['ingredients'];
    $username = $_SESSION['username'];
    $hasImage = $_POST['hasimage'];

    $getImageDirQuery = $conn->prepare("SELECT imagefilepath FROM recipes WHERE recipeid=:recipeid");
    $getImageDirQuery->bindParam(':recipeid', $recipeID);
    $getImageDirQuery->execute();

    $currentFilePath = $getImageDirQuery->fetchColumn();

//Renames the image and stores it into Images folder - in this case it will overwrite current one. It also uses hasImage that is passed from the javascript to see if an image was uploaded. If an image wasn't uploaded, it will update the recipe while keeping the current image and filepath.
    if ($hasImage === "true") {

        $image = $_FILES['image'];

        $targetDir = "../View/Images/UploadedImages/";
        //date_username_randomnumber.filetype
        $targetFile = $targetDir . date("Y.m.d") . '_' . $username . '_' . uniqid() . '.' . pathinfo($image['name'], PATHINFO_EXTENSION);
        move_uploaded_file($image["tmp_name"], $targetFile);

        //Delete current image in directory
        unlink($currentFilePath);

        //Update recipe with new information
        $createRecipeQuery = $conn->prepare("UPDATE recipes SET recipename=:recipeName, instructions=:instructions, imagefilepath=:filepath, ingredients=:ingredients WHERE recipeid=:recipeid");
        $createRecipeQuery->bindParam(':filepath', $targetFile);

    } else {
        //Updates the recipe without updating the image.
        $createRecipeQuery = $conn->prepare("UPDATE recipes SET recipename=:recipeName, instructions=:instructions, ingredients=:ingredients WHERE recipeid=:recipeid");

    }
    //This is the rest of the query setup before execution. it is outside of the if statement to avoid duplication of code.
    $createRecipeQuery->bindParam(':recipeName', $recipeNameInput);
    $createRecipeQuery->bindParam(':instructions', $instructionsInput);
    $createRecipeQuery->bindParam(':recipeid', $recipeID);
    $createRecipeQuery->bindParam(':ingredients', $ingredientsInput);
    $createRecipeQuery->execute();

    //once completed, the user is returned back to the recipes that they created.
    echo json_encode(array("success" => true, "redirect" => "../View/MyRecipes.php"));
    die();
}

//unlink to delete current image in folder - https://www.php.net/manual/en/function.unlink.php
// redirection of site and returning data - https://stackoverflow.com/questions/42725089/redirection-through-json-encode-in-php
// upload_err_no_file - https://www.php.net/manual/en/features.file-upload.errors.php