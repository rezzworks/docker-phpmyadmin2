<?php
    include("../include/sessions.php");

    if(isset($_POST['addcriteria']))
    {
        $value = $_POST['addcriteria'];

        $addFirstName = $value['addFirstName'];
        $addLastName = $value['addLastName'];
        $addUsername = $value['addUsername'];
        $addEmail = $value['addEmail'];
        $addUserLevel = $value['addUserLevel'];
        $addDept = $value['addDept'];
        $addTitle = $value['addTitle'];
        $addPhone = $value['addPhone'];
        $addDate = date('Y-m-d H:i:s');
        $addUser = $sessusername;
        $length = 10;
        $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
        $addPassword = password_hash($randomString, PASSWORD_BCRYPT);

        try
        {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $select =  $conn->prepare("SELECT MAX(id)+1 AS ADDID FROM users");

            if($select->execute())
            {
                $row = $select->fetch(PDO::FETCH_ASSOC);

               $addId = $row['ADDID'];
            }
            else
            {
                echo "bad";
            }
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }

        echo "you are here and the new id is " . $addId;
    }
?>