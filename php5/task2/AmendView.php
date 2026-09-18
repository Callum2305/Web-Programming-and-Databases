<html>

<head>
<!-- Link external CSS stylesheet -->
<link rel="stylesheet" type="text/css" href="AmendView.css">

</head>

<body>
<?php include "menu.php"; ?>
<h1>Amend/View a Person</h1>
<h4>Please select a person and then click the amend button if you wish to update</h4>

<!-- Include PHP file that generates the listbox -->
<?php include 'listbox.php'; ?>

<script>

    //this function loads selected person data
    function populate()
    {
        // Get reference to listbox
        var sel = document.getElementById("listbox");
        var result;

        // grab selected option value
        result = sel.options[sel.selectedIndex].value;

        // split comma separated values into array
        var personDetails = result.split(',');


        
        // populate form fields with selected data    
        document.getElementById("amendid").value = personDetails[0];
        document.getElementById("amendfirstname").value = personDetails[1];
        document.getElementById("amendlastname").value = personDetails[2];
        document.getElementById("amendDOB").value = personDetails[3];

        //task2 add phone number and email
        document.getElementById("amendemail").value = personDetails[4];
        document.getElementById("amendphone").value = personDetails[5];

    }

    // this function enables and disables editing/amending the database. So view or ammend
    function toggleLock()
    {

        // Check current button state
        if (document.getElementById("amendViewbutton").value == "Amend Details")
        {
            // Enable editing of fields
            document.getElementById("amendfirstname").disabled = false;
            document.getElementById("amendlastname").disabled = false;
            document.getElementById("amendDOB").disabled = false;

            //added in task2
            document.getElementById("amendemail").disabled = false;  
            document.getElementById("amendphone").disabled = false;

            // Change button text
            document.getElementById("amendViewbutton").value = "View Details";
        }
        else
        {
            // Disable editing because this is View only mode
            document.getElementById("amendfirstname").disabled = true;
            document.getElementById("amendlastname").disabled = true;
            document.getElementById("amendDOB").disabled = true;

            //added in task 2
            document.getElementById("amendemail").disabled = true;
            document.getElementById("amendphone").disabled = true;

            // Restore button text
            document.getElementById("amendViewbutton").value = "Amend Details";
        }

    }

    //function to check with user they want to save
    function confirmCheck()
    {
        var response;   //variable to store respons and check what was chose

        // Ask user to confirm update
        response = confirm('Are you sure you want to save these changes?');

        if (response)
        {
            // enable again the disabled fields so values are submitted
            document.getElementById("amendid").disabled = false;
            document.getElementById("amendfirstname").disabled = false;
            document.getElementById("amendlastname").disabled = false;
            document.getElementById("amendDOB").disabled = false;

            //task 2 phone and email
            document.getElementById("amendemail").disabled = false;
            document.getElementById("amendphone").disabled = false;


            return true;    //let form be submitted
        }
        else
        {
            // reset and restore original selected values
            populate();
            toggleLock();   //return to view mode

            return false;
        }
    }
</script>

<!-- Area to display selected person details -->
<p id="display"></p>

<!-- Button to toggle between Amend/View modes -->
<input type="button" value="Amend Details" id="amendViewbutton" onclick="toggleLock()">

<!-- Form used to submit amended details -->
<form name="myForm" action="AmendView2.php" onsubmit="return confirmCheck()" method="post">

<!-- personID, cant be edited -->
<label for="amendid">Person Id</label>
<input type="text" name="amendid" id="amendid" disabled>

<!-- rest of personal details-->

<label for="amendfirstname">First Name</label>
<input type="text" name="amendfirstname" id="amendfirstname" disabled>

<label for="amendlastname">Surname</label>
<input type="text" name="amendlastname" id="amendlastname" disabled>

<label for="amendDOB">Date of Birth</label>
<input type="date" name="amendDOB" id="amendDOB" title="format is dd-mm-yyyy" disabled>

<!--Task 2, email and phone number added here-->
<label for="amendemail">Email</label>
<input type="email" name="amendemail" id="amendemail" disabled>

<label for="amendphone">Phone</label>
<input type="text" name="amendphone" id="amendphone" disabled>


<br><br>

<!-- Submit button -->
<input type="submit" value="Save Changes">

</form>


</body>
</html>
