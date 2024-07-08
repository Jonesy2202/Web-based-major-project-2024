//This function gets all the ingredients from all the recipes in the planner and combines them to be displayed in one list. It uses populateShoppingList() to do this.
async function displayShoppingList() {
    const plannerResponse = await getIngredients();
    // for each day of the week display it in each of the rows
    // add button to edit that when clicked, it clears the planner day
    if (plannerResponse.ok) {
        const plannerInfo = await plannerResponse.json();

        if (plannerInfo.success) {
            const planner = plannerInfo.planner;
            console.log(planner);
            populateShoppingList(planner);
        } else {
            alert(plannerInfo.message);
        }
    }
}

//This takes the entire planner for a user and then goes through each of the days in the planner to get the recipe and then loops through each of the ingredients in the json data that is stored in the ingredients field.
function populateShoppingList(planner) {
    const ingredientsTable = document.getElementById("shoppingListTable");
    //Loops through each of the days of the week.
    for (const dayOfWeek in planner) {
        const recipe = planner[dayOfWeek];
        //If that day of the week has a recipe it will go through the ingredients.
        if (recipe) {
            const recipeIngredients = JSON.parse(recipe.ingredients);

            for (const ingredient of recipeIngredients) {
                const row = ingredientsTable.insertRow();
                const ingredientRow = row.insertCell(0);
                const amountRow = row.insertCell(1);
                const buttonRow = row.insertCell(2);

                ingredientRow.textContent = ingredient.ingredient;
                amountRow.textContent = ingredient.amount;

                //this one has to be done this way instead of using innerhtml as the ids need to be set to be able blank out that day.
                buttonRow.innerHTML =
                    '<button class="positiveButton btn btn-sm" onclick="checkIngredientList(this)"><i class="material-icons">check_circle</i></button>' +
                    '<button class="negativeButton btn btn-sm" onclick="removeIngredientFromList(this)"><i class="material-icons">delete</i></button>'
                ;
            }
        }
    }
}

//This function crosses out the ingredient in the shopping list when the check item button is pressed.
function checkIngredientList(ingredientRow) {
    const rowElement = ingredientRow.parentNode.parentNode;
    rowElement.classList.toggle("checked");
}

//This function removes an ingredient from the shopping list when the delete button is pressed.
function removeIngredientFromList(ingredientRow) {
    const rowElement = ingredientRow.parentNode.parentNode;
    rowElement.remove();
}

//This function gets the planner for a user.
async function getIngredients() {
    return await fetch(`../Model/GetPlannerInfo.php?`);
}