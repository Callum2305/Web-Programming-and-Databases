<head>
    <link rel="stylesheet" type="text/css" href="page.css">
</head>
<?php include "menu.php"; ?>
<?php


include 'db.inc.php';        //connect to our databases
date_default_timezone_set("UTC");     // set a timezone, same as always, UTC

// get values with POST, not GET
$firstname = $_POST['firstname'];
$lastname  = $_POST['lastname'];
$dob       = $_POST['dob'];
$email     = $_POST['email'];
$phone     = $_POST['phone'];

//insert query to insert into Persons table, sith each column mentioned. specify what data to put in, must be same order
//set deleted flag to 0 as these are newly added details, and are not set for deletion by default.
$sql = "INSERT INTO persons (firstName, lastName, DOB, email, phone, DeletedFlag)
        VALUES ('$firstname', '$lastname', '$dob', '$email', '$phone', 0)";

// Execute the query and stop if an error occurs
if (!mysqli_query($con, $sql)) 
    {
        die("Error inserting record: " . mysqli_error($con));
    }

// Display confirmation of successful insertion
echo "<h3>Record successfully added!</h3>";
echo "First name: $firstname <br>";
echo "Surname: $lastname <br>"; 
echo "Date of Birth: $dob <br>";
echo "Phone Number: $phone <br>";
echo "Email Address: $email <br>";

mysqli_close($con); //close connection again
?>

<br>
<br>
<!-- submit button, classic -->
<form action="insert.html" method="post">
    <input type="submit" value="Return to Insert Page">
</form>
