const usernameCheck = new RegExp("^[A-Za-z0-9]{3,15}$");
//start with letter, can have letters and numbers after, between 3 and 10 characters long
const passwordCheck = new RegExp("^(?=.*[A-Za-z])(?=.*\\d)(?=.*[@$!%*?&])[A-Za-z\\d@$!%*?&]{8,}$");
//must contain at least 8 characters, a number and a special character

//This is a key that is needed when creating an account to make sure not everyone can make an account as it is intended for a small number of specific people.
const registerKey = "TESTKEY123";

//This function gets data from getlogininfo.php to log the user in if their account exits and the information matches. If the information matches the user is redirected to the home page.
async function loginFrontendValidation() {
    let username = document.getElementById("username").value.toString();
    let password = document.getElementById("password").value.toString();

    if (usernameCheck.test(username)) {
        if (passwordCheck.test(password)) {
            const response = await loginUser(username, password);
            if (response.ok) {
                const responseData = await response.json();
                if (responseData.success) {

                    window.location.href = responseData.redirect;
                } else {
                    document.getElementById("loginMessage").innerHTML = responseData.message;
                }
            } else {
                document.getElementById("loginMessage").innerHTML = "An error occurred. Please try again later.";
            }
        } else {
            document.getElementById("loginMessage").innerHTML = "Password needs to be at least 8 characters and contain a capital letter, lowercase letter, and a number.";
        }
    } else {
        document.getElementById("loginMessage").innerHTML = "Username is in the incorrect format! It must be between 3 and 15 characters and include a number."
    }
}

//This function is similar to the login function with how it gets and validates the inputs but does not redirect the user. Instead, it tells the user that their account as been created, and they need to log in using their details.
async function registerFrontendValidation() {
    let username = document.getElementById("registerUsername").value.toString();
    let password = document.getElementById("registerPassword").value.toString();
    let key = document.getElementById("registerKey").value.toString();

    //Checks to see if the register key is correct before carrying on with the register process.
    if (key === registerKey) {
        //Checks to see if the password and username meets the requirements.
        if (usernameCheck.test(username)) {
            if (passwordCheck.test(password)) {
                const response = await registerUser(username, password);
                if (response.ok) {
                    const responseData = await response.json();
                    if (responseData.success) {
                        document.getElementById("registerMessage").innerHTML = responseData.message;
                    } else {
                        document.getElementById("registerMessage").innerHTML = responseData.message;
                    }
                } else {
                    document.getElementById("registerMessage").innerHTML = "An error occurred. Please try again later.";
                }
            } else {
                document.getElementById("registerMessage").innerHTML = "Password needs to be at least 8 characters and contain a capital letter, lowercase letter, and a number.";
            }
        } else {
            document.getElementById("registerMessage").innerHTML = "Username is in the incorrect format! It must be between 3 and 15 characters and include a number."
        }
    }
}
//This function is called when a user presses a log-out button. it calls logout user and if the response is a success it will use the redirect to take the user to the login page.
async function logOut() {
    //stuff to log out for both admin and regular user.
    const response = await logOutUser();
    if (response.ok) {
        const responseData = await response.json();
        if (responseData.success) {

            window.location.href = responseData.redirect;
        }
    }
}

//Passes the form data to the php file to add a new user.
async function registerUser(username, password) {
    const formData = new FormData();
    formData.append('username', username);
    formData.append('password', password);

    return await fetch('../Model/RegisterUser.php', {
        method: 'POST',
        body: formData
    });
}

//Passes the form data to the php file to see if the credentials are correct to see if the user can log in.
async function loginUser(username, password) {
    const formData = new FormData();
    formData.append('username', username);
    formData.append('password', password);

    return await fetch('../Model/GetLoginInfo.php', {
        method: 'POST',
        body: formData
    });
}

//This function goes to the log-out php file to log the user out and end their session. The filepath of the login page is returned.
async function logOutUser() {
    return await fetch('../Model/LogOutUser.php', {
        method: 'POST',
    });
}

