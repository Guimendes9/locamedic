<?php

    session_start();
    if(empty($_SESSION)){
        header("Location: logar.php");
    }
    else{
        header("location: inicio.php");
    }
    
?>
