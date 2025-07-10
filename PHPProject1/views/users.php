<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <table>
            <tr>
                <th>Name</th>
                <th>Email Address</th>
                <th>Cash Balance</th>
                <th>ID</th>
            </tr>
            <?php foreach($users as $user) : ?>
            <tr>
                <td><?php echo $user->get_name();?></td>
                <td><?php echo $user->get_email_address();?></td>
                <td><?php echo $user->get_cash_balance();?></td>
                <td><?php echo $user->get_id();?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        </br>
        <h2>ADD USER</h2>
        <form action="users.php" method="post">
            <label>Name:</label>
            <input type="text" name="name"/><br>
            <label>Email Address:</label>
            <input type="text" name="email_address"/><br>
            <label>Cash Balance:</label>
            <input type="text" name="cash_balance"/><br>
            <input type="hidden" name="action" value="insert"/>
            <label>&nbsp;</label>
            <input type="submit" value="Add User"/><br>
        </form>
        </br>
        <h2>UPDATE USER</h2>
        <form action="users.php" method="post">
            <label>Name:</label>
            <input type="text" name="name"/><br>
            <label>Email Address:</label>
            <input type="text" name="email_address"/><br>
            <label>Cash Balance:</label>
            <input type="text" name="cash_balance"/><br>
            <input type="hidden" name="action" value="update"/>
            <label>&nbsp;</label>
            <input type="submit" value="Update User"/><br>
        </form>
        </br>
        <h2>DELETE USER</h2>
        <form action="users.php" method="post">
            <label>Name:</label>
            <input type="text" name="name"/><br>
            <label>Email Address:</label>
            <input type="text" name="email_address"/><br>
            <input type="hidden" name="action" value="delete"/>
            <label>&nbsp;</label>
            <input type="submit" value="Delete User"/><br>
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
