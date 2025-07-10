<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h2>Login</h2>
        <?php echo $message ?>
        <form action="login.php" method="post">
            <label>Email Address:</label>
            <input type="text" name="email_address"/><br>
            <label>Password:</label>
            <input type="password" name="password"/><br>
            <input type="hidden" name="action" value="login"/>
            <label>&nbsp;</label>
            <input type="submit" value="login"/><br>
        </form>
        </br>
        </br>
        <h2>Sign Up</h2>
        <form action="login.php" method="post">
            <label>Email Address:</label>
            <input type="text" name="email_address"/><br>
            <label>Password:</label>
            <input type="password" name="password"/><br>
            </br>
            <label>Confirm Password:</label>
            <input type="password" name="confirm_password"/><br>
            </br>
            <input type="hidden" name="action" value="sign_up"/>
            <label>&nbsp;</label>
            <input type="submit" value="Sign Up"/><br>
        </form>
        </br>
        <form action="index.php" method="get">
            <button type="submit">Go to Home Page</button>
        </form>
        <form action="login.php" method="get">
            <button type="submit">Logout</button>
        </form>
    </body>
</html>
