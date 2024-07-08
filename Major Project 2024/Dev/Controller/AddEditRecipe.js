//This is a global array to store the ingredients.
let ingredients = [];

//These are to be used to check the instructions and recipe names to make sure they follow a certain format.
const recipeNameValidation = new RegExp("^[a-zA-Z0-9\\s\\nÀ-ÿ]{1,100}$");
const instructionsValidation = new RegExp("^[^<>]*$");

//This function is used to add a recipe to the database by first getting all the data from the add recipe page and then sending it to the php script to save it in the database. It also gets the image for the recipe and passes that to the script to save it in an uploaded images folder while also saving the filepath to the database.
async function addRecipe() {
    let recipeName = document.getElementById("recipeName").value.toString();
    let recipeInstructions = document.getElementById("recipeInstructions").value.toString();
    let fileInput = document.getElementById("foodImage");
    const file = fileInput.files[0];

    let hasImage = !!file;

    //This makes sure that the recipe name and instructions validation matches the regular expressions before uploading as a small bit of front end validation before doing anything on the server side.
    if (recipeNameValidation.test(recipeName) && instructionsValidation.test(recipeInstructions)) {

        if (hasImage) {
            //This checks to see if the image is in a valid format before submitting to avoid any files that are not pictures.
            if (validateImage(fileInput)) {
                const response = await submitRecipe(recipeName, recipeInstructions, file, JSON.stringify(ingredients));
                if (response.ok) {
                    const responseData = await response.json();
                    if (responseData.success) {
                        window.location.href = responseData.redirect;
                    } else {
                        alert(responseData.message);
                    }
                } else {
                        alert("An error has occurred, please try again later.");
                }
            } else {
                alert("Recipe name or instructions is blank or is not in the correct format.");
            }
        }else{
            alert("Please add an image.");
        }
    }
}

//Like addRecipe, This gets the data from the form and then sends the data to the php script for it to be saved in the database. This time, the user doesn't have to upload an image if they don't want to so there is a small check to see if there was an image uploaded..
async function editRecipe() {
    let recipeName = document.getElementById("recipeName").value.toString();
    let recipeInstructions = document.getElementById("recipeInstructions").value.toString();
    let fileInput = document.getElementById("foodImage");
    const file = fileInput.files[0];

    //Check to see if there was an image uploaded, false if there is no image. This is used to tell the php script that there is no image and that the filepath doesn't have to be changed.
    let hasImage = !!file;

    //Recipe name and instructions form validation check.
    if (recipeNameValidation.test(recipeName) && instructionsValidation.test(recipeInstructions)) {

        //Image check to see if image is valid to be saved.
        if (validateImage(fileInput)) {
            const response = await confirmEditRecipe(recipeName, recipeInstructions, file, JSON.stringify(ingredients), hasImage);

            if (response.ok) {
                const responseData = await response.json();
                if (responseData.success) {
                    window.location.href = responseData.redirect;
                } else {
                    alert(responseData.message);
                }
            } else {
                alert("An error has occurred, please try again later.");
            }
        }
    } else {
        alert("Recipe name or instructions is blank or is not in the correct format.");
    }
}

//This function is used to get all the recipe information for the selected recipe to then populate the edit recipe form.
async function populateEditPage() {
    const myRecipeResponse = await getRecipe("display");
    if (myRecipeResponse.ok) {
        const myRecipe = await myRecipeResponse.json();
        if (myRecipe.success) {
            const recipeInfo = myRecipe.recipe;
            editFormData(recipeInfo);
        } else {
            alert(myRecipe.message);
        }
    }
}

//This takes the recipe information and puts it in the text boxes so the user doesn't have to type out everything again. This means that some things can be left the same if needed.
function editFormData(recipe) {
    document.getElementById("recipeName").value = recipe.recipename;
    document.getElementById("recipeInstructions").value = recipe.instructions;

    //Converts the ingredients which were once a string in the database to json to be displayed in the table. It stores them in the array that is declared globally.
    ingredients = JSON.parse(recipe.ingredients);

    //This displays all the ingredients in a table with a button to be able to remove them if a mistake was made.
    const ingredientTable = document.getElementById("editIngredientsTable");
    ingredients.forEach((ingredient, index) => {
        const row = ingredientTable.insertRow();
        const ingredientRow = row.insertCell(0);
        const amountRow = row.insertCell(1);
        const buttonRow = row.insertCell(2);

        ingredientRow.textContent = ingredient.ingredient;
        amountRow.textContent = ingredient.amount;
        buttonRow.innerHTML = '<button class=" btn btn-sm negativeButton" onclick="deleteIngredient(this, \'' + index + '\')"><i class="material-icons">close</i></button>';
    });
}

//validates image by checking the filetype using regular expressions. If file extension not valid, will return false and will not allow upload. If there is no file, or it matches it will return true. This is to make sure that files of the correct format are uploaded or no file at all. This is helpful when editing a recipe and the user does not want to edit the existing picture.
function validateImage(fileInput) {
    let filepath = fileInput.value;
    const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
    if (filepath && !allowedExtensions.exec(filepath)) {
        alert("File type not valid! Please try another file type.")
        return false;
    } else {
        return true;
    }
}

//On add ingredient press, ingredient and amount are added to table and added to ingredients array. It checks that there is something inside the fields before pushing to the array (global variable at the top of the page). It then displays the ingredient and amount in table on the addrecipe page. This is also used for editing recipes as the recipes as the ingredients are always overwritten when the recipes are updated.
function addIngredient(page) {
    let ingredient = document.getElementById("ingredient").value.trim();
    let amount = document.getElementById("amount").value.trim();

    //check to see if the page is the edit page to change the table it will be updating. The default is the add recipe ingredients table.
    let ingredientTable = document.getElementById("ingredientTable");
    if (page === "edit") {
        ingredientTable = document.getElementById("editIngredientsTable");
    }

    //checks to see if the boxes have been filled in before adding them. It then adds the ingredient and the amount to the table as well as creating a button to remove them if the user wishes..
    if ((ingredient !== "") && (amount !== "")) {
        ingredients.push({ingredient: ingredient, amount: amount});
        const ingredientPosition = ingredients.length - 1;

        const row = ingredientTable.insertRow();
        const ingredientRow = row.insertCell(0);
        const amountRow = row.insertCell(1);
        const buttonRow = row.insertCell(2);

        ingredientRow.textContent = ingredient;
        amountRow.textContent = amount;
        buttonRow.innerHTML = '<button class=" btn btn-sm negativeButton" onclick="deleteIngredient(this, \'' + ingredientPosition + '\')"><i class="material-icons">close</i></button>'

    } else {
        alert("Both the ingredient and amount box has to be filled in.")
    }
}

//deletes the ingredient out of the array as well as removing it from the table. It gets the closest "tr" to the button and removes it.
function deleteIngredient(button, index) {
    ingredients.splice(index, 1);
    const row = button.closest('tr');
    row.remove();
}


//function to submit the new recipe along with the picture.
async function submitRecipe(name, instructions, image, ingredients) {
    const formData = new FormData();
    formData.append('recipeName', name);
    formData.append('instructions', instructions);
    formData.append('image', image);
    formData.append('ingredients', ingredients);

    return await fetch('../Model/CreateRecipe.php', {
        method: 'POST',
        body: formData
    });
}

//Function to get all the new form data and submits it. It has hasImage there to say whether an image was uploaded or not for the php script to skip any unnecessary code.
async function confirmEditRecipe(name, instructions, image, ingredients, hasImage) {
    const formData = new FormData();
    formData.append('recipeName', name);
    formData.append('instructions', instructions);
    formData.append('image', image);
    formData.append('ingredients', ingredients);
    formData.append('action', "edit");
    formData.append('hasimage', hasImage);

    return await fetch('../Model/EditRecipe.php', {
        method: 'POST',
        body: formData
    });
}

//This function gets the selected recipe as well as passing in an action to get what is needed as this function is used multiple times and the php script is used to do multiple tasks.
async function getRecipe(action) {
    const formData = new FormData();

    formData.append('action', action);

    return await fetch('../Model/EditRecipe.php?', {
        method: 'POST',
        body: formData
    });
}


//uploading image using pure js - https://stackoverflow.com/questions/5587973/javascript-upload-file
//file extension validation - https://www.geeksforgeeks.org/file-type-validation-while-uploading-it-using-javascript/
//different way of doing the requests - https://dmitripavlutin.com/javascript-fetch-async-await/
//using new formdata() - https://developer.mozilla.org/en-US/docs/Web/API/FormData/FormData