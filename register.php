<?php

$username = $_POST["username"];
$password = $_POST["password"];
$name = $_POST["name"];
$building_name = $_POST["building_name"];
$street = $_POST["street"];
$city = $_POST["city"];
$state = $_POST["state"];
$phone_number = $_POST["phone_number"];
$passport_expiration = $_POST["passport_expiration"];
$passport_number = $_POST["passport_number"];
$passport_country = $_POST["passport_country"];
$passport_expiration = $_POST["passport_expiration"];

//1.connect
$db = new MySQLi("localhost","solidifiedray","Ray826589!","solidifiedray");

//2.sql statement
$sql = "insert into customer values('{$username}','{$password}','{$name}','{$building_name}','{$street}','{$city}',
		'{$state}','{$phone_number}','{$passport_expiration}','{$passport_number}','{$passport_country}','{$passport_expiration}')";

//3.execute
$r = $db->query($sql);

if($r)
{
    echo "Success";
}
else
{
    echo "Fail";
}



?>