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
                <th>Symbol</th>
                <th>Current Price</th>
                <th>ID</th>
            </tr>
            <?php foreach($stocks as $stock) : ?>
            <tr>
                <td><?php echo $stock->get_symbol();?></td>
                <td><?php echo $stock->get_name();?></td>
                <td><?php echo $stock->get_current_price();?></td>
                <td><?php echo $stock->get_id();?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        </br>
        <h2>ADD STOCK</h2>
        <form action="stocks.php" method="post">
            <label>Symbol:</label>
            <input type="text" name="symbol"/><br>
            <label>Name:</label>
            <input type="text" name="name"/><br>
            <label>Current Price:</label>
            <input type="text" name="current_price"/><br>
            <input type="hidden" name="action" value="insert"/>
            <label>&nbsp;</label>
            <input type="submit" value="Add Stock"/><br>
        </form>
        </br>
        <h2>UPDATE STOCK</h2>
        <form action="stocks.php" method="post">
            <label>Symbol:</label>
            <input type="text" name="symbol"/><br>
            <label>Name:</label>
            <input type="text" name="name"/><br>
            <label>Current Price:</label>
            <input type="text" name="current_price"/><br>
            <input type="hidden" name="action" value="update"/>
            <label>&nbsp;</label>
            <input type="submit" value="Update Stock"/><br>
        </form>
        </br>
        <h2>DELETE STOCK</h2>
        <form action="stocks.php" method="post">
            <label>Symbol:</label>
            <input type="text" name="symbol"/><br>
            <input type="hidden" name="action" value="delete"/>
            <label>&nbsp;</label>
            <input type="submit" value="Delete Stock"/><br>
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
