<?php
    require "config.php";
    require "functions.php";

    if(isset($_POST["btn"])){
        $lekerdezes=$conn->query("SELECT * FROM tickets WHERE eventid=$_GET[eventid] AND type='$_POST[jegynev]'");
        if(mysqli_num_rows($lekerdezes)==0){
            $conn->query("INSERT INTO tickets VALUES(id,$_GET[eventid],'$_POST[jegynev]',$_POST[ar],$_POST[darab])");

        }
        else{
            $conn->query("UPDATE tickets SET quantity = quantity+$_POST[darab] WHERE type='$_POST[jegynev]' ");

        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/addticket.css">
    <title>Document</title>
</head>
<body>
    <header>
        <?php MakeNav(false);?>
    </header>
    <main>
        <form class="ticket"  action="addticket.php?eventid=<?=$_GET["eventid"];?>" method="post">
            <input required autocomplete="off" type="text" name="jegynev" id="type" placeholder="Jegytípus">
            <input required autocomplete="off" type="number" name="ar" id="ar" placeholder="Ár forintban" min="0" step="5">
            <input required autocomplete="off" type="number" name="darab" id="db" placeholder="Darabszám" min="1">
            <input type="submit" name="btn" id="btn" value="+">
        </form>
        <?php
            $lekerdezes=$conn->query("SELECT * FROM tickets WHERE eventid=$_GET[eventid]");
            while($talalat=$lekerdezes->fetch_assoc()){?>
            <div class="ticket">
              <div class="type"><?=$talalat["type"];?></div>
              <div class="ar"><?=$talalat["ar"];?> Ft</div>
              <div class="db"><?=$talalat["quantity"];?> DB</div>
              <div class="void"></div>
            </div>

            
            <?php }

        ?>
        
    </main>
    <footer>
        <?php MakeFooter();?>
    </footer>
</body>
</html>