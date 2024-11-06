<?php
    
    function Message($text){
        echo"<script>alert('$text')</script>";
    }
    
    function NewCart(){
        $_SESSION["cart"]=array();
    }
    
    function GetACart(){
        session_start();
        if(!isset($_SESSION["cart"])){
            NewCart(); 
        }
    }

    function MakeCode(){
        $kod="";
        $szamok="0 1 2 3 4 5 6 7 8 9";
        $szamok2=explode(" ",$szamok);
        for($i=0; $i<11;$i++){
            $kod.=$szamok2[rand(0,count($szamok2)-1)];
        }
        return $kod;
    }
    
    function MakeNav($isindex){
       
            if ($isindex) {
            ?>
                <header>
                    <nav class="clearfix">
                        <img src="img/JegyHorgasz_logo_converted.png" <?php if(!isset($_COOKIE["userid"])) { ?>style="float: inline-start; margin-left: 15px;"<?php } ?> alt="JegyHorgász">
                        <a href="components/login.php">Reg/Log</a>
                        <a class="active" href="#">Kezdőlap</a>
                        
                        <?php if (isset($_COOKIE["userid"])) { ?>
                            <a id="profile" class="left" href="components/profile.php?userid=<?=$_COOKIE["userid"];?>">Profil</a>
                            <a id="announce_event" class="left" href="components/announce_event.php?userid=<?=$_COOKIE["userid"];?>">Új rendezvény hozzáadása</a>
                        <?php } ?>
                        
                        <a id="cart" href="components/cart.php">Kosár</a>
                    </nav>
                </header>
            <?php
            }
        else {
                ?>
            <header>
            <nav class="clearfix">
                <img src="../img/JegyHorgasz_logo_converted.png" <?php if(!isset($_COOKIE["userid"])) { ?>style="float: inline-start; margin-left: 15px;"<?php } ?> alt="JegyHorgász">
                
                
                    <a href="../components/login.php">Reg/Log</a>
                
                
                <a href="../">Kezdőlap</a>
                
                <?php if (isset($_COOKIE["userid"])) { ?>
                    <a id="profile" class="left" href="../components/profile.php?userid=<?=$_COOKIE["userid"];?>">Profil</a>
                    <a id="announce_event" class="left" href="../components/announce_event.php?userid=<?=$_COOKIE["userid"];?>">Új rendezvény hozzáadása</a>
                <?php } ?>
                
                <a id="cart" href="../components/cart.php">Kosár</a>
            </nav>
        </header>
    <?php } 
    }

    function MakeFooter(){
        
            echo
            '<footer>
                JegyHorgász© - Tóth Roland '.date("Y",time()).' 

            </footer>';
        
    }

    function MakeMark($page){
        echo'<script>
            document.getElementById("'.$page.'").classList.add("active");
        </script>';
    }
?>