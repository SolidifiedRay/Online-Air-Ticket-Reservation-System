<?php

session_start();

$airport_name = $_POST["airport_name"];
$city = $_POST["city"];
//1.connect
$db = new MySQLi("localhost","solidifiedray","Ray826589!","solidifiedray");

//if user is logged in, redirect to homepage
if(isset($_SESSION["username"])){
    //check if email is already in the database
    if ($stmt = $db->prepare("select airport_name from airport where airport_name = ?")) {
            $stmt->bind_param("s", $_POST["f_id"]);
            $stmt->execute();
            $stmt->bind_result($temp);
            if ($stmt->fetch()) {
                echo "That flight already exists. ";
                echo "You will be redirected in 3 seconds or click <a href=\"add_airport.html\">here</a>.";
                header("refresh: 3; add_airport.html");
                $stmt->close();
            }
            else{
                //2.sql statement
                $sql = "insert into airport values('{$airport_name}','{$city}')";
                //3.execute
                $r = $db->query($sql);
                if($r)
                {
                    echo "<script> alert('Submit Successful');location.href='staff.php' </script>";
                }
                else
                {
                    echo "<script> alert('Submit Failed');location.href='add_airport.html' </script>";
                }
            }
    }
}
else{
    echo "<script> alert('You need to login first');location.href='login.html' </script>";
}




?>
