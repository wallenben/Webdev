<?php
/*
LMS Lite System - Ben Wallen, 4/27/21
Final project for CS - 248.
*/

$book_name = $_GET["id"];

$servername = "sql5.freemysqlhosting.net";
$database = "sql5408777";
$username = "sql5408777";
$password = "av5DtbdJBr";



//error handling
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    //die command = exit
    die("Connection failed: " . mysqli_connect_error());
}
//img database unlikely - 5MB limit
//For this lite LMS project, the variables I really need are the book name, synopsis, genre, and the image. As such, 
$sql = "SELECT id, nameText FROM books WHERE id='$book_name'";
$result = mysqli_query($conn, $sql);
//stores data. unsure if i have to duplicate these statements, seems to work.
$row = mysqli_fetch_assoc($result);
$booktitle = $row["nameText"];
$sql = "SELECT id, synop, genre FROM bookinfo WHERE id='$book_name'";
//this line cannot be removed, points to previous $sql statement (breaks)
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$synopsis = $row["synop"];
$genre = $row["genre"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- stylesheet-->
    <link rel="stylesheet" href="main.css">
    <title>LMS - Final Project</title>
</head>

<body>
    <script src="script.js"></script>
    <div class="topnav">
        <a href="index.html">Index</a>
    </div>

    <div class="content">

        <h2>Library Management System</h2>
        <!--Title, Img SQL variable could go here -->
        <h3><?= $booktitle ?></h3>
        <img class="imgFull" src="<?= $book_name ?>.jpg" alt="" />
        <?php
        //SQL will replace this. legacy code, commented out
        /*                function getInfo()
                {
                    $myfile = fopen("gundam.txt", "r") or die("Unable to parse book summary.");
                    echo fread($myfile, filesize("gundam.txt"));
                    fclose($myfile);
                }*/
        ?>
        <div class=text2>
            <p><?= $synopsis ?></p>
            <h4>Genre: </h4>
            <!--Genre SQL variable could go here -->
            <p><?= $genre ?></p>
        </div>
        <div class=text2>
            <h4>Rent the book:</h4>
            <form class="formFull" name="formFull" action="thankYou.php?id=<?= $book_name ?>" method="post">
                Name: <input type="text" name="name" id="name"><br>
                Email: <input type="text" name="email" id="email"><br>
                <button type="button" onclick="submitRent()">Rent Book </button>
            </form>
        </div>
    </div>
    <div class="greySpacing"><br></div>
    <div class="footer">
        <p>Ben Wallen - 2021</p>
    </div>
</body>

</html>