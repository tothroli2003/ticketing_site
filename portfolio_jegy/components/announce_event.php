<?php
    require "functions.php";
    require "config.php";
    if(isset($_POST["btn"])){
        $fajl_cel = "../files/".$_FILES["event-photo"]["name"];
        if(file_exists($fajl_cel)){
            Message("Ilyen nevű kép már fel lett töltve!");
        } else {
            $nev = $_POST["event-name"];
            $fajlnev = $_FILES["event-photo"]["name"];
            $leiras = $_POST["description"];
            $ido = $_POST["event-time"];
            
            
            $conn->query("INSERT INTO events VALUES (id, $_COOKIE[userid], '$nev', '$fajlnev', '$leiras', '$ido')");        
            if (move_uploaded_file($_FILES["event-photo"]["tmp_name"], $fajl_cel)) {
                Message("Esemény sikeresen feltöltve!");
            } else {
                Message("Hiba történt az esemény feltöltése során.");
            }
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/announce_event.css">
    <title>Document</title>
</head>
<body>
    <?php MakeNav(false)?>
    <main>
        <form action="announce_event.php?userid=<?=$_GET["userid"];?>" method="post" enctype="multipart/form-data">
            <h1 class="announce">Rendezvényhirdetés</h1>
            <input type="text" name="event-name" id="" required placeholder="Esemény neve">
            <input type="file" name="event-photo" id=""required>
            <textarea rows="12" resize="none" name="description" required placeholder="Leírás az eseményről bővebben"></textarea>
            <input type="datetime-local" name="event-time" id=""required>
            <input type="submit" value="Feltöltés" name="btn">
        </form>

    </main>
    <?php MakeFooter()?>
</body>
</html>
<?php MakeMark("announce_event")?>