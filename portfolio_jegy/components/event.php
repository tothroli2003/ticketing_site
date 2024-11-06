<?php
   require "config.php";
   require "functions.php"; 
   GetACart();
   $talalt_event=$conn->query("SELECT * FROM events WHERE id = $_GET[eventid]")->fetch_assoc();
   
   if(isset($_POST["btn"]))
   {
        $listed=false;
        for($i=0;$i<count($_SESSION["cart"]);$i++){
            $ticketid=$_SESSION["cart"][$i]["ticketid"];
            $quantity=$_SESSION["cart"][$i]["quantity"];
            $keresett=$conn->query("SELECT * FROM tickets WHERE id=$ticketid")->fetch_assoc();
            if($ticketid==$_GET["ticketid"]){
                if($quantity<$keresett["quantity"]){
                    $ticketid+=$_POST["darab"];
                    $listed=true;
                }
                else{
                    Message("Nem áll rendelkezésre ebből a jegyből ennyi!");
                }
            }
            
            
        }
        $talalt_jegy=$conn->query("SELECT * FROM  tickets WHERE id=$_GET[ticketid]")->fetch_assoc();
        if(!$listed){
            if($talalt_jegy["quantity"] >=  $_POST["darab"]){
                array_push($_SESSION["cart"], array("ticketid" => $_GET["ticketid"], "quantity" => $_POST["darab"]));
            }
            else{
                Message("Nem áll rendelkezésre ebből a jegyből ennyi!");
            }
        }
   }  
   
   //print_r($_SESSION["cart"]);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/nav.css?v=<?php echo time();?>">
        <link rel="stylesheet" href="../css/event.css?v=<?php echo time();?>">
        
        <title><?=$talalt_event["nev"]?></title>
    </head>
    <body>
        <header><?php MakeNav(false)?></header>
        <main>

                <h1>Információk</h1>
                <div class="kep" style="background: url('../files/<?=$talalt_event["img"]?>')"></div>
                
                <p><?=$talalt_event["leiras"]?><p>
                <?php
                    $lekerdezes=$conn->query("SELECT * FROM tickets WHERE eventid=$_GET[eventid] AND quantity>0");
                    if(mysqli_num_rows($lekerdezes)==0){
                        echo "<h1>Nem áll rendelkezésre jegy!<h1>";
                    }
                    else{
                ?>
                <h1>Jegyek</h1>
                
                <?php
                
                while($talalat=$lekerdezes->fetch_assoc()){?>
                    
                    <form action="event.php?eventid=<?=$_GET["eventid"];?>&ticketid=<?=$talalat["id"]?>" class="ticket" method="post">
                        <div class="type"><?=$talalat["type"];?></div>    
                        <div class="ar"><?=$talalat["ar"];?> Ft</div>
                        <div class="db"><?=$talalat["quantity"];?> DB</div>
                        <?php if($talalat["quantity"]<=0) { ?>
                            <h2 class="soldout">Elfogyott!</h2>
                        <?php } else { ?>
                            <input type="number" name="darab" placeholder="0" min="0" id="darab" style="width: 100%;"max="<?=$talalat["quantity"]?>"><label for="" id="l">DB</label>
                            <input type="submit" value="Kosárba!" name="btn" class="cartbtn" style="">
                            <?php } ?>
                        
                    
                    </form>
                <?php
            } } ?>
                
            
            
        </main>
        <footer><?php MakeFooter()?></footer>
        
    </body>
</html>
