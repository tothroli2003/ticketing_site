<?php
    require "components/functions.php";
    require "components/config.php";
     //ellenőrzés
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/nav.css">
    <title>Document</title>
</head>
<body>
    
    <?php MakeNav(true);?>
    <main>
        <?php
            
            GetACart();
            $ma=time();
            
            $lekerdezes=$conn->query("SELECT * FROM events WHERE ido > NOW() ORDER BY ido");
            while($talalat=$lekerdezes->fetch_assoc()) { ?>
                <a href="components/event.php?eventid=<?=$talalat["id"]?>"class="event-card" style="background-image: url('files/<?=$talalat["img"];?>');">
                
                    <div class="event-description"><div class="name"><?=$talalat["nev"];?></div>
                    <?php 
                        $ido=date("Y.m.d H:i",strtotime($talalat["ido"]));
                    ?>
                    <div class="event-date"><?=$ido;?></div></div>
                    
                </a>
           <?php } ?>

    </main>
    <?php MakeFooter(true);?>
    
</body>
</html>