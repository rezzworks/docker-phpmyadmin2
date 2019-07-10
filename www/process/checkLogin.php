<?php
    include("../include/sessions.php");

    if(isset($_POST['logincriteria']))
    {
        $value = $_POST['logincriteria'];

        $user = $value['user'];
        $pass = $value['pass'];

        $sql = "SELECT `id`, `firstName`, `lastName`, `username`, `password`, `email`, `department`, `title`, `phone` FROM users WHERE `username` = :USERNAME";
        $sth = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        
        $sth->bindParam(':USERNAME', $user);
        $res = $sth->execute();
        $row = $sth->fetch(PDO::FETCH_ASSOC);

        if($row['password'] == $pass)
        {
            $_SESSION['user'] = $row;

            echo 'Success';
        }
        else
        {
            echo "Error: Incorrect username or password";
        }
    }
?>