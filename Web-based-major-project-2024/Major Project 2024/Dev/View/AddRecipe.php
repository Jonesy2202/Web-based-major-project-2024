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
<body>
<header>
    <h1>Dish Discovery</h1>
</header>
<!--Nav bar-->
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
                    <a href="Recipes.php" class="nav-item">Recipes</a>
                </li>
                <li class="nav-item">
                    <a href="MyRecipes.php" class="nav-item active">My Recipes</a>
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
        <div class="card col-lg-7 col-md-10 col-sm-10 col-10 maincard">
            <!--Add recipe form-->
            <h2 id="cardHeader" class="text-center">Add Recipe</h2>
            <div class="row justify-content-center">
                <div class="col-sm-6">
                    <div>
                        <!--Gets the recipe name, instructions and image-->
                        <form>
                            <label class="recipeHeader" for="recipeName">Name Of Recipe</label>
                            <br>
                            <input type="text" id="recipeName" name="recipeName">
                            <br>
                            <label class="recipeHeader" for="recipeInstructions">Instructions</label>
                            <br>
                            <textarea id="recipeInstructions" name="recipeInstructions"></textarea>
                            <br>
                            <input type="file" id="foodImage" name="foodImage">
                        </form>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div>
                        <!--Creates the table to display all the ingredients that get added-->
                        <h3 class="recipeHeader">Ingredients</h3>
                        <table class="ingredientTable" id="ingredientTable">
                            <tr>
                                <th>Ingredient</th>
                                <th>Amount</th>
                                <th>Delete</th>
                            </tr>
                        </table>
                        <div class="row justify-content-center">
                            <!--This is the form to add the ingredient and the amount for the recipe.-->
                            <div class="addIngredient">
                                <label for="ingredient" hidden="hidden">Ingredient</label>
                                <input type="text" id="ingredient" name="ingredient" placeholder="Ingredient">
                            </div>
                            <div class="addIngredient">
                                <label for="amount" hidden="hidden">Amount</label>
                                <input type="text" id="amount" name="amount" placeholder="Amount">
                            </div>
                            <div class="text-center">
                                <button class="neutralButton buttonMargin" onclick="addIngredient('add')">Add
                                    Ingredient
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--These are the buttons to confirm the addition of the recipe or cancel and return back to the myRecipes page.-->
            <div class="row justify-content-center">
                <div class="col-auto">
                    <button class="positiveButton buttonMargin" onclick="addRecipe()">Confirm</button>
                </div>
                <div class="col-auto">
                    <button class="negativeButton buttonMargin" onClick="window.location='MyRecipes.php'">Cancel
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="../Controller/AddEditRecipe.js"></script>

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