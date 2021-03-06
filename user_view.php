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
                      <th class="view-table-head">price</th>
                      <th class="view-table-head">status</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                      </form>

EOT;
?>
<?php
                        session_start();
                        if($_SESSION["username"]){
                          $conn = new MySQLi("localhost","solidifiedray","Ray826589!","solidifiedray") or die("Connect failed: %s\n". $conn -> error);
                          $email = $_SESSION["username"];
                          $date_time = $_SERVER['REQUEST_TIME'];
                          $sql = "SELECT * FROM Flight F Natural Join Ticket T WHERE T.c_email = '{$email}' and cast(T.d_date_time as datetime) >= now()";                        
                          $result = $conn->query($sql);
                          if ($result-> num_rows>0){
                            while ($row = $result -> fetch_assoc()){

                                $price = $row["sold_price"];

                              //END
                              echo "<tr>
                                        <td class='view-table-td'>".$row["f_id"]."</td>
                                        <td class='view-table-td'>".$row["d_date_time"]."</td>
                                        <td class='view-table-td'>".$row["al_name"]."</td>
                                        <td class='view-table-td'>".$row["ap_id"]."</td>
                                        <td class='view-table-td'>".$row["d_airport"]."</td>
                                        <td class='view-table-td'>".$row["a_airport"]."</td>
                                        <td class='view-table-td'>".$row["a_date_time"]."</td>
                                        <td class='view-table-td'>".number_format($price, 2, '.', ' ')."</td>
                                        <td class='view-table-td'>".$row["status"]."</td>

                                    </tr>";
                                }
                            echo "</table>";
                          }
                          $conn->close();
                        }else{
                          echo "<script> alert('You need to login first');location.href='login.html' </script>";
                        }
                          
EOT;
?>
<?php
  print <<<EOT
                  </tbody>
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
