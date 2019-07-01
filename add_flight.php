<?php

session_start();

$f_id = $_POST["f_id"];
$d_date_time = $_POST["d_date_time"];
$al_name = $_POST["al_name"];
$ap_id = $_POST["ap_id"];
$d_airport = $_POST["d_airport"];
$a_airport = $_POST["a_airport"];
$a_date_time = $_POST["a_date_time"];
$base_price_string = $_POST["base_price"];
$base_price = (double)$base_price_string;
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
                echo "That flight already exists. ";
                echo "You will be redirected in 3 seconds or click <a href=\"add_flight.html\">here</a>.";
                header("refresh: 3; add_flight.html");
                $stmt->close();
            }
            else{
                if($f_id == '' or $d_date_time == '' or $al_name == '' or $ap_id == '' or $d_airport == '' or $a_airport == '' or $a_date_time == ''
                    or $status == '' or $base_price_string == ''){
                    echo "<script> alert('You need to enter all the information');location.href='add_flight.html' </script>";
                }
                else{
                    //2.sql statement
                    $sql = "insert into flight values('{$f_id}','{$d_date_time}','{$al_name}','{$ap_id}','{$d_airport}','{$a_airport}',
                            '{$a_date_time}','{$base_price}','{$status}')";
                    //3.execute
                    $r = $db->query($sql);
                    if($r)
                    {
                        echo "<script> alert('Submit Successful');location.href='staff.php' </script>";
                    }
                    else
                    {
                        echo "<script> alert('Submit Failed');location.href='add_flight.html' </script>";
                    }
                }
                
            }
    }
}
else{
    echo "<script> alert('You need to login first');location.href='login.html' </script>";
}




?>
