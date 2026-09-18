<?php   session_start();
        include 'menu.php'; ?><br><br>

<?php
include 'db.inc.php';


$sql = "UPDATE persons SET deletedflag = true WHERE personid = '$_POST[delid]'";
//alternatively, if you want to actually deleted the record, not just set the flag.
// $sql = "delete from persons where personid = '$_POST[delid]'";

if (! mysqli_query($con, $sql ))
{
    echo "Error ".mysqli_error($con);
}

//set session variables with: $_SESSION[''] = $_POST[''];
$_SESSION['personid'] = $_POST['delid'];
$_SESSION['firstname'] = $_POST['delfirstname'];
$_SESSION['lastname'] = $_POST['dellastname'];

mysqli_close($con);
//header ('Location: delete.html.php') ;
//exit();
?>

<script>

    window.location = "delete.html.php"
</script>
