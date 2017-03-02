<?php
include 'header.php';
$msg="";
$emailErr="";
if(!isset($_SESSION['aid']) || empty($_SESSION['aid']))
{
    header('Location: login.php');
}

else
{
    $check = "SELECT * FROM admin WHERE aid = '".$_SESSION['aid']."'";
    $result = $conn->query($check);
    $row = mysqli_fetch_row($result);
    $cur_aid = $row[0];
    $cur_username = $row[1];
    $cur_password = $row[2];
    $cur_fname = $row[3];
    $cur_lname = $row[4];
    $cur_email = $row[5];
    $cur_contact = $row[6];
    $cur_zone = $row[7];
}

if(isset($_POST['username']))
{
    $cust_username = $_POST['username'];
    $cust_password = md5($_POST['password']);
    $cust_fname = $_POST['fname'];
    $cust_lname = $_POST['lname'];
    $cust_email = $_POST['email'];
    $cust_contact = $_POST['contact'];
    $cust_zone = $cur_zone;
    $insert = "INSERT INTO customer (`username`, `password`, `fname`, `lname`, `email`, `contact`, `zone`)
                VALUES ('$cust_username','$cust_password','$cust_fname','$cust_lname','$cust_email',$cust_contact,$cust_zone)";
    if ($conn->query($insert) == TRUE) {
        $msg = "Customer added successfully.";
    } else {
        $msg = "Customer addition unsuccessful.";
        }
}

?>


<body>
<div class="main-title">
    <h1>BESCOM Online Portal</h1>
</div>

<div class="login">

    <div class="login-triangle"></div>

    <h2 class="login-header">Add Customer</h2>

    <form name="RegForm" class="login-container" method="POST" action="add-customer.php" onsubmit="return validateForm()">

        You are allowed to add customers for Zone <?php echo $cur_zone;?> only.
        <strong><?php echo $msg;?></strong>
        <strong><?php echo $emailErr;?></strong>
        <p><input id="fname" name="fname" type="text" placeholder="First Name*" required></p>
        <p><input id="lname" name="lname" type="text" placeholder="Last Name*" required></p>
        <p><input id="email" name="email" type="email" placeholder="Email*" required></p>
        <p><input id="contact" name="contact" type="text" placeholder="Contact (10 digits)*" required></p>
        <p><input id="zone" name="zone" type="text" placeholder="Zone*" value="Zone <?php echo $cur_zone;?>" disabled></p>
        <p><input id="username" name="username" type="text" placeholder="Username (4-10 characters)*" required></p>
        <p><input id="password" name="password" type="password" placeholder="Password (min 6 characters)*" required></p>
        <p><input type="hidden" value="Yes" name="AddCust" >
        <button type="submit" class="btn btn-primary">Add Customer</button></p>
        <a href="index.php">Go Back</a>
    </form>

</div>
</body>
</html>