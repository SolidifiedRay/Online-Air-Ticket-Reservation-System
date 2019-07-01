<?php

session_start();

$username = $_POST["username"];
$password = md5($_POST["password"]);
$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$date_of_birth = $_POST["date_of_birth"];
$phone_number = $_POST["phone_number"];
$airline_name = $_POST["airline_name"];
$staff_id = $_POST["staff_id"];

if($staff_id = "staff"){
    //1.connect
    $db = new MySQLi("localhost","solidifiedray","Ray826589!","solidifiedray");

    //if user is logged in, redirect to homepage
    if(isset($_SESSION["username"])){
        echo "You are already logged in. ";
        //login.html part TODO (chaneg to homepage when finished)
        echo "You will be redirected in 3 seconds or click <a href=\"login.html\">here</a>.";
        header("refresh: 3; user.php");
    }
    else{
        //check if email is already in the database
        if ($stmt = $db->prepare("select user_name from staff where user_name = ?")) {
                $stmt->bind_param("s", $_POST["username"]);
                $stmt->execute();
                $stmt->bind_result($user_name);
                if ($stmt->fetch()) {
                    echo "That username already exists. ";
                    echo "You will be redirected in 3 seconds or click <a href=\"register.html\">here</a>.";
                    header("refresh: 3; register.html");
                    $stmt->close();
                }
                else{
                    if($username == '' or $password == '' or $first_name == '' or $last_name == '' or $date_of_birth == ''
                        or $phone_number == '' or $airline_name == ''){
                        echo "<script> alert('You need to enter all the information');location.href='register.html' </script>";
                    }
                    else{
                        //2.sql statement
                        $sql = "insert into staff values('{$username}','{$airline_name}','{$password}','{$first_name}','{$last_name}','{$date_of_birth}')";
                        $sql2 = "insert into staff_phone values('{$username}','{$phone_number}')";
                        //3.execute
                        $r = $db->query($sql);
                        $r2 = $db->query($sql2);
                        if($r && $r2)
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
    }
}
else{
    echo "<script> alert('You are not a staff!');location.href='register.html' </script>";
}

?>
