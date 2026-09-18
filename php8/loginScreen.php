<?php

include 'db.inc.php';
session_start();

// If already logged in, redirect to homepage
if (isset($_SESSION['user'])) {
    header("Location: homepage.php");
    exit();
}

echo '<link rel="stylesheet" href="page.css" type="text/css">';

if (isset($_POST['loginName']) && isset($_POST['passWord']))
{
    $attempts = $_SESSION['attempts'];

    $loginName = mysqli_real_escape_string($con, $_POST['loginName']);
    $passWord  = mysqli_real_escape_string($con, $_POST['passWord']);

    $sql = "SELECT * FROM password WHERE loginName = '$loginName' AND passWord = '$passWord'";

    $result = mysqli_query($con, $sql);

    if (!$result)
    {
        echo "Error in query: " . mysqli_error($con);
    }
    else
    {
        if (mysqli_num_rows($result) == 0)
        {
            $attempts++;

            if ($attempts <= 3)
            {
                $_SESSION['attempts'] = $attempts;
                buildPage($attempts);
                echo "<h3>No record found with this login name and password combination - Please try again.</h3>";
            }
            else
            {
                echo "<h3>Sorry - You have used all 3 attempts.<br>Shutting down...</h3>";
            }
        }
        else
        {
            // Successful login — set session variables
            $_SESSION['user']     = $_POST['loginName'];
            $_SESSION['loggedIn'] = true;

            echo "<h2>Login successful!</h2>
                  <h2>Welcome, " . htmlspecialchars($_POST['loginName']) . "!</h2>
                  <h3>Click below to continue</h3>
                  <div style='text-align:center;'>
                      <input type='button' id='mainMenuButton' value='Main Menu'
                             onclick='window.location=\"homepage.php\"'>
                  </div>";
        }
    }
}
else
{
    // First visit — initialise attempt counter
    $attempts = 1;
    $_SESSION['attempts'] = $attempts;
    buildPage($attempts);
}

function buildPage($att)
{
    echo "<body>
          <form action='loginScreen.php' method='post'>
              <h1>Our Website</h1>
              <h2>Attempt Number: $att</h2>
              <label for='loginName'>Login Name</label>
              <input type='text' name='loginName' id='loginName' autocomplete='off'><br><br>
              <label for='passWord'>Password</label>
              <input type='password' name='passWord' id='passWord'><br><br>
              <input type='submit' value='Submit'>
          </form>";
}

mysqli_close($con);
?>
