<?php include 'header.php';
include 'sidebar.php';

$msg="";

if($_POST['type'] == "edit") //Show initial details
{
    $edit_cid = $_POST['cid'];
}

else if($_POST['edit'] == "Yes") //Update details in Database once user hits 'Save'
{
    $new_fname = $_POST['fname'];
    $new_lname = $_POST['lname'];
    $new_contact = $_POST['contact'];
    $new_email = $_POST['email'];
    $edit_cid = $_POST['cid'];

    $update = "UPDATE customer SET fname='$new_fname', lname='$new_lname', contact=$new_contact, email='$new_email' WHERE cid=$edit_cid";
    $run_update = $conn->query($update);
    $msg="Update successful.";
}

$getlist = "SELECT * FROM customer WHERE cid=$edit_cid";
$result = $conn->query($getlist);
$row = mysqli_fetch_row($result);
?>

<body>
<div class="main-title">
    <h1>BESCOM Online Portal</h1>
</div>

<div class="login">

    <div class="login-triangle"></div>

    <h2 class="login-header">Edit Customer</h2>


    <form class="login-container" method="POST" action="edit-customer.php">
        <i><?php echo $msg ?></i><br>
        <strong>Customer ID: <?php echo $row[0] ?></strong> </br>
        <strong>Username: <?php echo $row[1] ?></strong> </br></br>
        <!--<strong>Name: <//?php echo $row[3]; echo " "; echo $row[4]; ?></strong> </br></br>-->
        First Name: <input type="text" name="fname" value="<?php echo $row[3]?>">
        Last Name: <input type="text" name="lname" value="<?php echo $row[4]?>">
        Email: <input type="text" name="email" value="<?php echo $row[5]?>">
        Contact: <input type="text" name="contact" value="<?php echo $row[6]?>"></br>
        <input type="hidden" name="edit" value="Yes">
        <input type="hidden" name="type" value="no-edit">
        <input type="hidden" name="cid" value="<?php echo $row[0]; ?>">
        <button>Update Details</button></br>


        <a href="index.php">Go Back</a>
    </form>

</div>



</body>
</html>