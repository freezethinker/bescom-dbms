<?php include 'header.php';
?>

<body>
<div class="main-title">
    <h1>BESCOM Online Portal</h1>
</div>

<div class="login">

    <div class="login-triangle"></div>

    <h2 class="login-header">Customer Login</h2>

    <form class="login-container" method="POST" action="validate.php">
        <p><input id="username" name="username" type="text" placeholder="Username*" required></p>
        <p><input id="password" name="password" type="password" placeholder="Password*" required></p>
        <p><input type="submit" value="Log in"></p>
        <a href="../admin/">Admin Login</a>
    </form>

</div>
</body>
</html>