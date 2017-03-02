<?php include 'header.php';
$enterpass=$_POST['password'];
$check = "SELECT * FROM admin WHERE username = '".$_POST['username']."' AND password='" . md5($enterpass) . "' ";
$result = $conn->query($check);

if (mysqli_num_rows($result) == 1)
{
    echo "Successful login. Redirecting to the home page in 3 seconds.\n";
    $row = mysqli_fetch_row($result);
    $aid_new = $row[0];
    $username_new = $row[1];

    $_SESSION['aid']= $aid_new;
    $_SESSION['username']= $username_new;

    header('Refresh: 3;url=index.php');
}

else

{   echo "Unsuccessful login.";
    header('Refresh: 3;url=login.php');
}
?>


<body>
</body>
</html>