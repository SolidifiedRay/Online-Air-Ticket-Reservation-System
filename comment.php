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

if(isset($_SESSION["username"])){
	if ($stmt = $db->prepare("select c_email, f_id from ticket where c_email = ? and f_id = ?")) {
            $stmt->bind_param("ss", $_SESSION["username"], $_GET['f_id']);
            $stmt->execute();
            $stmt->bind_result($email, $fid);
            if ($stmt->fetch()) {
                $stmt->close();

				//2.sql statement
				$sql = "insert into rating values('{$c_email}','{$f_id}','{$d_date_time}','{$al_name}','{$rating}','{$comment}');";

				//3.execute
				$r = $db->query($sql);
				if($r)
				{
				    echo "<script> alert('Rating Successful');location.href='user.php' </script>";
				}
				else
				{
				    echo "<script> alert('Rating Failed'); location.href='user.php'</script>";
				}
            }
            else{
                echo "You didn't purchase that flight.<br/>";
                echo "You will be redirected in 3 seconds or click <a href=\"search.php\">here</a>.";
            }
    }
}
else{

    echo "You need to log in. ";
    //login.html part TODO (chaneg to homepage when finished)
    echo "You will be redirected in 3 seconds or click <a href=\"login.html\">here</a>.";
    header("refresh: 3; login.html");
}

?>
