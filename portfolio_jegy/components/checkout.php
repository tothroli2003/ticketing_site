<?php
    require "config.php";
    require "functions.php";
    GetACart();
    if(count($_SESSION["cart"])==0){
        header("Location: cart.php");
    }

    if(isset($_POST["checkout"])){
        $email=$_POST["email"];
        $kod=MakeCode();
        $kell=$conn->query("SELECT * FROM bill WHERE id = '$kod'");
        while(mysqli_num_rows($kell)!=0){
            $kod=MakeCode();
            $kell=$conn->query("SELECT * FROM bill WHERE id = '$kod'");
        }
       
        $lista="";
        
        for($i=0; $i<count($_SESSION["cart"]);$i++){
            $ticketid=$_SESSION["cart"][$i]["ticketid"];
            $mennyiseg=$_SESSION["cart"][$i]["quantity"];
            $jegy=$conn->query("SELECT * FROM tickets WHERE id = $ticketid")->fetch_assoc();
            
            $rendezveny=$conn->query("SELECT * FROM events WHERE id = $jegy[eventid]")->fetch_assoc();
            $conn->query("UPDATE tickets SET quantity= quantity-$mennyiseg WHERE id = $ticketid");
            
            $lista.="#$ticketid - $rendezveny[nev] - $jegy[type] -$mennyiseg";
            
        }
        $fizetendo=(int)$_SESSION["fizetendo"];
        $conn->query("INSERT INTO bill VALUES('$kod', '$_POST[email]','$lista',$fizetendo)");
        Message("Köszi a vásárlást! A rendelésed kódja: ". $kod);
        NewCart();
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/checkout.css">
    <title><?=(int)$_SESSION["fizetendo"]?></title>
</head>
<body>
    <header>
        <?php MakeNav(false);?>
    </header>
    <main>
        
        <form action="checkout.php" method="post">
            <h1>Rendelésed véglegesítése</h1>
            <input type="email" required autocomplete="off" name="email" id="email">
            <label for="email"> Add meg a rendeléshez használni kívánt email-címet!</label>
            <p>A rendelésedhez a rendszer egy <strong id ="highlight">11 számból álló egyedi kódot</strong> is generál, amely segít annak követésében!</p>

            <input type="submit" value="Jegyek megrendelése" name="checkout">
        </form>
    </main>
    <footer>
        <?php MakeFooter()?>
    </footer>
</body>
</html>