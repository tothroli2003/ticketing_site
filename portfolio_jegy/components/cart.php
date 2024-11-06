<?php
    require "config.php";
    require "functions.php";
    GetACart();
    if(isset($_POST["clear-cart"])){
        NewCart();
    }
    if(isset($_POST["checkout"])){
        
        header("Location: checkout.php");
    }
    $user=$conn->query("SELECT * FROM users WHERE id=$_COOKIE[userid]")->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/cart.css">
    <title><?=$user["username"]?> kosara</title>
</head>
<body>
    <?php MakeNav(false)?>
    <main>
        
        <?php
            if(count($_SESSION["cart"])>0){
                echo'<h1>Kosárba tett jegyeid</h1>';
                $fizetendo=0;
                for($i=0; $i<count($_SESSION["cart"]); $i++) {
                    $ticketid=$_SESSION["cart"][$i]["ticketid"];
                    $quantity=$_SESSION["cart"][$i]["quantity"];
                    $talalt_jegy=$conn->query("SELECT * FROM tickets WHERE id=$ticketid")->fetch_assoc(); 
                    $fizetendo+=$talalt_jegy["ar"]*$quantity;
                    $talalt_event=$conn->query("SELECT * FROM events WHERE id = $talalt_jegy[eventid]")->fetch_assoc();?>
                    <div class="ticket">
                        <div class="type"><?=$talalt_event["nev"]?> - <span class="jegynev"> <?=$talalt_jegy["type"];?></span></div>
                        <div class="ar"><?=$talalt_jegy["ar"];?>Ft</div>
                        <div class="db"><?=$quantity?>db</div>
                        <div class="osszeg"><?=$quantity*$talalt_jegy["ar"];?>Ft</div>
                    </div>
                    
                <?php
                    $_SESSION["fizetendo"] = $fizetendo;
            } ?>

                <form action="cart.php" method="post" id="cart-btns">
                    <input type="submit" value="Kosár kiürítése" name="clear-cart">
                    <input type="submit" value="Véglegesítés (<?=$fizetendo?>Ft)" name="checkout">
                </form>
            <?php } else { ?>
                <h1>
                    Egyenlőre üres a kosarad!
                </h1>
            <?php } ?>
        

    </main>
    <?php MakeFooter()?>

</body>
</html>
<?php MakeMark("cart")?>