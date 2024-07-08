//This function gets the meals from the database and then passes them to the function to set up the planner.
async function displayDay() {
    const plannerResponse = await getMeals();
    if (plannerResponse.ok) {
        const plannerInfo = await plannerResponse.json();

        if (plannerInfo.success) {
            const planner = plannerInfo.planner;
            console.log(planner);
            populatePlannerTable(planner);
        } else {
            alert(plannerInfo.message);
        }
    }
}

//This function gets the planner information and then displays it in the table for users to see what meals they have saved for each day of the week. The users can then remove the recipe from that day of the week with the button generated at the side of the recipe.
function populatePlannerTable(planner) {
    const plannerTable = document.getElementById("plannerTable");

    for (const dayOfWeek in planner) {
        if (planner.hasOwnProperty(dayOfWeek)) {
            const row = plannerTable.insertRow();
            const dayOfWeekRow = row.insertCell(0);
            const mealRow = row.insertCell(1);
            const buttonRow = row.insertCell(2);

            const recipe = planner[dayOfWeek];

            dayOfWeekRow.textContent = dayOfWeek;
            mealRow.textContent = recipe.recipename;

            //This checks to see if there is a recipe in the row to see if the cell is clickable.
            if (recipe) {
                mealRow.onclick = async function () {
                    await toRecipePage(recipe.recipeid)
                };
            }

            //This creates the button to remove from the planner. it passes the day of the week when it is used to know which row to clear.
            buttonRow.innerHTML = '<button class="negativeButton btn btn-sm" id="' + dayOfWeek + 'button" onclick="removeFromPlannerDay(\'' + dayOfWeek + '\')"><i class="material-icons">delete</i></button>';
        }
    }
}

//This is used to get all the meals that are stored in a specific user's planner.
async function getMeals() {
    return await fetch(`../Model/GetPlannerInfo.php?`);
}

//.onclick - https://www.w3schools.com/jsref/event_onclick.asp
// Add class to button in js - https://stackoverflow.com/questions/47429999/add-class-to-button-inside-a-js-function