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

$sql = "SELECT t_id FROM ticket ORDER BY cast(t_id as UNSIGNED INTEGER) DESC";
$result = $db->query($sql);

if ($result-> num_rows>0){
    //table is not empty
    $tid = mysqli_fetch_array($result);
    $newid = (int)$tid[0] + 1;
}
else{
    //table is empty
    $newid = 1;
}

if(isset($_SESSION["username"])){
	//2.sql statement
	$sql = "insert into ticket values('{$newid}','{$f_id}','{$al_name}','{$d_date_time}','{$c_email}','{$price}',
	        '{$card_type}','{$card_number}','{$name_on_card}','{$exp_date}','{$s_code}','{$purchase_date_time}');";

	//3.execute
	$r = $db->query($sql);
	if($r)
	{
	    echo "<script> alert('Purchase Successful');location.href='user_view.php' </script>";
	}
	else
	{
	    echo "<script> alert('Purchase Failed');location.href='search.php' </script>";
	}
				
}
else{

    echo "You need to log in. ";
    //login.html part TODO (chaneg to homepage when finished)
    echo "You will be redirected in 3 seconds or click <a href=\"login.html\">here</a>.";
    header("refresh: 3; login.html");
}

?>
