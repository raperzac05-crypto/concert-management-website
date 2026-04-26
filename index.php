<html>
<head>
    <title>Concert Ticket Sales System</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<!--submenu-->
<div class="top-menu">
    <div class="menu-item">
        <button class="menu-button">☰</button>
        <div class="submenu">
            <a href="add_artist.php">Add Artist</a>
            <a href="add_concert.php">Add Concert</a>
            <a href="add_customer.php">Add Customer</a>
            <a href="add_ticket.php">Add Ticket</a>
            <a href="view_all_concerts.php">View All Concerts By City</a>
            <a href="view_by_artists.php">View Concerts by Artist</a>
            <a href="view_total_spending.php">View Total Spending per Customer</a>
            <a href="top_3_artists.php">View Top 3 Artists With Highest</a>
            <a href="select_concerts.php">Search Concerts</a>
        </div>
    </div>
</div>

<!--main header and Data management functions-->
<div class="page-wrap">
    <h1 class="main-title">Concert Ticket Sales System</h1>

    <h2 class="section-heading">Manage Data</h2>
    <div class="card-grid">
        <a href="add_artist.php" class="image-card">
            <img src="images/artist.webp" alt="Add Artist">
            <div class="card-overlay"></div>
            <div class="card-content">
                <h3>Add Artist</h3>
                <p>Create a new artist record</p>
            </div>
        </a>

        <a href="add_concert.php" class="image-card">
            <img src="images/concert.jpg" alt="Add Concert">
            <div class="card-overlay"></div>
            <div class="card-content">
                <h3>Add Concert</h3>
                <p>Create a new concert record</p>
            </div>
        </a>

        <a href="add_customer.php" class="image-card">
            <img src="images/customer.jpg" alt="Add Customer">
            <div class="card-overlay"></div>
            <div class="card-content">
                <h3>Add Customer</h3>
                <p>Create a new customer record</p>
            </div>
        </a>

        <a href="add_ticket.php" class="image-card">
            <img src="images/ticket.jpg" alt="Add Ticket">
            <div class="card-overlay"></div>
            <div class="card-content">
                <h3>Add Ticket</h3>
                <p>Create a new ticket record</p>
            </div>
        </a>
    </div>
<!--view functions-->
    <h2 class="section-heading">Explore & Reports</h2>
    <div class="card-grid">
        <a href="view_all_concerts.php" class="image-card">
            <img src="images/city.jpg" alt="View All Concerts By City">
            <div class="card-overlay"></div>
            <div class="card-content">
                <h3>View All Concerts By City</h3>
                <p>See all concerts grouped by city</p>
            </div>
        </a>

        <a href="view_by_artists.php" class="image-card">
            <img src="images/tarvis.jpg" alt="View Concerts by Artist">
            <div class="card-overlay"></div>
            <div class="card-content">
                <h3>View Concerts by Artist</h3>
                <p>See all concerts grouped by artist</p>
            </div>
        </a>

        <a href="view_total_spending.php" class="image-card">
            <img src="images/money.webp" alt="View Total Spending per Customer">
            <div class="card-overlay"></div>
            <div class="card-content">
                <h3>View Total Spending per Customer</h3>
                <p>See total spending for each customer</p>
            </div>
        </a>

        <a href="top_3_artists.php" class="image-card">
            <img src="images/uzi.jpg" alt="View Top 3 Artists With Highest Revenue">
            <div class="card-overlay"></div>
            <div class="card-content">
                <h3>Top 3 Artists by Revenue</h3>
                <p>See the top 3 artists with the highest revenue</p>
            </div>
        </a>
    </div>
<!--bonus function-->
    <div style="display:flex; justify-content:center; margin-top:20px;">
        <a href="select_concerts.php" class="image-card" style="width:48%";>
            <img src="images/ye.jpg" alt="Search Concerts">
            <div class="card-overlay"></div>
            <div class="card-content">
                <h3>Search Concerts</h3>
                <p>Search for concerts by city and date range</p>
            </div>
        </a>
    </div>
</div>

</body>
</html>