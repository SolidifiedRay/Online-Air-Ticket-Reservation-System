<?php

session_start();

$f_id = $_GET['f_id'];
$price = $_GET['price'];
$al_name = $_GET['al_name'];
$d_date_time = $_GET['d_date_time'];
$c_email = $_SESSION["username"];
$card_type = $_POST["card_type"];
$card_number = $_POST["card_number"];
$name_on_card = $_POST["name_on_card"];
$s_code = $_POST["s_code"];
$exp_date = $_POST["exp_date"];
$curr_date = new DateTime();
$purchase_date_time = $curr_date->format('Y-m-d H:i:s');

//1.connect
$db = new MySQLi("localhost","solidifiedray","Ray826589!","solidifiedray");

$sql = "SELECT MAX(t_id) FROM ticket";
$result = $db->query($sql);

if ($result-> num_rows>0){
    //table is not empty
    $tid = mysqli_fetch_array($result);
    $newid = (int)$tid[0] + 1;
}
else{
    //table is empty
    $newid = 1000000;
}

//2.sql statement
$sql2 = "insert into ticket values('{$newid}','{$f_id}','{$al_name}','{$d_date_time}','{$c_email}','{$price}',
        '{$card_type}','{$card_number}','{$name_on_card}','{$exp_date}','{$s_code}','{$purchase_date_time}');";

//3.execute
$r = $db->query($sql2);
if($r)
{
    echo "<script> alert('Purchase Successful');location.href='user.php' </script>";
}
else
{
    echo "<script> alert('Purhcase Failed'); </script>";
    echo "{$sql2}";
}

?>
