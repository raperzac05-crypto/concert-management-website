<html>
    <head>
        <title>Add Ticket</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
<body>

<hr>
<a class="home-link" href="index.php">Back to Home</a>

<h3>Enter the information about the ticket purchase you would like to add to the database:</h3>

<form method="post">
    Ticket ID: <input type="text" name="TicketId"><br>
    Concert ID: <input type="text" name="ConcertId"><br>
    Customer ID: <input type="text" name="CustomerId"><br>
    Seat Number: <input type="text" name="SeatNumber"><br>
    Price: <input type="text" name="Price"><br>
    <input type="submit" name="submit" value="Add Ticket">
</form>

<?php
include("php_db.php");

if (isset($_POST['submit']))
{
    $TicketId = $_POST['TicketId'];
    $ConcertId = $_POST['ConcertId'];
    $CustomerId = $_POST['CustomerId'];
    $SeatNumber = $_POST['SeatNumber'];
    $Price = $_POST['Price'];

    $myDb = new php_db('MYUSERNAME', 'MYPASSWORD', 'MYDB');

    //validation
    if (empty($TicketId) || empty($ConcertId) || empty($CustomerId) || empty($SeatNumber) || empty($Price))
    {
        echo "<p style='color:red;'>Error: All fields are required.</p>";
    }
    else if (!is_numeric($TicketId) || !is_numeric($ConcertId) || !is_numeric($CustomerId) || !is_numeric($Price))
    {
        echo "<p style='color:red;'>Error: IDs and Price must be numeric.</p>";
    }
    else
    {
        //check duplicate TicketId
        $checkTicket = $myDb->query("SELECT * FROM Ticket WHERE TicketId = $TicketId");

        //check foreign keys
        $checkConcert = $myDb->query("SELECT * FROM Concert WHERE ConcertId = $ConcertId");
        $checkCustomer = $myDb->query("SELECT * FROM Customer WHERE CustomerId = $CustomerId");

        //error handling
        if (count($checkTicket) > 0)
        {
            echo "<p style='color:red;'>Error: Ticket ID already exists.</p>";
        }
        else if (count($checkConcert) == 0)
        {
            echo "<p style='color:red;'>Error: Concert ID does not exist.</p>";
        }
        else if (count($checkCustomer) == 0)
        {
            echo "<p style='color:red;'>Error: Customer ID does not exist.</p>";
        }
        else
        {
            $sql = "INSERT INTO Ticket (TicketId, ConcertId, CustomerId, SeatNumber, Price)
                    VALUES ($TicketId, $ConcertId, $CustomerId, '$SeatNumber', $Price)";

            $myDb->execute($sql);

            echo "<p>Ticket added successfully!</p>";
        }
    }
}
?>

</body>
</html>