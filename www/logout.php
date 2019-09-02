<?php
    include('include/sessions.php');
    session_start();
    session_destroy();
    header('Location: index.php');
?>