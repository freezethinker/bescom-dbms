<?php include 'header.php';
include 'sidebar.php';

if(!isset($_SESSION['aid']) || empty($_SESSION['aid']))
{
    header('Location: login.php');
}

else
{
    $check = "SELECT * FROM admin WHERE aid = '".$_SESSION['aid']."'";
    $result = $conn->query($check);
    $row = mysqli_fetch_row($result);
    $cur_zone = $row[7];
}

if(isset($_POST['type']) &&  $_POST['type'] == "updatecomp")
{
    $update_coid = $_POST['coid'];
    $new_status = 1;
    $update = "UPDATE complaint SET status=$new_status WHERE coid=$update_coid";
    $run_update = $conn->query($update);
}



?>

<body>
<div class="main-title">
    <h1>Admin Portal</h1>
</div>

<div id="main">
    <div id="content">
        <h2>COMPLAINTS</h2>
        <?php

        $getlist = "SELECT * FROM complaint WHERE zone=$cur_zone";
        $result = $conn->query($getlist);
        $search_result = $result;

        ?>

        <div class="cust-list">
        <table>
            <tr>
                <th style="width:25%">Complaint ID</th>
                <th style="width:25%">Customer ID</th>
                <th style="width:25%">Subject</th>
                <th style="width:25%">Status</th>
            </tr>

        <?php
        while ($row = mysqli_fetch_row($search_result)) {
            ?>
            <tr>
                <td><?php echo $row[0]; ?></td>
                <td><?php echo $row[1]; ?></td>
                <td><?php echo $row[2]; ?></td>
                <td>
                    <?php
                    if($row[5] == 1) { ?>
                        Solved
                    <?php } else {?>
                    Not Solved
                        <form action="view-complaint.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="coid" value="<?php echo $row[0]; ?>">
                            <input type="hidden" name="type" value="viewcomp">
                            <button type="submit" title="Solve Complaint">Solve
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


    <div id="sidebar-right">
    <a href="index.php"><h2>HOME</h2></a>
        <a href="complaints.php"><h2>COMPLAINTS</h2></a>
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
            
        <button onclick="window.location.href='add-customer.php'" cursor="help">
            <span class="fa fa-plus"></span> Add Customer</button><br/><br/>

        <button onclick="window.location.href='add-bill.php'">
            <span class="fa fa-sticky-note"></span> Add Bill</button><br/><br/>

        
        </div>


    </div>

</div>

</body>
</html>