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
            $sql = $conn->prepare("INSERT INTO movies (`movieId`, `movieName`, `genre`, `rating`, `comments`, `instock`, `price`, `addDate`, `addUser`) VALUES (:aid,:aname,:agenre,:arating,:acomments,:ainstock,:aprice,:adate,:auser)");

            $sql->bindParam(':aid', $newId);
            $sql->bindParam(':aname', $addTitle);
            $sql->bindParam(':agenre', $addGenre);
            $sql->bindParam(':arating', $addRating);
            $sql->bindParam(':acomments', $addComments);
            $sql->bindParam(':ainstock', $addInStock);
            $sql->bindParam(':aprice', $addPrice);
            $sql->bindParam(':adate', $addDate);
            $sql->bindParam(':auser', $addUser);
            
            if($sql->execute())
            {
                echo "Success";
            }
        }
        catch(Exception $e){
            echo "Insert Error: " . $e->getMessage() . "\n";
            exit;
        }
        $conn=null; 
    }
 
    if(isset($_POST['editcriteria']))
    {
        $value = $_POST['editcriteria'];

        $editName = $value['editName'];
        $editId = $value['editId'];
        $editGenre = $value['editGenre'];
        $editRating = $value['editRating'];
        $editInstock = $value['editInstock'];
        $editPrice = $value['editPrice'];
        $editDate = date("Y-m-d H:i:s");
        $editUser = 'usa.jbeasley'; 

        try{
            $sql = $conn->prepare("UPDATE movies SET movieName = :ename, genre = :egenre, rating = :erating, instock = :estock, price = :eprice, editDate = :edate, editUser = :euser WHERE movieId = :eid");

            $sql->bindParam(':ename', $editName);
            $sql->bindParam(':egenre', $editGenre);
            $sql->bindParam(':erating', $editRating);
            $sql->bindParam(':estock', $editInstock);
            $sql->bindParam(':eprice', $editPrice);
            $sql->bindParam(':edate', $editDate);
            $sql->bindParam(':euser', $editUser);
            $sql->bindParam(':eid', $editId);

            if($sql->execute())
            {
                echo "Success";
            }
        }
        catch(Exception $e){
            echo "Update Error: " . $e->getMessage() . "\n";
            exit;
        }
        $conn=null;
    }

    if(isset($_POST['deletecriteria']))
    {
        $value = $_POST['deletecriteria'];

        $deleteName = $value['deleteName'];
        $deleteId = $value['deleteId'];
        $deleteGenre = $value['deleteGenre'];
        $deleteRating = $value['deleteRating'];
        $editInstock = $value['deleteInstock'];
        $deletePrice = $value['deletePrice'];
        $deleteDate = date("Y-m-d H:i:s");
        $deleteUser = 'usa.jbeasley'; 

        try{
            $sql = $conn->prepare("DELETE FROM movies WHERE movieId = :did");

            $sql->bindParam(':did', $deleteId);

            if($sql->execute())
            {
                echo "Success";
            }
        }
        catch(Exception $e){
            echo "Delete Error: " . $e->getMessage() . "\n";
            exit;
        }
        $conn=null;       
    }
?> 