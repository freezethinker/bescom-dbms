<?php include 'header.php';
include 'sidebar.php';

if($_POST['type'] == "view") //Show initial details
{
    $view_cid = $_POST['cid'];
}

$getlist = "SELECT * FROM customer WHERE cid=$view_cid";
$result = $conn->query($getlist);
$row = mysqli_fetch_row($result);
?>

<body>

<div class="main-title">
    <h1>BESCOM Online Portal</h1>
</div>

<div id="main">

    <div id="content">

        <div class="cust-list">
            <table>
                <tr>
                    <th style="width:25%">Customer ID</th>
                    <th style="width:25%">Username</th>
                    <th style="width:25%">Name</th>
                    <th style="width:25%">Email</th>
                </tr>
                <tr>
                        <td><?php echo $row[0]; ?></td>
                        <td><?php echo $row[1]; ?></td>
                        <td><?php echo $row[3]; echo " "; echo $row[4]; ?></td>
                        <td><?php echo $row[5]; ?></td>
                </tr>

            </table>
        </div>

        <?php
            $getlist = "SELECT * FROM bills WHERE cid=$view_cid";
            $result = $conn->query($getlist);
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
                    while($row = mysqli_fetch_row($result))
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
                            <td bgcolor="#FF2255">Not Paid</td>
                        <?php }else {?>
                            <td>Paid</td>
                    <?php } ?>
                </tr>

                <?php
                    }
                ?>

            </table>
        </div>

    </div>

        <div id="sidebar-right">
            <a href="index.php"><h2>HOME</h2></a>
            <a href="logout.php"><h2>LOGOUT</h2></a>
            <br/>
            <div class="search">
                <form method="GET" action="index.php" id="searchForm">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search Number" id="term">
                    </div>
                </form>
            </div>
            <br/><br/><br/>
            <br/>

            <div class="side-btn">

                <button onclick="window.location.href='add-customer.php'">
                    <span class="fa fa-plus"></span> Add Customer</button><br/><br/>

                <button onclick="window.location.href='#'">
                    <span class="fa fa-sticky-note"></span> Add Bill</button><br/><br/>

                

            </div>


        </div>



</div>



</body>
</html>