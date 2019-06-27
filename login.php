<?php

$mysqli = new MySQLi("localhost","solidifiedray","Ray826589!","solidifiedray");

//if the user is already logged in, redirect them back to homepage
if(isset($_SESSION["username"])) {
  echo "You are already logged in. \n";
  echo "You will be redirected in 3 seconds or click <a href=\"login.html\">here</a>.\n";
  header("refresh: 3; login.html");
}
else {
  //if the user have entered both entries in the form, check if they exist in the database
  if(isset($_POST["username"]) && isset($_POST["password"])) {

    //check if entry exists in database
    if ($stmt = $mysqli->prepare("select c_email, password from customer where c_email = ? and password = ?")) {
      $hashpassword = md5($_POST["password"]);
      $stmt->bind_param("ss", $_POST["username"], $hashpassword);
      $stmt->execute();
      echo "{$_POST["username"]} {$hashpassword}";
      $stmt->bind_result($username, $password);
        //if there is a match set session variables and send user to homepage
        if ($stmt->fetch()) {
          $_SESSION["username"] = $username;
          $_SESSION["password"] = $password;
          $_SESSION["REMOTE_ADDR"] = $_SERVER["REMOTE_ADDR"]; //store clients IP address to help prevent session hijack
          echo "Login successful. \n";
          echo "You will be redirected in 3 seconds or click <a href=\"user.html\">here</a>.";
          header("refresh: 3; user.html");
        }
        //if no match then tell them to try again
        else {
          sleep(1); //pause a bit to help prevent brute force attacks
          echo "Your username or password is incorrect, click <a href=\"login.html\">here</a> to try again.";
        }
      $stmt->close();
      $mysqli->close();
    }  
  }
}
?>