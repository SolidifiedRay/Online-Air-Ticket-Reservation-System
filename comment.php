<?php

session_start();

$f_id = $_GET['f_id'];
$al_name = $_GET['al_name'];
$d_date_time = $_GET['d_date_time'];
$c_email = $_SESSION["username"];
$rating = $_POST["rating"];
$comment = $_POST["comment"];

//1.connect
$db = new MySQLi("localhost","solidifiedray","Ray826589!","solidifiedray");

//2.sql statement
$sql2 = "insert into rating values('{$c_email}','{$f_id}','{$d_date_time}','{$al_name}','{$rating}','{$comment}');";

//3.execute
$r = $db->query($sql2);
if($r)
{
    echo "<script> alert('Rating Successful');location.href='user.php' </script>";
}
else
{
    echo "<script> alert('Rating Failed'); </script>";
    echo "{$sql2}";
}

?>
