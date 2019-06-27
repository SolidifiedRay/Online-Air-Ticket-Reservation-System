<?php
    session_start();

    if($_SESSION["type"]){
       echo "<script> alert('Moving to staff page');location.href='staff.php' </script>";
    }

    if($_SESSION["username"]){
      $email = $_SESSION["username"];
    }
    else{
       echo "<script> alert('You need to login first');location.href='login.html' </script>";
    }

    $mysqli = new MySQLi("localhost","solidifiedray","Ray826589!","solidifiedray");
    $sql = "SELECT * FROM customer WHERE c_email = '{$email}'";
    $result = $mysqli->query($sql);
    while ($row = $result -> fetch_assoc()){
        $c_name = $row["c_name"];
        $building_name  = $row["building_name"];
        $street    = $row["street"]; 
        $city    = $row["city"]; 
        $state    = $row["state"];  
        $phone_num   = $row["phone_num"];
        $passport_num = $row["passport_num"];
        $passport_expiration  = $row["passport_expiration"];
        $passport_country  = $row["passport_country"];
        $date_of_birth  = $row["date_of_birth"];
    }

    print <<<EOT

    <!doctype html>
    <html lang="en">
       <head>
          <!-- Required meta tags -->
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

          <title>Online Air Ticket Reservation System</title>
          <link rel="shortcut icon" href="img/icon/web_icon.png" type="image/x-icon"/>
          <link href="files/css/index.css" rel="stylesheet" type="text/css">

          <!-- 引入 Bootstrap -->
          <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
          <!-- HTML5 Shiv 和 Respond.js 用于让 IE8 支持 HTML5元素和媒体查询 -->
          <!-- 注意： 如果通过 file://  引入 Respond.js 文件，则该文件无法起效果 -->
          <!--[if lt IE 9]>
             <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
             <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
          <![endif]-->
       </head>
       <body background="img/background.jpg" class="index-background">

          <div id="nav">
              <public-header></public-header>
          </div> 
          <?php
            
          ?>
          <div class="content-box">
              <br/><br/><br/><br/><br/><br/><br/>
              <div class="container" style="width: 100%">
                <div class="row">
                  <table class="login-table">
                    <tr>
                      <td width="64%" class="login-table-left">
                        <font class="login-title">Welcome!</font>
                        <hr/>
                        <br/>
                        <p style="font-size: 22px;">
                          email: $email<br/>
                          name: $c_name<br/>
                          address: building:$building_name street:$street state:$state<br/>
                          phone number: $phone_num<br/>
                          date of birth: $date_of_birth<br/>
                          passport number: $passport_num<br/>
                          passport country: $passport_country<br/>
                          passport expiration date: $passport_expiration<br/>
                        </p>
                        <br/><br/><br/><br/>
                      </td>
                      <td width="1%"></td>
                      <td width="35%" class="login-table-right">
                        <font class="login-text">
                          View My flights<br/>
                          <a href="search.php"><font class="login-text">Search for flights<font class="login-text"><br/></a>
                          <a href="search.php"><font class="login-text">Purchase tickets<br/><font class="login-text"></a>
                          <a href="search.php"><font class="login-text">Give rating and comments on previous flights<br/><font class="login-text"></a>
                          Track My Spending<br/>
                          <a href="logout.php"><font class="login-text"><u>Logout</u></font></a><br/>
                        </font>
                          <br/><br/>
                        <font class="login-text">
                          <span class="glyphicon glyphicon-user main-icon" aria-hidden="true"></span><br/><br/>
                        </font>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
              
              <br/><br/><br/><br/><br/><br/><br/>
          </div>

          <!-- jQuery (Bootstrap 的 JavaScript 插件需要引入 jQuery) -->
          <script src="https://code.jquery.com/jquery.js"></script>
          <script src="components/navigation.js?v=1.1"></script>
       </body>
    </html>

EOT;
?>