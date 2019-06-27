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
                        <font class="login-title">Comment Flight</font>
                        <hr/>
                        <br/>
                        <form class="form-horizontal" role="form" action="comment.php?f_id=$f_id & al_name=$al_name & d_date_time=$d_date_time" method="post">
                          <font class="login-subtitle">Rate the flight:</font><br/>
                          <div class="form-group">
                            <div class="col-sm-10">
                              <div>
                                  <label class="radio-inline">
                                      <input type="radio" name="rating" id="rating1" value="1" checked> 1
                                  </label>
                                  <label class="radio-inline">
                                      <input type="radio" name="rating" id="rating2"  value="2"> 2
                                  </label>
                                  <label class="radio-inline">
                                      <input type="radio" name="rating" id="rating3" value="3" checked> 3
                                  </label>
                                  <label class="radio-inline">
                                      <input type="radio" name="rating" id="rating4"  value="4"> 4
                                  </label>
                                  <label class="radio-inline">
                                      <input type="radio" name="rating" id="rating5" value="5" checked> 5
                                  </label>
                              </div>
                            </div>
                          </div>
                          <font class="login-subtitle">Comment:</font><br/>
                          <div class="form-group">
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="comment" name="comment" placeholder="Write comment here">
                            </div>
                          </div>
                          </div>
                          <br/><br/>
                          <div class="form-group">
                            <div class="col-sm-10">
                              <button type="submit" class="btn btn-default">
                                <font class="login-subtitle">Submit</font>
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