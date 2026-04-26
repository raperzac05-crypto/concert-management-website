<html>
<head>
    <title>Search Concerts</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="container">

<a class="home-link" href="index.php">Back to Home</a>

<h3>Search Concerts</h3>

<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include("php_db.php");

$myDb = new php_db('MYUSERNAME', 'MYPASSWORD', 'MYDB');

$artists = $myDb->query("SELECT DISTINCT ArtistName FROM Artist");
$cities = $myDb->query("SELECT DISTINCT City FROM Concert");
?>

<!--dropdown menus-->
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
    <br><br>

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
    <br><br>

    Select Date Range:
    <br>
    Start Date:
    <input type="date" name="StartDate">
    <br><br>
    End Date:
    <input type="date" name="EndDate">
    <br><br>

    <input type="submit" name="submit" value="Search Concerts">
</form>

<?php
if (isset($_POST['submit']))
{
    $artist = $_POST['ArtistName'] ?? '';
    $city = $_POST['City'] ?? '';
    $start = $_POST['StartDate'] ?? '';
    $end = $_POST['EndDate'] ?? '';

    $error = "";

    //check if user selected at least one filter
    if (empty($artist) && empty($city) && empty($start) && empty($end))
    {
        $error = "Error: Please select at least one search filter.";
    }
    //check if both dates are entered and valid
    else if (!empty($start) && !empty($end) && $start > $end)
    {
        $error = "Error: Start date cannot be after end date.";
    }

    if (!empty($error))
    {
        echo "<p style='color:red;'>$error</p>";
    }
    else
    {
        //build date condition
        if (!empty($start) && !empty($end))
        {
            $dateCondition = "Concert.ConcertDate BETWEEN '$start' AND '$end'";
        }
        else if (!empty($start))
        {
            $dateCondition = "Concert.ConcertDate >= '$start'";
        }
        else if (!empty($end))
        {
            $dateCondition = "Concert.ConcertDate <= '$end'";
        }
        else
        {
            $dateCondition = "1";
        }

        $sql = "SELECT Artist.ArtistName, Concert.VenueName, Concert.City, Concert.ConcertDate
                FROM Concert
                JOIN Artist ON Concert.ArtistId = Artist.ArtistId
                WHERE (Artist.ArtistName = '$artist' OR '$artist' = '')
                AND (Concert.City = '$city' OR '$city' = '')
                AND $dateCondition";

        $result = $myDb->query($sql);

        if (count($result) > 0)
        {
            echo "<h4>Results:</h4>";
            $myDb->printTable($result);
        }
        else
        {
            echo "<p>No concerts found matching your search.</p>";
        }
    }
}
?>

</div>
</body>
</html>