<?php
$MySQLHost     = "localhost";           // MySQL Host. Usually mysql.
$MySQLDatabase = "interactive_fiction"; // Database.
$MySQLUsername = "if_usr";              // Database Username.
$MySQLPassword = "QbBqFRz2YLTRsnLp";    // Database Password. 

// Misc actions
$dbh = mysql_connect ($MySQLHost, $MySQLUsername, $MySQLPassword); 
mysql_select_db ($MySQLDatabase,$dbh);

//
$mysqli = new mysqli($MySQLHost, $MySQLUsername, $MySQLPassword, $MySQLDatabase);
?>