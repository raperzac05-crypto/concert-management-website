<!-- This page allows users to add a new artist to the database. It includes error handling for empty fields, non-numeric artist ID, and duplicate artist ID. -->

<html>
    <head>
        <title>Add Artist</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
<body>

<hr>
<a class="home-link" href="index.php">Back to Home</a>

<h3>Enter information about the artist you would like to add to the database:</h3>

<form method="post">
    Artist ID: <input type="text" name="ArtistId"><br>
    Artist Name: <input type="text" name="ArtistName"><br>
    Genre: <input type="text" name="Genre"><br>
    <input type="submit" name="submit" value="Add Artist">
</form>

<?php
include("php_db.php");

if (isset($_POST['submit']))
{
    //get the artist's information from the form
    $artist_id = $_POST['ArtistId'];
    $artist_name = $_POST['ArtistName'];
    $genre = $_POST['Genre'];

    //create a new instance of the database class and insert the new artist into the database
    $myDb = new php_db('MYUSERNAME', 'MYPASSWORD', 'MYDB');

    //error handling for empty fields, non-numeric artist ID, and duplicate artist ID
    if(empty($artist_id) || empty($artist_name))
    {
        echo "<p style='color:red;'>Error: All fields are required. Please fill in all fields.</p>";
    }
    else if(!is_numeric($artist_id))
    {
        echo "<p style='color:red;'>Error: Artist ID must be a number. Please enter a valid Artist ID.</p>";
    }

    $check = $myDb->query("SELECT * FROM Artist WHERE ArtistId = $artist_id");
    if(count($check) > 0)
    {
        echo "<p style='color:red;'>Error: Artist ID $artist_id already exists. Please enter a unique Artist ID.</p>";
    } 

    //insert the new artist into the database
    $sql = "INSERT INTO Artist (ArtistId, ArtistName, Genre)
            VALUES ($artist_id, '$artist_name', '$genre')";

    $myDb->execute($sql);

    echo "<p>Artist added successfully!</p>";
}
?>

</body>
</html>