<?php

$username = $_POST["username"];
$password = md5($_POST["password"]);
$name = $_POST["name"];
$building_name = $_POST["building_name"];
$street = $_POST["street"];
$city = $_POST["city"];
$state = $_POST["state"];
$phone_number = $_POST["phone_number"];
$passport_expiration = $_POST["passport_expiration"];
$passport_number = $_POST["passport_number"];
$passport_country = $_POST["passport_country"];
$dob = $_POST["date_of_birth"];

//1.connect
$db = new MySQLi("localhost","solidifiedray","Ray826589!","solidifiedray");

//if user is logged in, redirect to homepage
if(isset($_SESSION["username"])){
    echo "You are already logged in. ";
    //login.html part TODO (chaneg to homepage when finished)
    echo "You will be redirected in 3 seconds or click <a href=\"login.html\">here</a>.";
    header("refresh: 3; login.html");
}
else{
    //check if email is already in the database
    if ($stmt = $db->prepare("select c_email from Customer where c_email = ?")) {
            $stmt->bind_param("s", $_POST["username"]);
            $stmt->execute();
            $stmt->bind_result($email);
            if ($stmt->fetch()) {
                echo "That email already exists. ";
                echo "You will be redirected in 3 seconds or click <a href=\"register.html\">here</a>.";
                header("refresh: 3; register.html");
                $stmt->close();
            }
            else{
                //2.sql statement
                $sql = "insert into customer values('{$username}','{$name}','{$password}','{$building_name}','{$street}','{$city}',
                        '{$state}','{$phone_number}','{$passport_number}','{$passport_expiration}','{$passport_country}','{$dob}')";
                //3.execute
                $r = $db->query($sql);
                if($r)
                {
                    echo "<script> alert('Register Successful');location.href='login.html' </script>";
                }
                else
                {
                    echo "<script> alert('Register Failed');location.href='register.html' </script>";
                }
            }
    }
}




?>
