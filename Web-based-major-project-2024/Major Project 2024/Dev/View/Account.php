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
<body onload="displayUserDetails()">
<header>
    <h1>Dish Discovery</h1>
</header>
<!--Navigation bar-->
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
                    <a href="Help.php" class="nav-item">Help</a>
                </li>
                <li class="nav-item">
                    <a href="Account.php" class="nav-item active">Account</a>
                </li>
            </ul>
        </div>
    </nav>
</div>

<!--Creates card to display all the important information on-->
<div class="container">
    <div class="row justify-content-center">
        <div class="card col-lg-7 col-md-10 col-sm-10 col-10 maincard maincard">
            <h2 id="cardHeader" class="text-center">My Account</h2>
            <button id="logout" class="negativeButton btn floatButton btn-sm" style="float:right" onClick="logOut()"><i class="material-icons">logout</i></button>
            <div class="row justify-content-center">
                <!--This is a form to change the user's password. it requires them to put the new password in twice to ensure that there are no mistakes.-->
                <div>
                    <label for="accountUsername">Username</label>
                    <input type="text" id="accountUsername" name="username" readonly>
                    <br>
                    <label for="newPassword">Change Password</label>
                    <input id="newPassword" name="password">
                    <br>
                    <label for="newPasswordConfirm">Confirm Changed Password</label>
                    <input id="newPasswordConfirm" name="passwordConfirm">
                    <div class="row">
                        <!--Button that is used to confirm the changes when a user wants to change a password-->
                        <div class="d-flex justify-content-center mt-2 mb-2">
                            <button class="neutralButton btn" onclick="userPasswordChange()">Confirm changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../Controller/AccountDetails.js"></script>
<script src="../Controller/LoginAndRegister.js"></script>

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