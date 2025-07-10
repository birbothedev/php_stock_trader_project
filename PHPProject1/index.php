<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Home</title>
</head>
<body>
    <br>
    <form action="users.php" method="get">
        <button type="submit">Go to Users Page</button>
    </form>
    <br>
    <form action="stocks.php" method="get">
        <button type="submit">Go to Stocks Page</button>
    </form>
    <br>
    <form action="transactions.php" method="get">
        <button type="submit">Go to Transactions Page</button>
    </form>
    <br>
    <form action="login.php" method="get">
        <button type="submit">Go to Login Page</button>
    </form>
</body>
</html>
