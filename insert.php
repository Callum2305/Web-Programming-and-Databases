
<?php include 'session_check.php'; ?>
<?php include "menu.php"; ?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="page.css">
</head>
<body>
<h2>Insert New Details</h2>

<form action="insertSuccess.php" method="post" onsubmit="return validateForm()">

<p>
    <label for="firstname">First Name</label>
    <input type="text" id="firstname" name="firstname" required autocomplete="off">
</p>

<p>
    <label for="lastname">Last Name</label>
    <input type="text" id="lastname" name="lastname" required autocomplete="off">
</p>

<p>
    <label for="dob">Date of Birth</label>
    <input type="date" id="dob" name="dob" required>
</p>

<p>
    <label for="email">Email Address</label>
    <input type="email" id="email" name="email" required autocomplete="off">
</p>

<p>
    <label for="phone">Mobile Number</label>
    <input type="text" id="phone" name="phone" required autocomplete="off">
</p>

<br>

<input type="submit" value="Submit">
<input type="reset" value="Clear">

</form>

</body>
</html>
