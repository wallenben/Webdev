<?php
/*
Ben Wallen
CS 248-003, Ian Edhlund
PHP Page for generating information on the movies listed on the index page.
Now uses SQL to parse database information!
*/
$movie_name = $_GET["film"];

$servername = "sql9.freemysqlhosting.net";
$database = "sql9261490";
$username = "sql9261490";
$password = "XVE35hbJ2t";




$conn = mysqli_connect($servername,$username,$password,$database);
if (!$conn){
    //die command = exit
    die ("Connection failed: " . mysqli_connect_error());
}
//echo "Connection successful";
//no spaces between params
$sql="SELECT id,title,rel,director,producer,rating,img,synopsis FROM movie WHERE film='$movie_name'";
$result=mysqli_query($conn, $sql);
//stores data
$row=mysqli_fetch_assoc($result);
$movieid=$row["id"];
$title=$row["title"];
$releasedate=$row["rel"];
$director=$row["director"];
$producer=$row["producer"];
$rating=$row["rating"];
$image=$row["img"];
$synopsis=$row["synopsis"];

$year=explode("-", $releasedate) [0];
$actors=array();
//pull actor info
$sql="SELECT name FROM actor a JOIN casting c on a.ID=c.actorid WHERE c.movieid='$movieid'";
$results=mysqli_query($conn, $sql);
//loop and push data into the array
while($row=mysqli_fetch_assoc($results)){
    array_push($actors,$row["name"]);
}
//same technique but for reviews
$reviews=array();
$sql="SELECT rating,critic,publication,review FROM reviews WHERE movieid='$movieid'";
$results=mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($results)){
    array_push($reviews,$row);
}
//important: function for closing mysqli connections
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $title ?> - Rancid Tomatoes</title>
    <link href="movie.css" type="text/css" rel="stylesheet" />
</head>

<body background="background.png">
<span><img src="banner.png" alt="Rancid Tomatoes" /></span>
<table>
    <tr>
        <td colspan=3 class="heading"><?= $title ?> (<?= $year ?>)</td>
    </tr>
    <tr>
        <td><img src="<?=$image ?>" alt="general overview" /></td>
        <td colspan=2>

            <dl>
                <dt>Starring</dt>
                <?php
                foreach ($actors as $actor){
                    ?>
                    <dd><?=$actor?></dd>
                    <?php
                }
                ?>
                <dt>Director</dt>
                <dd><?=$director?></dd>
                <dt>Producer</dt>
                <dd><?=$producer?></dd>
                <dt>Rating</dt>
                <dd><?=$rating?></dd>
                <dt>Release Date</dt>
                <dd><?=$releasedate?></dd>
                <dt>Synopsis</dt>
                <dd><?=$synopsis?></dd>
            </dl>

        </td>
    </tr>
    <tr>
        <td colspan=3 class="heading">Reviews</td>
    </tr>

    <?php
    //similar concept as above, but for reviews
    foreach ($reviews as $review) {

        $tomatoimage = strtolower(trim($review["rating"]));
        ?>


        <tr class="review">
            <th>
                <?= $review["critic"] ?><br>
                <?= $review["publication"]?>
            </th>
            <td>
                <img src="<?=$tomatoimage ?>.gif" alt="<?=$tomatoimage ?>" />
            </td>
            <td>
                <?= $review["review"] ?>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
</body>

</html>