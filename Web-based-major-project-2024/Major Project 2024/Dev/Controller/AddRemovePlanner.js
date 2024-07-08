//This function sends the day that the user selects to set a certain recipe to be added to a certain day in the planner by getting the input from the user in a dropdown menu. The day is turned to lowercase as that is how the days are in the column headers.
async function addToPlannerDay() {
    let day = document.getElementById("plannerDays").value
    day.toLowerCase();
    const plannerResponse = await addRemovePlanner("add", day);

    if (plannerResponse.ok) {
        const plannerResponseData = await plannerResponse.json();
        if (plannerResponseData.success) {
            window.location.href = plannerResponseData.redirect;
        } else {
            alert("Unable to add this recipe to your planner at this time.");
        }
    }
}

//This function gets the day that the user wants to remove a recipe from in their planner. It passes the day to the function that sends the selected day to the php file.
async function removeFromPlannerDay(day) {
    const plannerResponse = await addRemovePlanner("remove", day);

    if (plannerResponse.ok) {
        const plannerResponseData = await plannerResponse.json();
        if (plannerResponseData.success) {
            alert(plannerResponseData.message)
            location.reload();
        } else {
            alert("Unable to edit recipe your planner at this time.");
        }
    }
}

//This function will send the action and day to the php file to either add or remove from the planner depending on the action that is sent.
async function addRemovePlanner(action, day) {
    const formData = new FormData();

    formData.append('action', action);
    formData.append('day', day);

    return await fetch('../Model/AddRemovePlanner.php?', {
        method: 'POST',
        body: formData
    });
}