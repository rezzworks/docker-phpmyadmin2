<?php
    include("../include/sessions.php");

    if(isset($_POST['addcriteria']))
    {
        $value = $_POST['addcriteria'];

        $addFirstName = $value['addFirstName'];
        $addLastName = $value['addLastName'];
        $addUsername = $value['addUsername'];
        $addEmail = $value['addEmail'];
        $addUserLevel = $value['addUserlevel'];
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

            $select = $conn->prepare("SELECT MAX(id)+1 AS ADDID FROM users");

            if($select->execute())
            {
                $row = $select->fetch(PDO::FETCH_ASSOC);

                $addId = $row['ADDID'];
            }
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }

        try
        {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $insert = $conn->prepare("INSERT INTO users (`id`, `firstName`, `lastName`, `username`, `password`, `email`, `userlevel`, `department`, `title`, `phone`, `addDate`, `addUser`) VALUES (:AID, :AFIRSTNAME, :ALASTNAME, :AUSERNAME, :APASSWORD, :AEMAIL, :AUSERLEVEL, :ADEPARTMENT, :ATITLE, :APHONE, :ADATE, :AUSER)");

            $insert->execute([
                'AID' => $addId,
                'AFIRSTNAME' => $addFirstName,
                'ALASTNAME' => $addLastName,
                'AUSERNAME' => $addUsername,
                'APASSWORD' => $addPassword,
                'AEMAIL' => $addEmail,
                'AUSERLEVEL' => $addUserLevel,
                'ADEPARTMENT' => $addDept,
                'ATITLE' => $addTitle,
                'APHONE' => $addPhone,
                'ADATE' => $addDate,
                'AUSER' => $addUser
            ]);

            if($insert)
            {
                $to = $addEmail;
                $subject = "Movie Catalog - NoReply";
                $headers = "From: do not reply @ Movie Catalog" . "\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                $message .= "You have received a message from the Movie Catalog: <br /><br />";
                $message .= "Greetings <strong>" . $addFirstName . " " . $addLastName . "</strong>, <br /><br />";
                $message .= "You have been granted access to the Movie Catalog web application. Your username and password are as follows: <br /><br />";
                $message .= "<html><body>";
                $message .= "<table rules='all' style='border-color: #62c462' cellpadding='10'>";
                $message .= "<tr style='background: #8D8FCF; border: 1px solid black;'><th>Username</th><th>Password</th></tr>";
                $message .= "<tr style='background: #D1E5EB; border: 1px solid black;'><th>";
                $message .= "<td>" . $addUsername . "</td><td>" . $randomString . "</td>";
                $message .= "</tr>";
                $message .= "</table>";
                $message .= "</body></html>";
                
                mail($to, $subject, $message, $headers);

                echo "Success: New User has been added.";
            }
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
    }

    if(isset($_POST['editcriteria']))
    {
        $value = $_POST['editcriteria'];

        $editId = $value['editId'];
        $editFirstName = $value['editFirstName'];
        $editLastName = $value['editLastName'];
        $editUsername = $value['editUsername'];
        $editEmail = $value['editEmail'];
        $editUserlevel = $value['editUserlevel'];
        $editDept = $value['editDept'];
        $editTitle = $value['editTitle'];
        $editPhone = $value['editPhone'];
        $editDate = date('Y-m-d H:i:s');

        echo 'userlevel ' . $editUserlevel;

        try
        {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $update = $conn->prepare("UPDATE users SET `firstName` = :efirstname, `lastName` = :elastname, `username` = :eusername, `email` = :eemail, `userlevel` = :euserlevel, `department` = :edepartment, `title` = :etitle, `phone` = :ephone WHERE `id` = :eid");

            $update->execute([
                'efirstname' => $editFirstName,
                'elastname' => $editLastName,
                'eusername' => $editUsername,
                'eemail' => $editEmail,
                'euserlevel' => $editUserlevel,
                'edepartment' => $editDept,
                'etitle' => $editTitle,
                'ephone' => $editPhone,
                'eid' => $editId
            ]);

            if($update)
            {
                echo "Success: Record Updated";
            }
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
    }

    if(isset($_POST['resetcritieria']))
    {
        $value = $_POST['resetcriteria'];

        $resetId = $value['resetId'];
        $resetPass = $value['resetPass'];
        $newPassword = password_hash($resetPass, PASSWORD_DEFAULT);

        try
        {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $update = $conn->prepare("UPDATE users SET `password` = :npass WHERE `id` = :nid");

            $update->execute([
                'npass' => $newPassword,
                'nid' => $resetId
            ]);

            if($update)
            {
                echo "Success: Password was updated.";
            }
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }

    }
?>