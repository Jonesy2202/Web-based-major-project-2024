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
                    <a href="index.php" class="nav-item active">Home</a>
                </li>
                <li class="nav-item">
                    <a href="LoginPage.php" class="nav-item">Login/Register</a>
                </li>
            </ul>
        </div>
    </nav>
</div>

<!--Small intro to what the site does with a small link to the login page.-->
<div class="container">
    <div class="row justify-content-center">
        <!-- Login Form -->
        <div class="card col-lg-7 col-md-10 col-sm-10 col-10 maincard">
            <h2 id="cardHeader" class="text-center">Welcome to Dish Discovery!</h2>
            <div>
                <p>
                    Welcome to Dish Discovery! We aim to provide you with a fun and efficient way to plan and share
                    recipes with your family and friends. As well as using some pre-made recipes you will be able to
                    create your own that your friends and family will be able to see. Our aim is to encourage you and
                    the people you know to try new things and connect through food.
                    <br><br>
                    Contact your friends for a key and <a href="LoginPage.php">register</a> to start making and sharing
                    recipes TODAY!
                </p>
            </div>
        </div>
    </div>
</div>

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