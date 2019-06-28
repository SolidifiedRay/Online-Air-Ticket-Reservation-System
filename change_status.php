<?php

session_start();

$f_id = $_POST["f_id"];
$status = $_POST["status"];
//1.connect
$db = new MySQLi("localhost","solidifiedray","Ray826589!","solidifiedray");

//if user is logged in, redirect to homepage
if(isset($_SESSION["username"])){
    //check if email is already in the database
    if ($stmt = $db->prepare("select f_id from flight where f_id = ?")) {
            $stmt->bind_param("s", $_POST["f_id"]);
            $stmt->execute();
            $stmt->bind_result($temp);
            if ($stmt->fetch()) {
                $stmt->close();
                //2.sql statement
                $sql = "UPDATE flight SET status='{$status}' WHERE f_id='{$f_id}'";
                //3.execute
                $r = $db->query($sql);
                if($r)
                {
                    echo "<script> alert('Submit Successful');location.href='staff.php' </script>";
                }
                else
                {
                    echo "<script> alert('Submit Failed');location.href='change_status.php' </script>";
                }
            }
            else{
                echo "Flight doesn't exit. ";
                echo "You will be redirected in 3 seconds or click <a href=\"change_status.html\">here</a>.";
                header("refresh: 3; change_status.html");
            }
    }
}
else{
    echo "<script> alert('You need to login first');location.href='login.html' </script>";
}




?>
