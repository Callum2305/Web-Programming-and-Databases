<?php

$hostname = "localhost";    //hostname or ip address
$username = "Name_Here";     //MySQL username
$password = "Pass_Here"; //password for MySQL data base only

$dbname = "My_DBC_Name";   //Database name

//create a connection to database using detials in ()
$con = mysqli_connect($hostname, $username, $password, $dbname);

//if connection failed:
if (!$con)
    {
        //stop and display error message of why connection failed
        die ("Failed to connect to MySQL: " . mysqli_connect_error());
    }

?>