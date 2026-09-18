
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
<!--Because the follwoing is wrapped in a form tag, css gets applied. Hence a large white block that shouldnt be there-->
<!--To fix this, i just will specify that i want 0 or none conditions on the parts that my css file would normally change-->
<form action = "PersonReport.php" method = "post" name = "reportForm" style="background:none; padding:0; margin:0; width:auto; border:none;">
<input type = "hidden" name = "choice">
</form>

<h1>Person Report</h1>
<h3>(Click a button to see the Person Report in the desired order)</h3>
<input type = 'button' id = "dateButton" value = 'Date of Birth Order' onclick = 'dateOrder()' title = 'Click here to see persons in reverse date of birth order'>
<input type = 'button' id = "nameButton" value = 'Surname Order' onclick = 'surnameOrder()' title = 'Click here to see Persons in alphabetical order of surname'>
<br>
<br>

<!--Slide 2 code-->
<script>

function dateOrder()
    {
        document.reportForm.choice.value = "DOB";
        document.reportForm.submit();
    }

function surnameOrder()
    {
        document.reportForm.choice.value = "Surname";
        document.reportForm.submit();
    }

</script>

<?php

$choice = "Surname"; //incase this is the first time through and $_POST(choice) hasnt been set
if (ISSET($_POST['choice']))
{
    $choice = $_POST['choice'];
}
if ($choice == "DOB")
{
?>
    <script>
        document.getElementById("dateButton").disabled = true;
        document.getElementById("nameButton").disabled = false;
    </script>
<!--End of slide 2 code-->

<!--Slide 3 code starts here-->
<?php

    $sql = "SELECT * FROM persons WHERE DeletedFlag = false ORDER BY DOB DESC";
    produceReport($con,$sql);
}

else //if ($choice == "surname") or the default display before any button is clicked
{
?>
    <script>
        document.getElementById("nameButton").disabled = true;
        document.getElementById("dateButton").disabled = false;
    </script>
<?php
    $sql = "SELECT * FROM persons where DeletedFlag = false ORDER BY lastName";
    produceReport($con,$sql);
};
//End of Slide 3 code

//Start of slide 4 code, final slide
function produceReport($con,$sql)
{
    $result = mysqli_query($con,$sql);
    // style='margin:20px auto;' centers table as margin auto calculates distance from both sides to the edge of browser, horizontally
    echo "<table style='margin:20px auto;'>
            <tr>
                <th>Surname</th>
                <th>First Name</th>
                <th>Date of Birth</th>
            </tr>";
            
    while ($row=mysqli_fetch_array($result))
        
    {   //set up the date for the display
        $date = date_create($row['DOB']);
        $FDate = date_format($date,"d/m/Y");

        echo "<tr>
                <td>".$row['lastName']."</td>
                <td>".$row['firstName']."</td>
                <td>". $FDate."</td>
                </tr>";
    }
    echo "</table>";
}

    mysqli_close($con);
?>
</body>
</html>