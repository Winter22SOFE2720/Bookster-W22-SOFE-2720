<?php

$bookID = $_GET['id'];
getBookInformation($bookID);
function getBookInformation($bookID)
{
    global $name, $author, $year, $photo, $description, $hardprice;

    // Connecting to server
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "Bookster";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";

    $result = mysqli_query($conn, "SELECT * FROM Books WHERE ID=$bookID");
    while ($res = mysqli_fetch_array($result)) {
        $name = $res['Name'];
        $author = $res['Author'];
        $year = $res['Year'];
        $photo = $res['img_URL'];
        $description = $res['Description'];
        $hardprice = $res['HardPrice'];
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookster</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="booksterStyleSheet.css">
</head>

<body>
<nav id="mainNavBar">
    <a href="">Home</a>
    <a href="">Account</a>
    <a href="">Rewards</a>
    <a href="">About</a>
    <a href="">Contact Us</a>
    <a href="">
        <div id="cart">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart3"
                 viewBox="0 0 16 16">
                <path
                        d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </svg>
        </div>
    </a>
    <div>
        <input class="searchBar" type="text" placeholder="Search">
    </div>
</nav>
<div class="bookDisplay">
    <div class="mainBookCard">
        <?php print "<img class='mainBookCardImage' src=\"$photo\" alt=\"$name\"/>"; ?>
        <div class="itemDesc">
            <div>
                <p><b>Title:</b> <?php echo $name ?></p><br>
                <p>Year: <?php echo $year ?></p> <br>
                <p>Available for&nbsp;</p>
                <p class="priceTag"><?php echo $hardprice?>$</p>
            </div>

            <p>
            <h2>Synopsis:</h2> <?php echo $description?><br>
            <br>
            <h2>Author:</h2> <?php echo $author ?>
            </p>
            <a href="checkout.php">
                <button class="buyBtn" type="button">Buy Now</button>
            </a>
        </div>
    </div>
</div>
<footer>
    <div class="footerContent">
        <div id="closingTag">
            <h2>Bookster</h2>
        </div>
        <div class="footerHeader">
            <h3>About</h3>
            <a href="">About Us</a>
            <a href="">Contact Us</a>
        </div>
        <div class="footerHeader">
            <h3>Help</h3>
            <a href="">Returns</a>
            <a href="">Service Desk</a>
        </div>
        <div class="footerHeader">
            <h3>Social</h3>
            <a href="">Instagram</a>
            <a href="">Facebook</a>
        </div>
    </div>
</footer>
</body>

</html>
