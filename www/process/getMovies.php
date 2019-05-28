<?php
    include("../include/database.php");

    $query = "SELECT '', `movieId`, `movieName`, `genre`, `rating`, `comments`, `instock`, `price` From movies";

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