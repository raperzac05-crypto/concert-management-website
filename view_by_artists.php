<html>
<head>
    <!-- This page allows users to view all concerts in the database, with an optional filter by artist. --> 
    <title>View Concerts By Artist</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="container">

<a class="home-link" href="index.php">Back to Home</a>

<h3>View Concerts By Artist</h3>

<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include("php_db.php");

$myDb = new php_db('MYUSERNAME', 'MYPASSWORD', 'MYDB');

$artists = $myDb->query("SELECT DISTINCT ArtistName FROM Artist");
?>
<!--dropdown to filter by artist-->
<form method="post">
    Select Artist:
    <select name="ArtistName">
        <option value="">All Artists</option>
        <?php
        foreach($artists as $row)
        {
            echo "<option value='" . $row['ArtistName'] . "'>" . $row['ArtistName'] . "</option>";
        }
        ?>
    </select>
    <input type="submit" name="submit" value="View Concerts">
</form>

<?php
if(isset($_POST['submit']))
{
    $artist = $_POST['ArtistName'];

    //if no artist is selected, display all
    if(empty($artist))
    {
        $sql = "SELECT Artist.ArtistName, Concert.VenueName, Concert.City, Concert.ConcertDate
            FROM Concert
            JOIN Artist ON Concert.ArtistId = Artist.ArtistId";
    }
    else
    {
        $sql = "SELECT Artist.ArtistName, Concert.VenueName, Concert.City, Concert.ConcertDate
            FROM Concert
            JOIN Artist ON Concert.ArtistId = Artist.ArtistId
            WHERE Artist.ArtistName = '$artist'";
    }

    $result = $myDb->query($sql);

    if(count($result) > 0)
    {
        echo "<h4>Results:</h4>";
        $myDb->printTable($result);
    }
    else
    {
        echo "<p>No concerts found for the selected artist.</p>";
    }
}
?>
</div>

</body>
</html>