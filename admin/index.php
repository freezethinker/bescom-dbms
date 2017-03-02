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
    $cur_aid = $row[0];
    $cur_username = $row[1];
    $cur_password = $row[2];
    $cur_fname = $row[3];
    $cur_lname = $row[4];
    $cur_email = $row[5];
    $cur_contact = $row[6];
    $cur_zone = $row[7];
}

$search_cond = "";
$get_search = "";

if(isset($_GET['search'])){
    $get_search = $_GET['search'];
}

if(isset($_POST['Del_Type']) && $_POST['Del_Type']=="del") {
    $del_cid = $_POST['cid'];
    $delete = "DELETE from customer WHERE cid=$del_cid";
    $run_delete = $conn->query($delete);
    $delete = "DELETE from bills WHERE cid=$del_cid";
    $run_delete = $conn->query($delete);
    header('Location: index.php');
}


?>

<body>
<div class="main-title">
    <h1>Admin Portal</h1>
</div>

<div id="main">

    <div id="content">
        <?php

        $getlist = "SELECT * FROM customer WHERE zone=$cur_zone";
        $result = $conn->query($getlist);
        $search_result = $result;

        if ($get_search != "")
        {   $search_getlist = "SELECT * FROM customer WHERE zone=$cur_zone && contact= ".$get_search." ";
            $search_result = $conn->query($search_getlist);
        }
        ?>

        <div class="cust-list">
            <table>
                <tr>
                    <th style="width:10%">Cust ID</th>
                    <th style="width:25%">Name</th>
                    <th style="width:25%">Email</th>
                    <th style="width:20%">Contact</th>
                    <th>Operations</th>
                </tr>

                <?php
                while ($row = mysqli_fetch_row($search_result)) {
                    ?>
                    <tr>
                        <td><?php echo $row[0]; ?></td>
                        <td><?php echo $row[3]; echo " "; echo $row[4]; ?></td>
                        <td><?php echo $row[5]; ?></td>
                        <td><?php echo $row[6]; ?></td>
                        <td>
                            <form action="edit-customer.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="cid" value="<?php echo $row[0]; ?>">
                                <input type="hidden" name="type" value="edit">
                                <button type="submit" title="Edit Details">
                                    <i class="fa fa-pencil"></i>
                                </button>
                            </form>

                            <form action="view-customer.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="cid" value="<?php echo $row[0]; ?>">
                                <input type="hidden" name="type" value="view">
                                <button type="submit" title="View Details">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </form>

                            <form action="index.php" method="POST"">
                            <input type="hidden" name="cid" value="<?php echo $row[0]; ?>">
                            <input type="hidden" name="Del_Type" value="del">
                            <button type="submit" title="Delete">
                                <i class="fa fa-trash"></i>
                            </button>
                            </form>

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

                <button onclick="window.location.href='add-customer.php'">
                    <span class="fa fa-plus"></span> Add Customer</button><br/><br/>

                <button onclick="window.location.href='add-bill.php'">
                    <span class="fa fa-sticky-note"></span> Add Bill</button><br/><br/>


            </div>


        </div>

    </div>

</body>
</html>