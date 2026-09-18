
<?php include 'session_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="page.css">
</head>
<body>
<?php include "menu.php"; ?>
<?php
include 'db.inc.php';
date_default_timezone_set('UTC');
?>

<form action="PersonReport.php" method="post" name="reportForm"
      style="background:none; padding:0; margin:0; width:auto; border:none;">
    <input type="hidden" name="choice">
</form>

<h1>Person Report</h1>
<h3>(Click a button to see the Person Report in the desired order)</h3>

<input type='button' id="dateButton"  value='Date of Birth Order' onclick='dateOrder()'
       title='Click here to see persons in reverse date of birth order'>
<input type='button' id="nameButton"  value='Surname Order'       onclick='surnameOrder()'
       title='Click here to see Persons in alphabetical order of surname'>
<input type='button' id="emailButton" value='Email Address Order'  onclick='emailOrder()'
       title='Click here to see Persons in alphabetical order of email'>
<br><br>

<script>
function dateOrder()   { document.reportForm.choice.value = "DOB";     document.reportForm.submit(); }
function surnameOrder(){ document.reportForm.choice.value = "Surname";  document.reportForm.submit(); }
function emailOrder()  { document.reportForm.choice.value = "Email";    document.reportForm.submit(); }
</script>

<?php
$choice = "Surname";
if (isset($_POST['choice'])) {
    $choice = $_POST['choice'];
}

if ($choice == "DOB")
{
?>
    <script>
        document.getElementById("dateButton").disabled  = true;
        document.getElementById("nameButton").disabled  = false;
        document.getElementById("emailButton").disabled = false;
    </script>
<?php
    $sql = "SELECT * FROM persons WHERE DeletedFlag = false ORDER BY DOB DESC";
    produceReport($con, $sql);
}
else if ($choice == "Surname")
{
?>
    <script>
        document.getElementById("nameButton").disabled  = true;
        document.getElementById("dateButton").disabled  = false;
        document.getElementById("emailButton").disabled = false;
    </script>
<?php
    $sql = "SELECT * FROM persons WHERE DeletedFlag = false ORDER BY lastName";
    produceReport($con, $sql);
}
else
{
?>
    <script>
        document.getElementById("nameButton").disabled  = false;
        document.getElementById("dateButton").disabled  = false;
        document.getElementById("emailButton").disabled = true;
    </script>
<?php
    $sql = "SELECT * FROM persons WHERE DeletedFlag = false ORDER BY email";
    produceReport($con, $sql);
}

function produceReport($con, $sql)
{
    $result = mysqli_query($con, $sql);
    echo "<table style='margin:20px auto;'>
            <tr>
                <th>Surname</th>
                <th>First Name</th>
                <th>Date of Birth</th>
                <th>Email Address</th>
                <th>Phone Number</th>
            </tr>";

    while ($row = mysqli_fetch_array($result))
    {
        $date  = date_create($row['DOB']);
        $FDate = date_format($date, "d/m/Y");

        echo "<tr>
                <td>" . htmlspecialchars($row['lastName'])  . "</td>
                <td>" . htmlspecialchars($row['firstName']) . "</td>
                <td>" . $FDate . "</td>
                <td>" . htmlspecialchars($row['email'])     . "</td>
                <td>" . htmlspecialchars($row['phone'])     . "</td>
              </tr>";
    }
    echo "</table>";
}

mysqli_close($con);
?>
</body>
</html>
