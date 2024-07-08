<?php

require 'GetDBConnection.php';
$conn = get_db_connection();

//Starts the session to access session variables.
session_start();

$recipeNameInput = $_POST['recipeName'];
$instructionsInput = $_POST['instructions'];
$image = $_FILES['image'];
$ingredientsInput = $_POST['ingredients'];
$username = $_SESSION['username'];

//Renames the image and stores it into Images folder
if($image !== ''){
    $targetDir = "../View/Images/UploadedImages/";
    //date_username_randomnumber.filetype
    $targetFile = $targetDir . date("Y.m.d") . '_' . $username . '_' . uniqid() . '.' . pathinfo($image['name'], PATHINFO_EXTENSION);
    //moves the uploaded image to the folder.
    move_uploaded_file($image["tmp_name"], $targetFile);

    //Adds a new recipe with the form data from the user.
    $createRecipeQuery = $conn->prepare("INSERT INTO recipes (recipeName, instructions, creator, imagefilepath, ingredients) VALUES (:recipeName, :instructions, :creator, :filepath, :ingredients)");
    $createRecipeQuery->bindParam(':recipeName', $recipeNameInput);
    $createRecipeQuery->bindParam(':instructions', $instructionsInput);
    $createRecipeQuery->bindParam(':creator', $username);
    $createRecipeQuery->bindParam(':filepath', $targetFile);
    $createRecipeQuery->bindParam(':ingredients', $ingredientsInput);
    $createRecipeQuery->execute();

    //The filepath is sent back to send the user back to their recipes list.
    echo json_encode(array("success" => true, "redirect" => "../View/MyRecipes.php"));
    die();
}

//If there is no image, a recipe cannot be created so this message is echoes back.
echo json_encode(array("success" => true, "message" => "unable to create recipe."));

$createRecipeQuery = null;
$conn = null;

//pathinfo to get filetype - https://www.w3schools.com/php/func_filesystem_pathinfo.asp