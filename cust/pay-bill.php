<?php include 'header.php';

if(isset($_POST['paybill']) && $_POST['paybill']=="Yes")
{
    $bid = $_POST['bid'];
    $check = "SELECT * FROM bills WHERE bid = $bid";
    $result = $conn->query($check);
    $row = mysqli_fetch_row($result);
    $cur_bid = $row[0];
    $cur_cid = $row[1];
    $cur_amount = $row[2];
    $cur_gendate = $row[3];
    $cur_duedate = $row[4];
    $cur_paydate = $row[5];
    $cur_status = $row[6];
}

if(isset($_POST['Paid']) && $_POST['Paid']=="Yes")
{
    $new_paydate = DATE("Y-m-d");
    $new_status = 1;
    $cur_bid = $_POST['Bid'];

    $update = "UPDATE bills SET paydate='$new_paydate', status=$new_status WHERE bid=$cur_bid";
    $run_update = $conn->query($update);
    header('Location: index.php');
}

?>

<body>
<div class="main-title">
    <h1>Customer Portal</h1>
</div>

<div id="main">

    <div id="content">

        <h2>BILL DETAILS</h2>
        <div class="cust-list">
            <table>
                <tr>
                    <th style="width:30%">Bill ID</th>
                    <th style="width:30%">Amount</th>
                    <th style="width:30%">Generation Date</th>
                    <th style="width:10%">Status</th>
                </tr>

                <tr>
                        <td><?php echo $cur_bid; ?></td>
                        <td><?php echo $cur_amount; ?></td>
                        <td><?php echo date('d - M - Y',strtotime("$cur_gendate")); ?></td>
                        <td><?php
                        if($cur_status == 0)
                            echo "Not Paid";
                        else
                            echo "Paid"; ?></td>
                </tr>

            </table>
        </div>
        <div class="login">
        <form class="login-container" method="POST" action="pay-bill.php">

            <p><input type="hidden" value="Yes" name="Paid" >
                <input type="hidden" value="<?php echo $cur_bid; ?>" name="Bid" >
                <button type="submit" class="btn btn-primary">Pay Bill</button></p>
            <a href="index.php">Go Back</a>
        </form>
        </div>

    <div id="sidebar-right">
    <a href="index.php"><h2>HOME</h2></a>
        <a href="logout.php"><h2>LOGOUT</h2></a>
        <div class="side-btn">
            <button type="submit" title="Add Complaint">
                <span class="fa fa-plus"></span> Add Complaint
            </button>

    </div>

</div>

</body>
</html>