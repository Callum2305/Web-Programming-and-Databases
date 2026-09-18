<?php include 'db.inc.php';

session_start();
echo '<link rel="stylesheet" href= "pass.css" type="text/css">';
if (isset($_POST['loginName']) && isset($_POST['passWord']))
{
    $attempts = $_SESSION['attempts'];

    $sql = "SELECT * FROM password WHERE loginName = '$_POST[loginName]' AND passWord = '$_POST[passWord]'";

    //task2 change, make vairbale of result from query
    $result = mysqli_query($con, $sql);


    if (!$result)
    {
        echo "Error in query ". mysqli_error($con);
    }

    else
    {
        if (mysqli_num_rows($result) == 0 )
        {
            $attempts++;

            if ($attempts <= 3)
            {
                $_SESSION['attempts'] = $attempts;
                buildPage($attempts);

                echo "<div class='errorstyle'>No record found with this login name and password combination - Please try again.</div>";
            }

            else
            {
                echo "<div class='errorstyle'>Sorry - You have used all 3 attempts<br>
                        Shutting down ...</div>";
            }
        }

        else
        {
            //successful login
            $_SESSION['user'] = $_POST['loginName']; //session variable to keep track of login name
                                                        // for use with change password screen



            //message for task2
            $row = mysqli_fetch_assoc($result);

            $today = date("m-d");
            $dob = date("m-d", strtotime($row['dob']));

            if ($today === $dob) 
                {
                    echo "<div class='errorstyle'> Happy Birthday, {$_POST['loginName']}!</div>";
                }

            echo " <h2> Login successful! </h2>
                    <h2>Welcome to our website</h2>
                    <h3>Do you want to change your password or go directly to the Main Menu?</h3>
					<div style='text-align: center;'>
						<input type = 'button' value = 'Change Password' onclick = 'window.location = \"changePass.php\"'>
						<input type = 'button' value = 'Main Menu' onclick = 'window.location = \"menu.php\"'>
					</div>";
        }
    }
}
else
{
    //session_unset();    // to clear old session data and rest the attempts every time, could be a fix needed later?
    //building page for initial display
    $attempts = 1;  //screen will be displayed for first attempt
    $_SESSION['attempts'] = $attempts;  //set session variables so that the number of attempts can be counted
    buildPage($attempts);   //parameter passed so that a heading can display the number of attempts
};

function buildPage($att)
{
    echo "  <body>
            <form action = 'loginScreen.php' method = 'post'>
            <h1> Our Website</h1>
            <h2>Attempt Number: $att </h2>
            <label for ='loginName'>Login Name</label>
            <input type 'text' name = 'loginName' id = 'loginName' autocomplete = 'off'/><br><br>
            <label for ='password'>Password</label>
            <input type = 'passWord' name = 'passWord' id = 'passWord' ><br><br>
            <input type = 'submit' value = 'Submit'>
            </form>";
}
mysqli_close($con);
?>