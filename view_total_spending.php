<html>
    <head>
        <title>Total Spending</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="container">
            <a class="home-link" href="index.php">Back to Home</a>

            <h3>View Total Spending per Customer </h3>
            <?php
            ini_set('display_errors', 1);
            error_reporting(E_ALL);

            include("php_db.php");

            $myDb = new php_db('MYUSERNAME', 'MYPASSWORD', 'MYDB');
        
            $customers = $myDb->query('SELECT DISTINCT CustomerName FROM Customer');
            ?>

            <!--dropdown-->
            <form method="post">
                Select Customer:
                <select name="CustomerName">
                    <option value="">All Customers</option>
                    <?php
                    foreach ($customers as $row) 
                    {
                        echo "<option value='" . $row['CustomerName'] . "'>" . $row['CustomerName'] . "</option>";
                    }
                    ?>
                </select>
                <input type="submit" name="submit" value="View Total Spending">
            </form>
            <?php
            if (isset($_POST['submit']))
            {
                $customer = $_POST['CustomerName'];

                //if no customer is selected, display all
                if(empty($customer))
                {
                    $sql = "SELECT Customer.CustomerId, Customer.CustomerName,
                            IFNULL(SUM(Ticket.Price), 0) AS TotalSpent
                            FROM Customer
                            LEFT JOIN Ticket ON Customer.CustomerId = Ticket.CustomerId
                            GROUP BY Customer.CustomerId, Customer.CustomerName";
                }
                else
                {
                    $sql = "SELECT Customer.CustomerId, Customer.CustomerName,
                            IFNULL(SUM(Ticket.Price), 0) AS TotalSpent
                            FROM Customer
                            LEFT JOIN Ticket ON Customer.CustomerId = Ticket.CustomerId
                            WHERE Customer.CustomerName = '$customer'
                            GROUP BY Customer.CustomerId, Customer.CustomerName";
                }

                $result = $myDb->query($sql);

                if(count($result) > 0)
                {
                    echo "<h4>Results:</h4>";
                    $myDb->printTable($result);
                }
                else
                {
                    echo "<p>No customers found.</p>";
                }
            }
            ?>
        </div>
    </body>
</html>