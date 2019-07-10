<?php
    #session_cache_limiter('nocache');
    #session_cache_expire(1);
    //if(isset($_SESSION['user'])){session_start();}
    
    include("database.php");

    $sessid = $_SESSION['user']['id'];
    $sessfirstname = $_SESSION['user']['firstName'];
    $sesslastname = $_SESSION['user']['lastName'];
    $sessusername = $_SESSION['user']['username'];
    $sessemail = $_SESSION['user']['email'];
    $sessdept = $_SESSION['user']['dept'];
    $sesstitle = $_SESSION['user']['title'];
    $sessphone = $_SESSION['user']['phone'];

?>