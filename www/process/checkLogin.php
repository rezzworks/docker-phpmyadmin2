<?php
    include("../include/database.php");

    if(isset($_POST['logincriteria']))
    {
        $value = $_POST['logincriteria'];

        $user = $value['user'];
        $pass = $value['pass'];

        echo "this is user " . $user;
    }
?>