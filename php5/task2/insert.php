
<?php include "menu.php"; ?>
<html>
    <head>
    <link rel="stylesheet" type="text/css" href="page.css">
</head>
<body>
<h2>Insert New Details</h2>

<!-- get details for new person-->
<form action="insertSuccess.php" method="post" onsubmit="return validateForm()">

<p>
    <!-- requierd , input as text as usual, autocomplete off as we dont want it autofilling -->
    <label for="firstname">First Name</label>
    <input type="text" id="firstname" name="firstname" required autocomplete="off">
</p>

<p>
    <!--Same as first name, byt for last-->
    <label for="lastname">Last Name</label>
    <input type="text" id="lastname" name="lastname" required autocomplete="off">
</p>

<p>
    <!-- date box menu thing we see on websites -->
    <label for="dob">Date of Birth</label>
    <input type="date" id="dob" name="dob" required>
</p>

<p>
    <!-- set input type email cause i dont wanna use JS to validate it -->
    <label for="email">Email Address</label>
    <input type="email" id="email" name="email" required autocomplete="off">
</p>

<p>
    <!-- Phone number -->
    <label for="phone">Mobile Number</label>
    <input type="text" id="phone" name="phone" required autocomplete="off">
</p>

<br>

<!-- submit and reset buttons , usual craic-->
<input type="submit" value="Submit">
<input type="reset" value="Clear">

</form>

</body>
</html>
