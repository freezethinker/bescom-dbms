<?php include 'header.php';
$msg="";

if(isset($_POST['addbill']) && $_POST['addbill'] == "Yes")
{
    $new_cid = $_POST['cid'];
    $new_amount = $_POST['amount'];
    $new_gendate = DATE("Y-m-d");
    $new_duedate = date('Y-m-d', strtotime("+30 days"));
    $new_status = 0;

    $check = "SELECT * FROM admin WHERE aid = '".$_SESSION['aid']."'";
    $result = $conn->query($check);
    $row = mysqli_fetch_row($result);
    $admin_zone = $row[7];

    $check = "SELECT * FROM customer WHERE cid = $new_cid";
    $result = $conn->query($check);
    $row = mysqli_fetch_row($result);
    $customer_zone = $row[7];

    if ($admin_zone == $customer_zone)
    {   $insert = "INSERT INTO bills (`cid`, `amount`, `gendate`, `duedate`, `status`)
                    VALUES ($new_cid,$new_amount,'$new_gendate','$new_duedate',$new_status)";

        if($conn->query($insert) == TRUE)
            $msg = "Bill added successfully.";
    }
    else
    {
        $msg = "Not a customer of your zone. Bill addition unsuccessful. ";
    }
}

?>

<body>
<div class="main-title">
    <h1>BESCOM Online Portal</h1>
</div>

<div class="login">

    <div class="login-triangle"></div>

    <h2 class="login-header">Create Bill</h2>

    <form class="login-container" method="POST" action="add-bill.php">
        <?php echo $msg ?>
        <p><input id="cid" name="cid" type="text" placeholder="Customer ID*" required></p>
        <p><input id="amount" name="amount" type="text" placeholder="Amount*" required></p>
        <p><input type="hidden" id="addbill" name="addbill" value="Yes"></p>
        <button>Create Bill</button><br>
        <a href="index.php">Go Back</a>
    </form>

</div>
</body>
</html>