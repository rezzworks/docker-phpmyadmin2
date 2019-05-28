<?php
    include("../include/database.php");

    if(isset($_POST['addcriteria']))
    {
        $value = $_POST['addcriteria'];

        $addTitle = $value['addTitle'];
        $addGenre = $value['addGenre'];
        $addRating = $value['addRating'];
        $addInStock = $value['addInStock'];
        $addPrice = $value['addPrice'];
        $addComments = $value['addComments'];
        $addDate = date("Y-m-d H:i:s");
        $addUser = 'usa.jbeasley';

        try{
            $select = "SELECT max(movieId) + 1 AS `NEW_ID` FROM movies";
            $result = $conn->query($select);
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $newId = $row['NEW_ID'];
            $result = null;
        }
        catch(Exception $e){
            echo "ID Error: " . $e->getMessage() . "\n";
            exit;
        }

        try{
            $sql = $conn->prepare("INSERT INTO movies (`movieId`, `movieName`, `genre`, `rating`, `comments`, `instock`, `price`, `addDate`, `addUser`) VALUES (?,?,?,?,?,?,?,?,?)");
            $sql->bindParam(1, $newId);
            $sql->bindParam(2, $addTitle);
            $sql->bindParam(3, $addGenre);
            $sql->bindParam(4, $addRating);
            $sql->bindParam(5, $addComments);
            $sql->bindParam(6, $addInStock);
            $sql->bindParam(7, $addPrice);
            $sql->bindParam(8, $addDate);
            $sql->bindParam(9, $addUser);
            $sql->execute();

            echo "Success";
        }
        catch(Exception $e){
            echo "Insert Error: " . $e->getMessage() . "\n";
            exit;
        }
        




        $conn=null; 
    }

?>