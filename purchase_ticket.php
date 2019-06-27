<?php
    session_start();

    if($_SESSION["username"]){
      $email = $_SESSION["username"];
    }
    else{
       echo "<script> alert('You need to login first');location.href='login.html' </script>";
    }

    $f_id = $_GET['f_id'];
    $price = $_GET['price'];

    $mysqli = new MySQLi("localhost","solidifiedray","Ray826589!","solidifiedray");
    $sql = "SELECT * FROM flight WHERE f_id = '{$f_id}'";
    $result = $mysqli->query($sql);
    while ($row = $result -> fetch_assoc()){
        $d_date_time  = $row["d_date_time"];
        $al_name  = $row["al_name"];  
        $ap_id   = $row["ap_id"];  
        $d_airport    = $row["d_airport"];
        $a_airport   = $row["a_airport"]; 
        $a_date_time  = $row["a_date_time"];
        $status     = $row["status"];
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
                        <font class="login-title">Purchase Ticket</font>
                        <hr/>
                        <br/>
                        <form class="form-horizontal" role="form" action="purchase.php?f_id=$f_id & price=$price & al_name=$al_name & d_date_time=$d_date_time" method="post">
                          <font class="login-subtitle">Card type:</font><br/>
                          <div class="form-group">
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="card_type" name="card_type" placeholder="Please enter your card type">
                            </div>
                          </div>
                          <font class="login-subtitle">Card number:</font><br/>
                          <div class="form-group">
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="card_number" name="card_number" placeholder="Please enter your card nunmber">
                            </div>
                          </div>
                          <font class="login-subtitle">Name on card:</font><br/>
                          <div class="form-group">
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="name_on_card" name="name_on_card" placeholder="Please enter your name on card">
                            </div>
                          </div>
                          <font class="login-subtitle">Expiration Date:</font><br/>
                          <div class="form-group">
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="exp_date" name="exp_date" placeholder="Please enter your card expiration date format:2019-01-01">
                            </div>
                          </div>
                          <br/><br/>
                          <div class="form-group">
                            <div class="col-sm-10">
                              <button type="submit" class="btn btn-default">
                                <font class="login-subtitle">Purchase</font>
                              </button>
                            </div>
                          </div>
                        </form>
                        <br/><br/><br/><br/>
                      </td>
                      <td width="1%"></td>
                      <td width="35%" class="login-table-right">
                        <font class="login-text">
                          Flight info<br/>
                          Flight ID: $f_id  <br/>  
                          Depature date time: $d_date_time  <br/>
                          Airline name: $al_name  <br/>
                          Airplane ID: $ap_id   <br/>
                          Depature airport: $d_airport  <br/>  
                          Arrival airport: $a_airport  <br/>
                          Arrival date time: $a_date_time <br/>
                          Price: $price  <br/>
                          Status: $status    <br/>
                        </font>
                          <br/><br/>
                        <font class="login-text">
                          <span class="glyphicon glyphicon-plane main-icon" aria-hidden="true"></span><br/><br/>
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