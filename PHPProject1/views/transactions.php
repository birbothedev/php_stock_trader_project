<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <table>
            <tr>
                <th>User ID</th>
                <th>Symbol</th>
                <th>Quantity</th>
                <th>Purchase Price</th>
                <th>ID</th>
            </tr>
            <?php foreach($transactions as $transaction) : ?>
            <tr>
                <td><?php echo $transaction->get_user_id();?></td>
                <td><?php echo $transaction->get_symbol();?></td>
                <td><?php echo $transaction->get_quantity();?></td>
                <td><?php echo $transaction->get_price();?></td>
                <td><?php echo $transaction->get_id();?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        </br>
        <h2>ADD TRANSACTION</h2>
        <form action="transactions.php" method="post">
            <label>User ID:</label>
            <input type="text" name="user_id"/><br>
            <label>Symbol:</label>
            <input type="text" name="symbol"/><br>
            <label>Quantity:</label>
            <input type="text" name="quantity"/><br>
            <input type="hidden" name="action" value="insert"/>
            <label>&nbsp;</label>
            <input type="submit" value="Add Transaction"/><br>
        </form>
        </br>
        <h2>UPDATE TRANSACTION</h2>
        <form action="transactions.php" method="post">
            <label>User ID:</label>
            <input type="text" name="user_id"/><br>
            <label>Symbol:</label>
            <input type="text" name="symbol"/><br>
            <label>Quantity:</label>
            <input type="text" name="quantity"/><br>
            <input type="hidden" name="action" value="update"/>
            <label>&nbsp;</label>
            <input type="submit" value="Update Transaction"/><br>
        </form>
        </br>
        <h2>DELETE TRANSACTION</h2>
        <form action="transactions.php" method="post">
            <label>User ID:</label>
            <input type="text" name="user_id"/><br>
            <label>Symbol:</label>
            <input type="text" name="symbol"/><br>
            <label>Quantity:</label>
            <input type="text" name="quantity"/><br>
            <input type="hidden" name="action" value="delete"/>
            <label>&nbsp;</label>
            <input type="submit" value="Delete Transaction"/><br>
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
