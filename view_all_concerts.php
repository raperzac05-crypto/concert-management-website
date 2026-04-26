<html>
<head>
    <!-- This page allows users to view all concerts in the database, with an optional filter by city. --> 
    <title>View Concerts By City</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="container">

<a class="home-link" href="index.php">Back to Home</a>

<h3>View All Concerts By City</h3>

<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

//echo "before include<br>";
include("php_db.php");
//echo"after include<br>";


$myDb = new php_db('MYUSERNAME', 'MYPASSWORD', 'MYDB');
//echo "after db connection<br>";


$cities = $myDb->query("SELECT DISTINCT City FROM Concert");
//echo "after city query<br>";
?>
<!--dropdown to filter by city-->
<form method="post">
    Select City:
    <select name="City">
        <option value="">All Cities</option>
        <?php 
        foreach ($cities as $row)
        {
            echo "<option value='" . $row['City'] . "'>" . $row['City'] . "</option>";
        }
        ?>
    </select>
    <input type="submit" name="submit" value="View Concerts">
</form>

<?php
if(isset($_POST['submit']))
{
    $city = $_POST['City'];

    //if no city is selected, show all concerts
    if(empty($city))
    {
        $sql = "SELECT * FROM Concert";
    }
    else
    {
        //filter by city
        $sql = "SELECT * FROM Concert WHERE City = '$city'";
    }

    $results = $myDb->query($sql);

    //display results in a table
    if(count($results) > 0)
    {
        echo "<h4>Results:</h4>";
        $myDb->printTable($results);
    }
    else
    {
        echo "<p>No concerts found.</p>";
    }
}
?>

</div>

</body>
</html>