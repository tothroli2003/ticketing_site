<?php 
    require "functions.php";
    require "config.php";
    $user=$conn->query("SELECT * FROM users WHERE id=$_GET[userid]")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/style.css">
    <title><?=$user["username"];?></title>
</head>
<body>
    <?php
        MakeNav(false);
    ?>
    <main>
        
        <?php $lekerdezes=$conn->query("SELECT * FROM events WHERE uploaderid=$_GET[userid] AND ido > NOW()  ORDER BY ido");
                    if(mysqli_num_rows($lekerdezes)==0) { 
                    echo"<h1>Még nem hirdettél meg egy rendezvényt sem!</h1>";
             } else { ?> <h1>Általad meghirdetett rendezvények</h1>
                <?php while($talalat=$lekerdezes->fetch_assoc()) { ?>
                <a href="addticket.php?eventid=<?=$talalat["id"]?>"class="event-card" style="background-image: url('../files/<?=$talalat["img"];?>');">
                
                    <div class="event-description"><div class="name"><?=$talalat["nev"];?></div>
                    <?php 
                        $ido=date("Y.m.d H:i",strtotime($talalat["ido"]));
                    ?>
                    <div class="event-date"><?=$ido;?></div></div>
                    
                </a>
           <?php } }?>

        
        
    </main>
    <?php MakeFooter();?>
    
</body>
</html>
<?php MakeMark("profile");?>