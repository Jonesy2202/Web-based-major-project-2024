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
<body onload="displayUsers()">
<header>
    <h1>Dish Discovery</h1>
</header>

<!--Navigation bar-->
<div class="navdiv">
    <nav class="navbar navbar-expand navbar-dark">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a href="AdminPage.php" class="nav-item active">Administrator</a>
            </li>
            <li class="nav-item">
                <a onclick="logOut()" class="nav-item">Log Out</a>
            </li>
        </ul>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="card col-lg-7 col-md-10 col-sm-10 col-10 maincard">
            <h2 id="cardHeader" class="text-center">Administrator</h2>
            <button id="adminLogout" class="negativeButton btn floatButton" style="float:right" onClick="logOut()"><i
                        class="material-icons">logout</i></button>
            <div class="row justify-content-center">
                <!--Table to display all the users on the admin page-->
                <table id="adminAccountTable">
                    <tr>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Change</th>
                    </tr>
                </table>
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