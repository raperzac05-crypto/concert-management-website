<html>
    <head>
        <title>Add Customer</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
<body>

<hr>
<a class="home-link" href="index.php">Back to Home</a>

<h3>Enter information about the customer you would like to add to the database:</h3>

<form method="post">
    Customer ID: <input type="text" name="CustomerId"><br>
    Customer Name: <input type="text" name="CustomerName"><br>
    <input type="submit" name="submit" value="Add Customer">
</form>

<?php
include("php_db.php");

if (isset($_POST['submit']))
{
    //get the customer's information from the form
    $customer_id = $_POST['CustomerId'];
    $customer_name = $_POST['CustomerName'];

    //create a new instance of the database class and insert the new customer into the database
    $myDb = new php_db('MYUSERNAME', 'MYPASSWORD', 'MYDB');

    if(empty($customer_id) || empty($customer_name))
    {
        echo"<p style='color:red;'>Error: All fields are required. Please fill in all fields.</p>";
    }
    if(!is_numeric($customer_id))
    {
        echo "<p style='color:red;'>Error: Customer ID must be a number. Please enter a valid Customer ID.</p>";
    }

     $check = $myDb->query("SELECT * FROM Customer WHERE CustomerId = $customer_id");
     if(count($check) > 0)
     {
         echo "<p style='color:red;'>Error: Customer ID $customer_id already exists. Please enter a unique Customer ID.</p>";
     }

    //insert the new customer into the database
    $sql = "INSERT INTO Customer (CustomerId, CustomerName)
            VALUES ($customer_id, '$customer_name')";
    $myDb->execute($sql);

    echo "<p>Customer added successfully!</p>";
}
?>

</body>
</html>