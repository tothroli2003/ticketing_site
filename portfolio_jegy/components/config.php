<?php
    $conn=new mysqli("localhost","root","","portfolio_jegy");
    if($conn->connect_error){
        die($conn->connect_error." HIBA!");
    }
?>