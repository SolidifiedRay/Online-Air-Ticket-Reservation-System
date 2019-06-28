<?php

session_start();

$ap_id = $_POST["ap_id"];
$al_name = $_POST["al_name"];
$ap_name = $_POST["ap_name"];
$seat_string = $_POST["seat"];
$seat = (int)$seat_string;
//1.connect
$db = new MySQLi("localhost","solidifiedray","Ray826589!","solidifiedray");

//if user is logged in, redirect to homepage
if(isset($_SESSION["username"])){
    //check if email is already in the database
    if ($stmt = $db->prepare("select ap_id from airplane where ap_id = ?")) {
            $stmt->bind_param("s", $_POST["f_id"]);
            $stmt->execute();
            $stmt->bind_result($temp);
            if ($stmt->fetch()) {
                echo "That flight already exists. ";
                echo "You will be redirected in 3 seconds or click <a href=\"add_airplane.html\">here</a>.";
                header("refresh: 3; add_airplane.html");
                $stmt->close();
            }
            else{
                //2.sql statement
                $sql = "insert into airplane values('{$ap_id}','{$al_name}','{$ap_name}','{$seat}')";
                //3.execute
                $r = $db->query($sql);
                if($r)
                {
                    echo "<script> alert('Submit Successful');location.href='staff.php' </script>";
                }
                else
                {
                    echo "<script> alert('Submit Failed');location.href='add_airplane.html' </script>";
                }
            }
    }
}
else{
    echo "<script> alert('You need to login first');location.href='login.html' </script>";
}




?>
