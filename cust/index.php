<?php include 'header.php';

if(!isset($_SESSION['cid']) || empty($_SESSION['cid']))
{
    header('Location: login.php');
}

else
{
    $check = "SELECT * FROM customer WHERE cid = '".$_SESSION['cid']."'";
    $result = $conn->query($check);
    $row = mysqli_fetch_row($result);
    $cur_cid = $row[0];
    $cur_username = $row[1];
    $cur_password = $row[2];
    $cur_fname = $row[3];
    $cur_lname = $row[4];
    $cur_email = $row[5];
    $cur_contact = $row[6];
    $cur_zone = $row[7];
}

?>

<body>
<div class="main-title">
    <h1>Customer Portal</h1>
</div>

<div id="main">

    <div id="content">
        <?php
        echo "Hi " . $cur_fname . ", your billing status:</br>";

        $list = "SELECT * FROM bills WHERE cid=$cur_cid";
        $result = $conn->query($list);
        $row = mysqli_fetch_row($result);
        if ($row == "")
        {   echo "<br>Congratulations, you have 0 unpaid bills!";
        }

        else
        {
        ?>

        <h2>BILL DETAILS</h2>
        <div class="cust-list">
            <table>
                <tr>
                    <th style="width:10%">Bill ID</th>
                    <th style="width:15%">Amount</th>
                    <th style="width:20%">Generation Date</th>
                    <th style="width:20%">Due Date</th>
                    <th style="width:20%">Paid On</th>
                    <th>Status</th>

                </tr>
                <?php
                while($row)
                {
                    ?>
                    <tr>
                        <td><?php echo $row[0]; ?></td>
                        <td><?php echo $row[2]; ?></td>
                        <td><?php echo date('d - M - Y',strtotime("$row[3]")); ?></td>
                        <td><?php echo date('d - M - Y',strtotime("$row[4]")); ?></td>
                        <td><?php
                            if($row[5] == "")
                                echo "Not Paid";
                            else
                                echo date('d - M - Y',strtotime("$row[5]")); ?></td>
                        <?php if($row[6] == 0) {?>
                            <td bgcolor="#FF2255">
                                <form action="pay-bill.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="bid" value="<?php echo $row[0]; ?>">
                                    <input type="hidden" name="paybill" value="Yes">
                                    <button type="submit" title="Pay Bill">
                                        <i class="fa fa-credit-card"></i>
                                    </button>
                                </form>
                                Pay Now
                            </td>
                        <?php }else {?>
                            <td>Paid</td>
                        <?php } ?>
                    </tr>

                    <?php
                    $row = mysqli_fetch_row($result);
                }
                }
                ?>

            </table>
        </div>

        <div id="sidebar-right">
            <a href="index.php"><h2>HOME</h2></a>
            <a href="logout.php"><h2>LOGOUT</h2></a><br>
            <form method="POST" action="add-complaint.php">
                <input type="hidden" name="cid" value="<?php echo $cur_cid; ?>">
                <input type="hidden" name="complain" value="Yes">
                <div class="side-btn">
                <button type="submit" title="Add Complaint">
                    <span class="fa fa-plus"></span> Add Complaint
                </button>
                    </div>
            </form>

        </div>

    </div>

</body>
</html>