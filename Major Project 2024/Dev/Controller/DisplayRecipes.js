//global variable to store all recipes locally for now.
let allRecipes = [];

//This gets all the recipes and converts them to json, so they are ready to be displayed using populateRecipes. If there was an issue getting all the recipes, it returns an error message that will be displayed.
async function displayRecipes() {
    const recipesResponse = await getRecipes("getRecipes");
    if (recipesResponse.ok) {
        const myRecipes = await recipesResponse.json();

        if (myRecipes.success) {
            const recipesList = myRecipes.recipes;
            allRecipes = myRecipes.recipes;
            populateRecipes(recipesList);
        } else {
            alert(myRecipes.message);
        }
    }
}

//This function has a foreach loop that calls createRecipeCard() to create the cards for the recipes for them to be displayed on the recipes page.
function populateRecipes(recipes) {
    //clear existing recipes
    $('#recipeContainer').empty();

    recipes.forEach((recipe) => {
        createRecipeCard(recipe);
        // create cards in here
    });
}

//This function checks if the recipes are in the array to display them. it gets the information from the search bar and then trims it and puts it to lower case to then compare them with existing recipes and creators. If they exist they will display them.
function searchRecipes(){
    let recipeSearchItem = document.getElementById("searchRecipe").value.trim().toLowerCase();

    //allows for search of creator or recipe name
    const filteredRecipes = allRecipes.filter(recipe => {
        return recipe.recipename.toLowerCase().includes(recipeSearchItem) || recipe.creator.toLowerCase().includes(recipeSearchItem);
    });

    populateRecipes(filteredRecipes);

}

//This function takes the recipe data and creates a card for each of the recipes that are sent to this function. It firstly creates the card and then adds the header, the image of the recipe and the creator. It then appends the parts of the card to the main card ready to be displayed. It uses jquery to append the card to the correct div on the recipes page.
function createRecipeCard(recipe) {
    //this removes the unnecessary parts of the filepath from what is stored in the database as there is a change in the path needed to display the image.
    let image = recipe.imagefilepath.substring(8);

    //This creates the card and the parts of the card needed.
    let $recipeCard = $('<div>').addClass('mainrecipecard recipecard card col-lg-3 col-md-5').click(async function () {
        await toRecipePage(recipe.recipeid)
    });
    let $cardHeader = $('<div>').addClass('recipecard card-header text-center').text(recipe.recipename);
    let $cardImg = $('<div>').addClass('card-img').append($('<img>').addClass('recipe-image').attr('src', image).attr('alt', "Image of" + recipe.recipename));
    let $cardBody = $('<div>').addClass('recipecard card-footer text-center').text("By " + recipe.creator);

    //Append card components to the recipe card.
    $recipeCard.append($cardHeader, $cardImg, $cardBody);

    //Append the recipe card to the container.
    $('#recipeContainer').append($recipeCard);
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

//This function gets all the recipes created to display them on the recipes page.
async function getRecipes(action) {
    const formData = new FormData();

    formData.append('action', action);

    return await fetch('../Model/GetRecipes.php?', {
        method: 'POST',
        body: formData
    });
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