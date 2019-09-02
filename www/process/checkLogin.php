<?php
    include("../include/sessions.php");

    if(isset($_POST['logincriteria']))
    {
        $value = $_POST['logincriteria'];

        $user = $value['user'];
        $pass = $value['pass'];

        $sql = "SELECT `id`, `firstName`, `lastName`, `username`, `password`, `email`, `userlevel`, `department`, `title`, `phone` FROM users WHERE `username` = :USERNAME";
        $sth = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        
        $sth->bindParam(':USERNAME', $user);
        $res = $sth->execute();
        $row = $sth->fetch(PDO::FETCH_ASSOC);

        //if(password_verify($pass, $row['password']))
        if($pass == $row['password'])
        {
            $_SESSION['user'] = $row;
            $dbuser = $_SESSION['user']['username'];

            $update = "UPDATE users SET `lastLogin` = NOW() WHERE `username` = :USERNAME";
            $upd = $conn->prepare($update, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $upd->bindParam(':USERNAME', $dbuser);
            $res = $upd->execute();

            if($res)
            {
                echo "Success";               
            }
            else
            {
                echo "Error: Could not log you in.";
            }
        }
        else
        {
            echo "Error: Incorrect username or password " . $row['password'];
        }
    }
?>