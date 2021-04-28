<!DOCTYPE html>
<html lang= "en">
    <head>
        <title>Order Summary</title>
        <link rel="stylesheet" href="techstyle.css">
    </head>

    <body>

    <?php
    /*
    Ben Wallen
    CS 248-003, Ian Edhlund
    PHP form for ordering a variety of items, mostly tech-related.
    */
    //run the PHP code only if post data is recieved properly
    if($_POST["items"] && $_POST["firstname"] && $_POST["lastname"] && $_POST["street"] && $_POST["city"] && $_POST["state"] && $_POST["zip"] )
    {
        //declaring variables based on post data
        $items=$_POST["items"];
        $firstname=$_POST["firstname"];
        $lastname=$_POST["lastname"];
        $street=$_POST["street"];
        $city=$_POST["city"];
        $state=$_POST["state"];
        $zip=$_POST["zip"];
        $total=0;
        $shipping=0;
        ?>
        <h1>Order Summary</h1>
        <p>Thank you <?= $firstname ?> for your order to:</p>
        <p><?= $street ?></p>
        <p><?= $city ?>, <?= $state ?> <?= $zip ?></p>
        <p> You ordered the following: </p>
        <table class="x">
            <tr>
                <th>Item</th>
                <th>Price ($USD)</th>
    </tr>
        <?php
        //pulling the price of items using a foreach loop
        foreach($items as $item=>$price)
        {
            ?>
        
        <tr>
            <td><?= $item ?></td>
            <td><?= $price ?></td>
        </tr>
        <?php
        $total+=$price;
    }
    if ($total < 500){
        $shipping = 25.00;
    }elseif($total < 1000){
        $shipping = 50.00;
    }else {
        $shipping= 100.00;
    }
    $total += $shipping;
    ?>
    <tr>
        <td>Shipping</td>
        <td><?= $shipping ?></td>
    </tr>
    <tr>
        <td>Total</td>
        <td><?= $total ?></td>
    </tr>
</table>
<?php
//if acquiring the necessary fields fail, run this
    }
    else
    {
        ?>
        <a href="techforsale.html"> Go back and complete the form properly</a>
    <?php
    }
    ?>

    </body>
</html>
