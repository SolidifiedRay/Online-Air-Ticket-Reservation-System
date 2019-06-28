<?php
  
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

        <div class="content-box">
            <br/><br/><br/><br/>
            <div class="container" style="width: 100%">
            <h3><font color="white">Future Flight</font></h3>
          </div>
              <div class="row" style="width: 99%; margin:0 auto;">
                <table class="table table-hover view-table" >
                  <thead style="background-color: #a1a1a1">
                  
                    <tr>
                      <th class="view-table-head">Flight ID</th>
                      <th class="view-table-head">Departure Time</th>
                      <th class="view-table-head">Airline</th>
                      <th class="view-table-head">Airplane</th>
                      <th class="view-table-head">Departure Airport</th>
                      <th class="view-table-head">Arrival Airport</th>
                      <th class="view-table-head">Arrival Time</th>
                      <th class="view-table-head">Price</th>
                      <th class="view-table-head"></th>
                      <th class="view-table-head"></th>
                    </tr>
                  </thead>
                  <tbody>
                    
EOT;
?>
<?PHP
                        session_start();
                        if($_SESSION["username"]){
                          $conn = new mysqli("localhost","solidifiedray","Ray826589!","solidifiedray") or die("Connect failed: %s\n". $conn -> error);
                          $username = $_SESSION["username"];
                          $sql = "SELECT F.* FROM Flight F Natural Join Staff S WHERE S.user_name = '{$username}'
                          and cast(F.d_date_time as datetime) between now()and DATE_ADD(NOW(), INTERVAL +30 DAY) ";                        
                          $result = $conn->query($sql);
                          $num = $result -> num_rows;
                          if ($result-> num_rows>0){
                            while ($row = $result -> fetch_assoc()){
                              echo "<tr>
                                        <td class='view-table-td'>".$row["f_id"]."</td>
                                        <td class='view-table-td'>".$row["d_date_time"]."</td>
                                        <td class='view-table-td'>".$row["al_name"]."</td>
                                        <td class='view-table-td'>".$row["ap_id"]."</td>
                                        <td class='view-table-td'>".$row["d_airport"]."</td>
                                        <td class='view-table-td'>".$row["a_airport"]."</td>
                                        <td class='view-table-td'>".$row["a_date_time"]."</td>
                                        <td class='view-table-td'>".$row["base_price"]."</td>
                                        <td class='view-table-td'><a href='cust_table.php?f_id=".$row["f_id"]."&d_date_time=".$row["d_date_time"]."'>"."View Customer"."</a></td>
                                    </tr>";
                                }
                            echo "</table>";
                            $conn->close();
                          }
                        }else{
                          echo "<script> alert('You need to login first');location.href='login.html' </script>";
                        }
                          
?>
<?php
  
  print <<<EOT

                  </tbody>
                </table>
              </div>
            </div>
            
            
        </div>

        <div id="nav">
            <public-header></public-header>
        </div> 

        <div class="content-box">
            <br/><br/><br/><br/>
            <div class="container" style="width: 100%">
            <h3><font color="white">Search Flight</font></h3>
              <div class="row" style="width: 99%; margin:0 auto;">
                <table class="search-table">
                  <tr>
                    <td class="search-table-td">
                      <br/>
                      <form class="form-horizontal" role="form" action="staff_view.php" method="post">
                        <font class="login-subtitle">Start Date:</font><br/>
                        <div class="form-group">
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="start" name="start" placeholder="Please enter Start Date">
                          </div>
                        </div>
                        <font class="login-subtitle">End Date:</font><br/>
                        <div class="form-group">
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="end" name="end" placeholder="Please enter End Date">
                          </div>
                        </div>
                        <br/><br/>
                        <div class="form-group">
                          <div class="col-sm-10">
                            <button type="submit" class="btn btn-default">
                              <font class="login-subtitle">Search</font>
                            </button>
                          </div>
                        </div>
                      </form>
                    </td>
                  </tr>
                </table>
              </div>
              <br/><br/>
              <div class="row" style="width: 99%; margin:0 auto;">
                <table class="table table-hover view-table" >
                  <thead style="background-color: #a1a1a1">
                    <tr>
                      <th class="view-table-head">Flight ID</th>
                      <th class="view-table-head">Departure Time</th>
                      <th class="view-table-head">Airline</th>
                      <th class="view-table-head">Airplane</th>
                      <th class="view-table-head">Departure Airport</th>
                      <th class="view-table-head">Arrival Airport</th>
                      <th class="view-table-head">Arrival Time</th>
                      <th class="view-table-head">Price</th>
                      <th class="view-table-head">Status</th>
                      <th class="view-table-head"></th>
                      <th class="view-table-head"></th>
                    </tr>
                  </thead>
                  <tbody>
                    
                      </form>
EOT;
?>
<?PHP
                          $conn = new mysqli("localhost","solidifiedray","Ray826589!","solidifiedray") or die("Connect failed: %s\n". $conn -> error);
                          if($_SESSION["username"]){
                              $username = $_SESSION["username"];
                              $start = $_POST["start"];
                              $end = $_POST["end"];

                              if(!empty($_POST["start"])||!empty($_POST["end"])){
                                  $sql = "SELECT * FROM Flight F natural join Staff S WHERE S.user_name = '{$username}' and 
                                  cast(F.d_date_time as datetime) between cast('{$start}' as datetime) and cast('{$end}' as datetime)";
                              
                              $result = $conn->query($sql);
                              if ($result-> num_rows>0){
                              while ($row = $result -> fetch_assoc()){
                                  $price = $row["base_price"];
                                  echo "<tr>
                                          <td class='view-table-td'>".$row["f_id"]."</td>
                                          <td class='view-table-td'>".$row["d_date_time"]."</td>
                                          <td class='view-table-td'>".$row["al_name"]."</td>
                                          <td class='view-table-td'>".$row["ap_id"]."</td>
                                          <td class='view-table-td'>".$row["d_airport"]."</td>
                                          <td class='view-table-td'>".$row["a_airport"]."</td>
                                          <td class='view-table-td'>".$row["a_date_time"]."</td>
                                          <td class='view-table-td'>".number_format($price, 2, '.', ' ')."</td><td>".$row["status"]."</td>
                                          <td class='view-table-td'><a href='cust_table.php?f_id=".$row["f_id"]."&d_date_time=".$row["d_date_time"]."'>"."View Customer"."</a></td>
                                      </tr>";
                                  }
                              echo "</table>";
                              }
                              else{
                                  echo "0";
                                  }
                              $conn->close();
                              }
                          }
                          else{
                              echo "<script> alert('You need to login first');location.href='login.html' </script>";
                            }
?>

<?php
  
  print <<<EOT
                  </tbody>
                </table>
                <a href="staff.php">
                  <font class="login-text"> <object align="right">
                  <u>BACK</u>
                  </font>  
                </a>
              </div>
            </div>
            
            <br/><br/><br/><br/><br/><br/><br/>
        </div>

        <!-- jQuery (Bootstrap 的 JavaScript 插件需要引入 jQuery) -->
        <script src="https://code.jquery.com/jquery.js"></script>
        <script src="components/navigation.js"></script>
     </body>
  </html>
EOT;
?>