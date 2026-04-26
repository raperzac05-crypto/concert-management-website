<html>
    <head>
        <title>Add Concert</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
<body>


<hr>
<a class="home-link" href="index.php">Back to Home</a>

<h3> Enter information about the concert you would like to add to the database:</h3>

<form method="post">
    Concert ID: <input type="text" name="ConcertId"><br>
    Venue Name: <input type="text" name="VenueName"><br>
    City: <input type="text" name="City"><br>
    Concert Date: <input type="date" name="ConcertDate"><br>
    Artist ID: <input type="text" name="ArtistId"><br>
    <input type="submit" name="submit" value="Add Concert">
</form>

<?php
include("php_db.php");

if (isset($_POST['submit']))
{
    //get the concert's information from the form
    $concert_id = $_POST['ConcertId'];
    $venue_name = $_POST['VenueName'];
    $city = $_POST['City'];
    $concert_date = $_POST['ConcertDate'];
    $artist_id = $_POST['ArtistId'];

    //create a new instance of the database class and insert the new concert into the database
    $myDb = new php_db('MYUSERNAME', 'MYPASSWORD', 'MYDB');

    if (empty($concert_id) || empty($venue_name) || empty($city) || empty($concert_date) || empty($artist_id))
    {
        echo "<p style='color:red;'>Error: All fields are required.</p>";
    }

    $check = $myDb->query("SELECT * FROM Artist WHERE ArtistId = $artist_id");

    //checks for valid artist id
    if(count($check) == 0)
    {
        echo "<p style='color:red;'>Error: Artist ID $artist_id does not exist. Please enter a valid Artist ID.</p>";
    }
    
    else 
    {
        try
        {
            $sql = "INSERT INTO Concert (ConcertId, VenueName, City, ConcertDate, ArtistId)
                    VALUES ($concert_id, '$venue_name', '$city', '$concert_date', $artist_id)";
            $myDb->execute($sql);
        }
        catch (Exception $e)
        {
            echo "<p style='color:red;'>Error: " . $e->getMessage() . "</p>";
        }

    echo "<p>Concert added successfully!</p>";
    }
}
?>

</body>
</html>