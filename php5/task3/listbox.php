<?php

// this file basically buils a select drop down menu based off whats in the database.
include "db.inc.php"; //database connection
date_default_timezone_set('UTC');   //set timezone as usual

// select from Persons table the following details:
//Only show those not flagged for deletion. If flaged as 1 it means its to be deleted!
$sql = "SELECT personID, firstName, lastName, DOB, email, phone FROM persons where DeletedFlag = 0";

//error handling same as before
if (!$result = mysqli_query($con, $sql))
{
    die ('Error in querying the database' . mysqli_error($con));
}

//prints the select box into the webpage
echo "<br><select name = 'listbox' id = 'listbox' onclick = 'populate()'style='display:block; margin:0 auto;'>";

// loop through each database row
while ($row = mysqli_fetch_array($result))
{

    // extract each column value
    $id = $row['personID'];
    $fname = $row['firstName'];
    $sname = $row['lastName'];
    $dateofBirth = $row['DOB'];
    $email = $row['email']; //added email for task2
    $phone = $row['phone']; //added phone as task2

    //format the dob value
    $dob = date_create($row['DOB']);
    $dob = date_format($dob, "Y-m-d");

    // pack values into one string as <option> can only hold one value
    //task2 adds email and phone
    $allText = "$id,$fname,$sname,$dob,$email,$phone";

    // display only first and last name in drop down
    echo "<option value = '$allText'>$fname $sname</option>";
}

echo "</select>";
mysqli_close($con); // close off connection
?>
