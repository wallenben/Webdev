<!DOCTYPE html>
<html lang= "en">
    <head>
        <title>Order Summary</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <?php
    if($_POST["items"] && $_POST["firstname"] && $_POST["lastname"] && $_POST["street"] && $_POST["city"] && $_POST["state"] && $_POST["zip"] ){
        ?>
        <p> page contents here</p>
        <?php
    }else{
        ?>
        <a href="index.html"> Go back and complete the form properly</a>
        <?php
    }

    ?>
    </body>
</html>
