# Site Setup
### By Ryan Jones (ryj7)

These instructions should help in setting up the site to be used on any web server that has access to a PostgreSQL RDBMS. 

1. The first step to setting up the site is to copy all the files in the Dev section of this project.
2. After copying the directory, it is important to change the web permissions to ensure that users can only see or run certain files when accessing the site.
3. Once the web permissions have been changed, a private file needs to be saved outside the directory that allows public access to the site. Below is an example of what is needed in this private file:

'<?PHP

   const DB_DRIVER = 'pgsql';

   const DB_HOST = 'database_host';

   const DB_NAME = 'database_name';

   const DB_USER = 'database_user';

   const DB_PASSWORD = 'database_password';
   ?>'
   
4. Once this file is created, the GetDBConnection.php file needs to be changed to have the absolute file path of the private database information added to the "require" section at the top of the file. To get the absolute file path of the file you can navigate to the file in the terminal and use "pwd" to get the file path and then add the file name at the end. The file path should be contained in apostrophes on each side. It should look like this:

require 'C:\Users\username\SecretFile\secretDBInfo.php';

5. After setting up the connection to the database, the tables need to be created. These tables can be created using the following queries:

CREATE TABLE Users (

userid SERIAL PRIMARY KEY,

username VARCHAR(15) UNIQUE,

password VARCHAR(255),

usertype VARCHAR(7) DEFAULT 'regular'

);

---
CREATE TABLE Recipes (

recipeid SERIAL PRIMARY KEY,

recipeName VARCHAR(100),

creator VARCHAR,

imageFilePath TEXT,

ingredients TEXT,

instructions TEXT,

FOREIGN KEY (creator) REFERENCES Users(username)
);
---
CREATE TABLE Planner (

plannerID SERIAL PRIMARY KEY,

username VARCHAR(15),

monday INT,

tuesday INT,

wednesday INT,

thursday INT,

friday INT,

saturday INT,

sunday INT,

FOREIGN KEY (username) REFERENCES users (username),

FOREIGN KEY (monday) REFERENCES recipes (recipeid),

FOREIGN KEY (tuesday) REFERENCES recipes(recipeid),

FOREIGN KEY (wednesday) REFERENCES recipes(recipeid),

FOREIGN KEY (thursday) REFERENCES recipes(recipeid),

FOREIGN KEY (friday) REFERENCES recipes (recipeid),

FOREIGN KEY (saturday) REFERENCES recipes (recipeid),

FOREIGN KEY (Sunday) REFERENCES recipes (recipeid)

);