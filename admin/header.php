<?php
include 'config.php';
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <title>BESCOM Online Portal</title>

    <script>
        function validateForm()
        {   var usern = document.forms["RegForm"]["username"].value;
            if(usern.length < 4 || usern.length > 11){
                alert("Username should be of 4-10 characters long.");
                return false;
            }

            var passw = document.forms["RegForm"]["password"].value;
            if(passw.length <6)
            {
                alert("Not a secure password, length is less than 6 characters.");
                return false;
            }

            var mob = document.forms["RegForm"]["contact"].value;
            if(mob.length != 10)
            {
                alert("Contact number incorrect. Should be of 10 characters.");
                return false;
            }
        }
    </script>
    
</head>