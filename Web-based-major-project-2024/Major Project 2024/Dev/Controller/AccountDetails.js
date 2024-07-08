//This function uses getUsers() to get the users list then passes them to populateUserDetails if the response is successful. If the response is not successful it alerts the user with a message.

async function displayUsers() {
    const response = await getUsers();
    if (response.ok) {
        const responseData = await response.json();
        if (responseData.success) {
            const users = responseData.users;
            console.table(users);
            populateUserDetails(users);
        } else {
            alert(responseData.message);
        }
    }
}

//This function populates the users table on the admin page with the user data from the users table. It creates a row and then each of the individual cells to then put the data in it. This table also has a text box and a button to change the password and confirm the change.

//The confirmation of the password change with the button click passes the username and the text box id to another function which updates the password for the correct user.
function populateUserDetails(users) {
    const usersTable = document.getElementById("adminAccountTable");
    users.forEach((user) => {
        const row = usersTable.insertRow();
        const usernameRow = row.insertCell(0);
        const passwordRow = row.insertCell(1);
        const buttonRow = row.insertCell(2);

        //This is setting an id for the text boxes to be able to access the data from them in another function.
        let passwordId = "accountPassword_" + user.userid;

        //This is displaying the correct data and items in the table for an admin to change a password.
        usernameRow.textContent = user.username;
        passwordRow.innerHTML =
            '<label for="' + passwordId + '" hidden="hidden">Password</label>' +
            '<input type="text" id="' + passwordId + '" name="password" class="adminPassBox">';
        buttonRow.innerHTML =
            '<button class="btn neutralButton btn-sm" onclick="getAdminPasswordChange(\'' + passwordId + '\', \'' + user.username + '\')"><i class="material-icons">check_circle</i></button>';
    });
}

//This function displays the details for a regular user for them to be able to change their own password. All this does is gets the users information and displays the username in the form to be able to change their password.
async function displayUserDetails() {
    const response = await getUser();
    if (response.ok) {
        const responseData = await response.json();
        if (responseData.success) {
            const user = responseData.user;
            document.getElementById("accountUsername").value = user.username;
        } else {
            alert(responseData.message);
        }
    }

}

//This function is used by both the admin and the regular user to pass the new password to the corresponding php file to save in the database. The response for the database is in the json format to determine if the  response was a good one or a bad one and then display the appropriate message sent from the php script.
async function changePassword(username, newPassword) {

    if (passwordCheck.test(newPassword)) {
        const response = await confirmChange(username, newPassword);
        if (response.ok) {
            const responseData = await response.json();
            if (responseData.success) {
                alert(responseData.message);
            } else {
                alert(responseData.message);
            }
        }
    }else{
        alert("Password needs to be at least 8 characters and contain a capital letter, lowercase letter and a number.");
    }
}

//This function gets all the data from the regular user account page and then does a quick check to see if the passwords that were given match. If they match the new password is then sent to the changePassword function to be sent to the database and update the current record.
async function userPasswordChange() {
    const username = document.getElementById("accountUsername").value;
    const newPassword = document.getElementById("newPassword").value;
    const newPasswordConfirm = document.getElementById("newPasswordConfirm").value;

    //Compares the new password with another form to see if they match to make sure there are no typing mistakes.
    if (newPassword === newPasswordConfirm) {
        await changePassword(username, newPassword);
    } else {
        alert("Passwords do not match.");
    }
}

//This function gets the password from the correct row in the table using the passwordId. The element id for each of the text boxes are generated with a small phrase and the userid to make them unique to be able to access them easily. the id is then used to get the data from the text box and submitted straight away. there is no check for this password as they can be changed easily by the admin as many times as needed. There is no option to view the current password as this is a security risk, and it is advised that users change their passwords as soon as an admin has changed them.
async function getAdminPasswordChange(passwordId, username) {
    console.log(passwordId);
    const passwordInput = document.getElementById(passwordId);
    const newPassword = passwordInput.value;
    await changePassword(username, newPassword);
}

//This function sends the users username and their updated password for it to be updated in the users table.
async function confirmChange(username, password) {
    const formData = new FormData();
    formData.append('username', username);
    formData.append('password', password);

    return await fetch('../Model/ChangePassword.php', {
        method: 'POST',
        body: formData,
    });
}

//This function gets all the users to be displayed on the admin page, so they can have their passwords changed.
async function getUsers() {
    return await fetch('../Model/GetUsers.php', {
        method: 'POST',
    });
}

//This function gets a single user and returns it to be displayed on that users account page.
async function getUser() {
    return await fetch('../Model/GetUser.php', {
        method: 'POST',
    });
}