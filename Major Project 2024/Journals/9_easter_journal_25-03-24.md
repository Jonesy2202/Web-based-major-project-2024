# 25-03-2024 to 14-04-2024 Journal
**Author: ryj7**

This blog covers the Easter break

Action 1: I have experimented further with the messages and redirection of the user upon login and registration to make the message/redirect system match for both login and register use cases. Both the javascript and php has been changed to make it more uniform for each of the functions.

Hours: 4

Action 2: I have also changed some of the columns in the tables so the types match up, more specifically, the username in the planners table which was previously userid. This has been changed so the queries will not be as long and complicated. The username column has also had its type changed from VARCHAR to VARCHAR(15) to match the users table as it was causing errors with the data types not matching.

Hours: 1

Action 3: I have added a way to add a recipe to the recipes table with some validation. More validation is needed but all fields are filled correctly in the table. The current validation is to check if the image is the correct file type as well as some regular expression checks to avoid any forbidden characters. Other validation includes: checking for empty fields in the ingredients table and to check if there is actually a file to be uploaded in the related php file.

Hours: 6

Action 4: I have added some back end code to edit recipes created by a specific user.

Hours: 3

Action 5: I have added a way for the user to be able to see what recipes they have made on the "my recipes" page as well as adding a button to each of the rows of the table on this page to delete or edit the recipe if the user wishes.

Hours: 5

TOTAL HOURS: 19