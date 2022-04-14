<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
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
        <form action="browsing.php" method="post" id="form">
            <input type="search" id="query" name="search" placeholder="Search...">
            <input type="submit">
        </form>
    </div>
</nav>

<div class="mainContent">
    <h2>Search results</h2>
    <hr class="resultsBreak">
    <!--    <div class="results">-->
        <?php

        global $name, $author, $year, $photo;
        function search($search){
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
            // echo "Connected successfully";

            // Go through all book names

            $result = mysqli_query($conn,"SELECT * FROM Books WHERE Name LIKE '%$search%' UNION SELECT * FROM Books WHERE Description LIKE '%$search%'");
            while ($res = mysqli_fetch_array($result)) {
                $name[] = $res['Name'];
                $author[] = $res['Author'];
                $year[] = $res['Year'];
                $photo[] = $res['img_URL'];
                $id[] = $res['ID'];
            }

            for($i = 0; $i < count($name); $i++){
                // echo $name[$i];
                // print "<a href=\"BookDisplay.php?id='$id[$i]'\"/>$name[$i]</a> <br>";

                $message_start = "<div class='results'>";
                $message_end = "</div><hr class='resultsBreak'>";
                $message_center = "<div class='resultsCard'>
                
                <img class='resultsCardImage' src='$photo[$i]' alt='$name[$i]'>
                <div class='itemDesc'>
                    <p><b>Title:</b> $name[$i]</p>
                    <p><b>Author: $author[$i]</b></p>
                    <a href='BookDisplay.php?id=$id[$i]'><button class='buyBtn' > See More</button></a>
                </div>
                </div>";
                if($i % 3 == 0){
                    $message = $message_start . $message_center;
                } else if($i % 3 == 1){
                    $message = $message_center;
                } else {
                    $message = $message_center . $message_end;
                }
                print $message;
            } }
        if (isset($_POST['search'])){
            $search = $_POST['search'];
            search($search);

          } ?>
<!--    </div>-->
<!--    <hr class="resultsBreak">
    <div class="results">
        <div class="resultsCard">
            <img class="resultsCardImage" src="../../Downloads/Bookster%20(1)/Bookster/images/1080x1920.png" alt="">
            <div class="itemDesc">
                <p><b>Title:</b></p>
                <p><b>Author:</b></p>
                <button class="buyBtn"> See More</button>
            </div>
        </div>
        <div class="resultsCard">
            <img class="resultsCardImage" src="../../Downloads/Bookster%20(1)/Bookster/images/1080x1920.png" alt="">
            <div class="itemDesc">
                <p><b>Title:</b></p>
                <p><b>Author:</b></p>
                <button class="buyBtn"> See More</button>
            </div>
        </div>
        <div class="resultsCard">
            <img class="resultsCardImage" src="../../Downloads/Bookster%20(1)/Bookster/images/1080x1920.png" alt="">
            <div class="itemDesc">
                <p><b>Title:</b></p>
                <p><b>Author:</b></p>
                <button class="buyBtn"> See More</button>
            </div>
        </div>
    </div>
    <hr class="resultsBreak">-->

</div>
</body>
</html>