//This function displays the selected recipe using jquery. If the response was successful, the recipe will be displayed on a new page with all the data for that recipe.
async function displaySelectedRecipe() {

    const myRecipeResponse = await getRecipe("display");
    if (myRecipeResponse.ok) {
        const selectedRecipe = await myRecipeResponse.json();
        console.log(selectedRecipe);

        if (selectedRecipe.success) {
            //replaces all the new lines with <br> to be able to display the instructions on new lines, so it is easier to follow.
            const recipe = selectedRecipe.recipe;
            const instructions = recipe.instructions.replace(/\r?\n/g, '<br>')

            //Adds the data to the correct elements and changes the size of the picture as needed.
            $('#recipeHeader').text(recipe.recipename);
            $('#recipeCreator').text("By" + recipe.creator);
            $('#recipeImage').attr('src', recipe.imagefilepath).css({
                'object-fit': 'contain',
                'height': 'auto',
                'width': '60%'
            });
            $('#recipeInstructions').html(instructions);

            //converts the ingredients string back into json to be passed to the function to display the ingredients in a table.
            const ingredients = JSON.parse(recipe.ingredients);

            displayIngredientsTable(ingredients);
        }
    }
}

//This function is used to display all the ingredients in a table to make it easier to read. The ingredients also have the amounts for each of them.
function displayIngredientsTable(ingredients) {
    const ingredientTable = document.getElementById("recipeIngredientsTable");

    ingredients.forEach((ingredient) => {
        const row = ingredientTable.insertRow();
        const ingredientRow = row.insertCell(0);
        const amountRow = row.insertCell(1);

        ingredientRow.textContent = ingredient.ingredient;
        amountRow.textContent = ingredient.amount;
    });
}

//This is used to get the recipe that was selected beforehand. The recipe id was stored in a session variable and could be accessed to view this.
async function getRecipe(action) {
    const formData = new FormData();

    formData.append('action', action);

    return await fetch('../Model/EditRecipe.php?', {
        method: 'POST',
        body: formData
    });
}
