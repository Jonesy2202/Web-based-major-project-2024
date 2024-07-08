<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
    <title>Dish Discovery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="StyleSheet.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body onload="displaySelectedRecipe()">
<header>
    <h1>Dish Discovery</h1>
</header>

<!--navigation bar-->
<div class="navdiv">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a href="HomePage.php" class="nav-item">Home</a>
                </li>
                <li class="nav-item">
                    <a href="Recipes.php" class="nav-item active">Recipes</a>
                </li>
                <li class="nav-item">
                    <a href="MyRecipes.php" class="nav-item">My Recipes</a>
                </li>
                <li class="nav-item">
                    <a href="ShoppingList.php" class="nav-item">Shopping List</a>
                </li>
                <li class="nav-item">
                    <a href="Help.php" class="nav-item">Help</a>
                </li>
                <li class="nav-item right">
                    <a href="Account.php" class="nav-item">Account</a>
                </li>
            </ul>
        </div>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="card col-lg-7 col-md-10 col-sm-10 col-10 maincard" id="recipeSpacing">
            <!--displays the recipe name and the creator-->
            <h2 id="recipeHeader" class="text-center">Recipe Name</h2>
            <h4 id="recipeCreator" class="text-center">Recipe Creator</h4>
            <!--Creates the element for the recipe image to be displayed in.-->
            <img id="recipeImage" src="" alt="Recipe Image" class="mx-auto">
            <div class="row justify-content-center">
                <div class="col-10">
                    <h2 class="recipeHeader">Ingredients</h2>
                    <!--Creates the table where the ingredients will be displayed.-->
                    <table id="recipeIngredientsTable">
                        <tr>
                            <th>Ingredient</th>
                            <th>Amount</th>
                        </tr>
                    </table>
                    <!--This is where the instructions will be displayed-->
                    <h2 class="recipeHeader">Instructions</h2>
                    <p id="recipeInstructions"></p>
                </div>
                <div class="d-flex justify-content-around">
                    <div class="col-8">
                        <div class="d-flex justify-content-center">
                            <!--This is a select menu to select which day of the week the recipe will be added to in the planner.-->
                            <label for="plannerDays"></label>
                            <select id="plannerDays" name="plannerDays">
                                <option value="Select" selected>- Select Day -</option>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                                <option value="Saturday">Saturday</option>
                                <option value="Sunday">Sunday</option>
                            </select>
                            <br>
                            <!--The button to confirm that the user wants to save the recipe to that day.-->
                            <button class="btn neutralButton" onclick="addToPlannerDay()">Add To Planner</button>
                            <button class="btn negativeButton" onclick="window.location='Recipes.php'">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../Controller/SelectedRecipe.js"></script>
<script src="../Controller/AddRemovePlanner.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>
</html>