<?php include 'session_check.php'; ?>
<head>
    <link rel="stylesheet" type="text/css" href="page.css">
</head>
<?php include "menu.php"; ?>
<?php


include 'db.inc.php';
date_default_timezone_set("UTC");

$firstname = mysqli_real_escape_string($con, $_POST['firstname']);
$lastname  = mysqli_real_escape_string($con, $_POST['lastname']);
$dob       = mysqli_real_escape_string($con, $_POST['dob']);
$email     = mysqli_real_escape_string($con, $_POST['email']);
$phone     = mysqli_real_escape_string($con, $_POST['phone']);

$sql = "INSERT INTO persons (firstName, lastName, DOB, email, phone, DeletedFlag)
        VALUES ('$firstname', '$lastname', '$dob', '$email', '$phone', 0)";

if (!mysqli_query($con, $sql))
{
    die("Error inserting record: " . mysqli_error($con));
}

echo "<h3>Record successfully added!</h3>";
echo "<h3>First name: " . htmlspecialchars($firstname) . "</h3>";
echo "<h3>Surname: "    . htmlspecialchars($lastname)  . "</h3>";
echo "<h3>Date of Birth: " . htmlspecialchars($dob)    . "</h3>";
echo "<h3>Phone Number: "  . htmlspecialchars($phone)  . "</h3>";
echo "<h3>Email Address: " . htmlspecialchars($email)  . "</h3>";

mysqli_close($con);
?>

<br><br>
<form action="insert.php" method="post">
    <input type="submit" value="Return to Insert Page">
</form>
