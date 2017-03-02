<?php include 'header.php';
include 'sidebar.php';

if($_POST['type'] == "viewcomp") //Show initial details
{
    $view_coid = $_POST['coid'];
}

$getlist = "SELECT * FROM complaint WHERE coid=$view_coid";
$result = $conn->query($getlist);
$row = mysqli_fetch_row($result);
$cid = $row[1];
?>

<body>

<div class="main-title">
    <h1>BESCOM Online Portal</h1>
</div>

<div id="main">

    <div id="content">
        <?php
        $getlist = "SELECT * FROM customer WHERE cid=$cid";
        $result = $conn->query($getlist);
        $row = mysqli_fetch_row($result);
        ?>

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

        $getlist = "SELECT * FROM complaint WHERE coid=$view_coid";
        $result = $conn->query($getlist);
        $search_result = $result;

        ?>
        <h2>COMPLAINT DETAILS</h2>
        <div class="cust-list">
            <table>
                <tr>
                    <th style="width:25%">Complaint ID</th>
                    <th style="width:25%">Subject</th>
                    <th style="width:25%">Concern</th>
                    <th style="width:25%">Update</th>
                </tr>
                <?php
                    while($row = mysqli_fetch_row($result))
                    {
                ?>
                <tr>
                    <td><?php echo $row[0]; ?></td>
                    <td><?php echo $row[2]; ?></td>
                    <td><?php echo $row[3]; ?></td>
                    <td>
                        <?php
                        if($row[5] == 1) { ?>
                            Solved
                        <?php } else {?>
                            <form action="complaints.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="coid" value="<?php echo $row[0]; ?>">
                                <input type="hidden" name="type" value="updatecomp">
                                <button type="submit" title="Solve Complaint">Solved
                                </button>
                            </form>
                        <?php } ?>
                    </td>
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