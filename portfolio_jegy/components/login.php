<?php
    require "config.php";
    require "functions.php";
   
    if(isset($_POST["reg-btn"])){
        $talalatok=$conn->query("SELECT * FROM users WHERE username='$_POST[user]'");
        if(mysqli_num_rows($talalatok)>0){
           Message("Foglalt felhasználónév"); 
        }
        
        else{
            $talalatok=$conn->query("SELECT * FROM users WHERE email='$_POST[email]'");
            if(mysqli_num_rows($talalatok)>0){
                Message("Foglalt email-cím!"); 
            }
            else{
                if($_POST["pw"]!=$_POST["pw-again"]){
                    Message("Nem egyező jelszavak!");
                }
                else{
                    $pw_secure=password_hash($_POST["pw"],PASSWORD_DEFAULT);
                    $conn->query("INSERT INTO users VALUES (id,'$_POST[user]','$_POST[email]','$pw_secure')");
                    $keresett=$conn->query("SELECT * FROM users WHERE username= '$_POST[user]'")->fetch_assoc();
                    setcookie('userid',$keresett['id'],time()+3600,"/");
                    header("Location: ../index.php");
                }
            }
        }
    }

    if(isset($_POST["log-btn"])){
        $lekerdezes = "SELECT * FROM users WHERE username='$_POST[username]'";
        $talalt_felhasznalo = $conn->query($lekerdezes);
        if(mysqli_num_rows($talalt_felhasznalo) == 1){
            $felhasznalo = $talalt_felhasznalo->fetch_assoc();
            if(password_verify($_POST['password'], $felhasznalo['password'])){
                setcookie('userid', $felhasznalo['id'], time() + 3600, "/");
                header("Location: ../index.php");
            }
            else{
                Message('Helytelen jelszó!');
            }
        }
        else{
            Message('Nincs ilyen felhasználó!');
        }
    }?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <title>JegyHorgász</title>
</head>
<body>
    <div class="coin">
        <div class="back">
            <form action="login.php" method="post"><h1>Bejelentkezés</h1>
                <input type="text" name="username" id="" placeholder="Felhasználónév">
                <input type="password" name="password" id="" placeholder="Jelszó">
                <input type="submit" value="Bejelentkezés" name="log-btn">
            </form>
        </div>    
        <div class="front">
            <form action="login.php" method="post"><h1>Regisztráció</h1>
                <input type="text" name="user" id="" placeholder="Felhasználónév">
                <input type="email" name="email" id="" placeholder="E-mail">
                <input type="password" name="pw" id="" placeholder="Jelszó">
                <input type="password" name="pw-again" id="" placeholder="Jelszó újra">
                <input type="submit" value="Regisztráció" name="reg-btn">
            </form>
        </div>
    </div>
    <div class="addon">
    </div>
    <div class="swapper">
        <p id="l">Regisztráltál már? <a  href="#"onclick="ShowForm('l')">Jelentkezz be!</a><p>
        <p id="r">Nincs fiókod? <a  href="#" onclick="ShowForm('r')">Regisztrálj!</a><p></div>
        
    <script>
        const back = document.querySelector(".back");
        const front = document.querySelector(".front");
        const l = document.getElementById("l");
        const r = document.getElementById("r");
        r.style.display="none";
        back.style.display="none";

        function ShowForm(fn){
            if(fn=="r"){
                front.style.display="block";
                l.style.display="block";
                r.style.display="none";
                back.style.display="none";
                
            }
            if(fn=="l"){
                front.style.display="none";
                l.style.display="none";
                r.style.display="block";
                back.style.display="block";
            }
        }
    </script>
</body>
</html>