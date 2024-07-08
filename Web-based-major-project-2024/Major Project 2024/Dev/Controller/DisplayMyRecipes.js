//This is to save the recipes locally for a short period.
let myRecipesList = [];

//This function is to navigate the user to the edit recipe page for the recipe that they clicked on. It passes the recipe id and an action that is used in an if statement in the php file to run a certain function.
async function toEditRecipe(recipeid) {
    const response = await toRecipeEditPage("toEditPage", recipeid);
    if (response.ok) {
        const responseData = await response.json();
        if (responseData.success) {

            window.location.href = responseData.redirect;
        } else {
            alert("Unable to edit your recipe at this time.");
        }
    }
}

//This function is used to send the recipe id of the recipe that is to be deleted. It also removes the row in the table where it is displayed on the "my recipes" page. It then alerts the user that the recipe has been deleted.
async function deleteMyRecipe(button, recipeid) {
    //A confirmation message is displayed to ensure that the user can confirm they want to delete their recipe in case the delete button was clicked by accident.
    if (confirm("Are you sure you want to delete this recipe?")) {

        const response = await removeRecipe("deleteRecipe", recipeid);
        if (response.ok) {
            const responseData = await response.json();
            if (responseData.success) {

                //This gets the closest row to button (the button that calls the function) and then removes it.
                const row = button.closest('tr');
                row.remove();

                alert(responseData.message);
            } else {
                alert("Unable to delete your recipe at this time.");
            }
        }
    }
}

//This function gets the recipes by turning the response into json and then passing it to populateMyRecipesTable() where the recipes will be displayed.
async function displayMyRecipes() {
    const myRecipesResponse = await getRecipes("getMyRecipes");
    // for each day of the week display it in each of the rows
    // add button to edit that when clicked, it clears the planner day
    if (myRecipesResponse.ok) {
        const myRecipes = await myRecipesResponse.json();

        if (myRecipes.success) {
            myRecipesList = myRecipes.myRecipes;
            populateMyRecipesTable(myRecipesList);
        } else {
            alert(myRecipes.message);
        }
    }
}

//This function populates the myrecipes table with all the recipes a specific user created. It displays the name and two buttons: one to edit the recipe and one to delete it. The edit button takes the user to the edit recipe page.
function populateMyRecipesTable(recipes) {
    const recipeTable = document.getElementById("myRecipesTable");

    recipes.forEach((recipe) => {
        const row = recipeTable.insertRow();
        const recipeRow = row.insertCell(0);
        const buttonRow = row.insertCell(1);

        recipeRow.textContent = recipe.recipename;

        if (recipe) {
            recipeRow.onclick = async function () {
                await toRecipePage(recipe.recipeid)
            };
        }

        //Creates the edit and delete button that will be able to go to the edit page and delete a recipe from the page.

        const recipeId = recipe.recipeid;

        buttonRow.innerHTML =
            '<button class="btn negativeButton btn-sm" onclick="deleteMyRecipe(this, \'' + recipeId + '\')"><i class="material-icons">delete</i></button>' +
            '<button class="btn neutralButton btn-sm" onclick="toEditRecipe(\'' + recipeId + '\')"><i class="material-icons">edit</i></button>';
    });
}

//This function navigates the user to the new page. If it is not successful an alert will display.
async function toRecipePage(recipeid) {
    const response = await toRecipe("toRecipePage", recipeid);
    if (response.ok) {
        const responseData = await response.json();
        if (responseData.success) {

            window.location.href = responseData.redirect;
        } else {
            alert("Unable to view this recipe at this time.");
        }
    }
}

//This function is used to pass the recipeId to be stored in a session variable, so it can be used to display the recipe later on.
async function toRecipe(action, recipeID) {
    const formData = new FormData();

    formData.append('action', action);
    formData.append('recipeID', recipeID);

    return await fetch('../Model/GetRecipes.php?', {
        method: 'POST',
        body: formData
    });
}

//This gets the recipes for a specific user ready for them to be displayed.
async function getRecipes(action) {
    const formData = new FormData();

    formData.append('action', action);

    return await fetch('../Model/GetMyRecipes.php?', {
        method: 'POST',
        body: formData
    });
}

//This passes the recipe id of the recipe that a user wants to delete as well as the action that corresponds to a function in the php file.
async function removeRecipe(action, recipeID) {
    const formData = new FormData();

    formData.append('action', action);
    formData.append('recipeID', recipeID);

    return await fetch('../Model/GetMyRecipes.php?', {
        method: 'POST',
        body: formData
    });
}

//This passes the recipe id to the php file to navigate to the correct php file as well as saving the recipe id in a session variable.
async function toRecipeEditPage(action, recipeID) {
    const formData = new FormData();

    formData.append('action', action);
    formData.append('recipeID', recipeID);

    return await fetch('../Model/GetMyRecipes.php?', {
        method: 'POST',
        body: formData
    });
}

//foreach - https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/forEach
//closest() - https://stackoverflow.com/questions/11553768/remove-table-row-after-clicking-table-row-delete-button