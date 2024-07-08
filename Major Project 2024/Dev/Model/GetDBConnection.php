<?php
// Edel Sherratt October 2022
// returns a PHP data object (PDO)

require 'C:\Users\ryanj\Documents\A - Uni stuff\Year 3\Secret\DBPrivateInfo.php'; // add path to file containing the connection parameters - probably on M: if you are using a Uni. windows workstation

function get_db_connection() {
    $data_source_name = DB_DRIVER.":host=".DB_HOST.";dbname=".DB_NAME;
    try {
        return new PDO($data_source_name, DB_USER, DB_PASSWORD);
    } catch (PDOException $e) {
        echo "couldn't get a handle on the database ".$e."\n";
        return NULL;
    }
}