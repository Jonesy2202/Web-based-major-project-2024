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

<!--navigation bar-->
<div class="navdiv">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="HomePage.php" class="nav-item">Home</a>
                </li>
                <li class="nav-item">
                    <a href="Recipes.php" class="nav-item">Recipes</a>
                </li>
                <li class="nav-item">
                    <a href="MyRecipes.php" class="nav-item">My Recipes</a>
                </li>
                <li class="nav-item">
                    <a href="ShoppingList.php" class="nav-item">Shopping List</a>
                </li>
                <li class="nav-item">
                    <a href="Help.php" class="nav-item active">Help</a>
                </li>
                <li class="nav-item">
                    <a href="Account.php" class="nav-item">Account</a>
                </li>
            </ul>
        </div>
    </nav>
</div>
<!-- table will be generated on load when the site is created. the days of the week are there as place-holders -->


<div class="container">
    <div class="row justify-content-center">
        <!-- Login Form -->
        <div class="card col-lg-7 col-md-10 col-sm-10 col-10 maincard">
            <h2 id="cardHeader" class="text-center">Help</h2>
            <div>
                <p><b>How do I add to my planner?</b></p>
                <p>To add to your planner you must first find a recipe you like on the Recipes page and then go to the
                    bottom, select a day then press the "Add To Planner" button.</p>
                <p><b>How do I make a recipe?</b></p>
                <p>To make a recipe you must go to "My Recipes" and press the "Add Recipe" button which will take you to a form to fill out. Once the form is filled in, press the confirm button to add the recipe. Don't worry, if there are changes you want to make to the recipe later on there is a way to edit them later on.</p>
                <p><b>How do I edit my recipe?</b></p>
                <p>To edit one of your recipes you need to go to the "My Recipes" page and press on the pencil button next to the recipe you want to change. This will bring you to a page with the form already filled in. Change what you want and then press confirm. Don't worry about adding the same image again, if you leave the box blank it will use the old image.</p>
                <p><b>How do I log out?</b></p>
                <p>The log-out button is on the account page and is bright red.</p>
                <p><b>How do I change my password?</b></p>
                <p>You can change your password on your account page. Insert your new password and then confirm it by typing it again.</p>
                <p><b>How do I report problems?</b></p>
                <p>Please contact the administrator to see if they can solve the issue or escalate it.</p>
            </div>
        </div>
    </div>
</div>

<script src="../Controller/HomePage.js"></script>
<script src="../Controller/AddRemovePlanner.js"></script>
<script src="../Controller/DisplayRecipes.js"></script>

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