<?php
/*
LMS Lite System - Ben Wallen, 4/27/21
Final project for CS - 248.

Quick note: all download links go to Amazon -- I don't think piracy would be worth credit here
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

//this block is for the thankYou page
$sql = "SELECT bookid, dllink FROM download WHERE bookid='$book_name'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$downloadText = $row["dllink"];
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">


<head>
    <!-- stylesheet-->
    <link rel="stylesheet" href="main.css">
    <title>LMS - Final Project</title>
</head>

<body>
    <?php
    if ($_POST["name"] && $_POST["email"]) {
        //declaring variables based on post data
        //processing user input after error checking; step 5
        $name = $_POST["name"];
        $email = $_POST["email"];
    }
    ?>
    <script src="script.js"></script>
    <div class="topnav">
        <a href="index.html">Index</a>
    </div>

    <div class="content">

        <h2>Library Management System</h2>
        <h3><?= $booktitle ?></h3>
        <img class="imgFull" src="<?= $book_name ?>.jpg" alt="" />
        <div class=text2>
            <p><?= $synopsis ?></p>
            <h4>Genre: </h4>
            <p><?= $genre ?></p>
        </div>
        <div class=text2>
            <h4><?= $name ?>, Thank you for your order.</h4>
            <h3>Sent to email:<br> <?= $email ?></h3>
            <p>Download:<a href="<?= $downloadText ?>" class="link"><?= $downloadText ?></a> </p>
        </div>
    </div>
    <div class="greySpacing"><br></div>
    <div class="footer">
        <p>Ben Wallen - 2021</p>
    </div>
</body>

</html>