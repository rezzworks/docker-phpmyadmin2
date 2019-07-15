<?php
    include("../include/sessions.php");

    $query = "SELECT '', `id`, `firstName`, `lastName`, `username`, `email`, `userlevel`, `department`, `title`, `phone`, `addDate`, `addUser`, `lastLogin` From users";

    if($result = $conn->query($query))
    {
        $out = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            $out[] = $row;
        }
        echo json_encode($out);
        $result=null;
    }

    $conn=null; 
?>