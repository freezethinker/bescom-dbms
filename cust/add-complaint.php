<?php include 'header.php';
$msg="";

if(isset($_POST['complain']) && $_POST['complain']=="Yes")
{
    $cur_cid = $_POST['cid'];
}

if(isset($_POST['Done']) && $_POST['Done']=="Yes")
{
    $cur_cid = $_POST['cid'];
    $check = "SELECT * FROM customer WHERE cid = $cur_cid";
    $result = $conn->query($check);
    $row = mysqli_fetch_row($result);

    $cur_zone = $row[7];
    $cur_sub = $_POST['sub'];
    $cur_body = $_POST['body'];
    $cur_status = 0;

    $insert = "INSERT INTO complaint(`cid`, `subject`, `body`, `zone`, `status`)
               VALUES ($cur_cid,'$cur_sub','$cur_body','$cur_zone','$cur_status')";

    if ($conn->query($insert) == TRUE) {
        $msg = "Complaint added successfully.";
    }
    else {
        $msg = "Complaint addition unsuccessful. ";
    }
}

?>

<body>
<div class="main-title">
    <h1>Customer Portal</h1>
</div>

<div id="main">

    <div id="content">

        <h2>COMPLAINT DETAILS</h2>
        <?php echo $msg; ?>
        <div class="login">
        <form class="login-container" method="POST" action="add-complaint.php">
            <p><input type="text" name="sub" placeholder="Subject*"></p>
            <p><input type="text" name="body" placeholder="Complaint Description*"></p>
            <p><input type="hidden" value="Yes" name="Done" >
                <input type="hidden" value="<?php echo $cur_cid; ?>" name="cid" >
                <button type="submit" class="btn btn-primary">Register Complaint</button>
            </p>
            <a href="index.php">Go Back</a>
        </form>
        </div>

    <div id="sidebar-right">
        <a href="index.php"><h2>HOME</h2></a>
        <a href="logout.php"><h2>LOGOUT</h2></a>
    </div>

</div>

</body>
</html>