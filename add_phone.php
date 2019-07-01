<?php

session_start();

$phone_number = $_POST["phone_number"];

if($staff_id = "staff"){
    //1.connect
    $db = new MySQLi("localhost","solidifiedray","Ray826589!","solidifiedray");

    //check if email is already in the database
    if ($stmt = $db->prepare("select user_name from staff where user_name = ?")) {
            $stmt->bind_param("s", $_SESSION["username"]);
            $stmt->execute();
            $stmt->bind_result($user_name);
            if ($stmt->fetch()) {
                $stmt->close();

                if($phone_number == ''){
                    echo "<script> alert('You need to enter all the information');location.href='add_phone.html' </script>";
                }
                else{
                    //2.sql statement
                    $sql2 = "insert into staff_phone values('{$_SESSION["username"]}','{$phone_number}')";
                    //3.execute
                    $r2 = $db->query($sql2);
                    if($r2)
                    {
                        echo "<script> alert('Submit Successful');location.href='user.php' </script>";
                    }
                    else
                    {
                        echo "<script> alert('Submit Failed');location.href='add_phone.html' </script>";
                    }
                }
            }
            else{
                echo "Staff not exists. ";
                echo "You will be redirected in 3 seconds or click <a href=\"login.html\">here</a>.";
                header("refresh: 3; login.html");
            }
    }
    
}
else{
    echo "<script> alert('You are not a staff!');location.href='register.html' </script>";
}

?>
