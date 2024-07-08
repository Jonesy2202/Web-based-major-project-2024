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

<!--Navigation bar-->
<div class="navdiv">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a href="index.php" class="nav-item">Home</a>
                </li>
                <li class="nav-item">
                    <a href="LoginPage.php" class="nav-item active">Login/Register</a>
                </li>
            </ul>
        </div>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="card col-lg-7 col-md-10 col-sm-10 col-10 maincard">
            <div class="row justify-content-center">
                <!-- Login Form - Has fields for username and password-->
                <div class="col-sm-6">
                    <div id="loginForm">
                        <h2>Login</h2>
                        <form id="login">
                            <label for="username">Username: </label>
                            <br>
                            <input type="text" id="username" name="username">
                            <br>
                            <label for="password">Password: </label>
                            <br>
                            <input type="password" id="password" name="password">
                        </form>
                        <div class="buttonPosition">
                            <button type="button" class="positiveButton" onclick="loginFrontendValidation()">Login
                            </button>
                        </div>
                        <!--Where the messages will appear when attempting to log in-->
                        <p id="loginMessage" class="message"></p>
                    </div>
                </div>

                <!-- Register Form - has fields for username, password and the unique key that the user must know before creating an account.-->
                <div class="col-sm-6">
                    <div id="registerForm">
                        <h2>Register</h2>
                        <form id="register">
                            <label for="registerUsername">Username: </label>
                            <br>
                            <input type="text" id="registerUsername" name="username">
                            <br>
                            <label for="registerPassword">Password: </label>
                            <br>
                            <input type="password" id="registerPassword" name="password">
                            <br>
                            <label for="registerKey">Key (Code shared by administrator): </label>
                            <br>
                            <input type="text" id="registerKey" name="registerKey">
                        </form>
                        <div class="buttonPosition">
                            <button type="button" class="neutralButton" onclick="registerFrontendValidation()">Register
                            </button>
                        </div>
                        <!--where the messages will appear when creating an account.-->
                        <p id="registerMessage" class="message"></p>
                    </div>
                </div>
                <p>Forgotten password or need help with creating an account? Contact the administrator for help!</p>
            </div>
        </div>
    </div>
</div>

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

