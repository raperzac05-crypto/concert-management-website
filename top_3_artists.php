<html>
    <head>
<!-- This page allows users to view the top 3 artists based on ticket sales. --> 
        <title>Top 3 Artists With Highest Revenue</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="container">
            <a class="home-link" href="index.php">Back to Home</a>
            <?php
            ini_set('display_errors', 1);
            error_reporting(E_ALL);

            include("php_db.php");

            $myDb = new php_db('MYUSERNAME', 'MYPASSWORD', 'MYDB');

            $artist = $myDb->query('SELECT DISTINCT ArtistName FROM Artist');
            ?>
            <?php
                $sql = "SELECT Artist.ArtistName,
                        SUM(Ticket.Price) AS TotalRevenue
                        FROM Artist
                        JOIN Concert ON Artist.ArtistId = Concert.ArtistId
                        JOIN Ticket ON Concert.ConcertId = Ticket.ConcertId
                        GROUP BY Artist.ArtistId, Artist.ArtistName
                        ORDER BY TotalRevenue DESC
                        LIMIT 3";

                $result = $myDb->query($sql);

                if(count($result) > 0)
                {
                    echo "<h4>Top 3 Artists With Highest Revenue:</h4>";
                    $myDb->printTable($result);
                }
                else
                {
                    echo "<p>No results found.</p>";
                }       
            ?>
        </div>
    </body>
</html>