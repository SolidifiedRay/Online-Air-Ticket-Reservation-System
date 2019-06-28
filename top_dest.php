
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
          <h3>Top 3 Destination for Last Three Month</h3>
        </div>
            <div class="row" style="width: 99%; margin:0 auto;">
              <table class="table table-hover view-table" >
                <thead style="background-color: #a1a1a1">
                
                <tr>
                    <th class="view-table-head">Airport ID</th>
                    <th class="view-table-head">City</th>
                </tr>
                </thead>
                <tbody>

EOT;
?>

                <?PHP
                  session_start();
                  $conn = new mysqli("localhost","root","","Air_Ticket_Reservation_System") or die("Connect failed: %s\n". $conn -> error);
                  if($_SESSION["username"]){
                    $username = $_SESSION["username"];
                    $conn = new MySQLi("localhost","root","","Air_Ticket_Reservation_System");
                    $sql = "SELECT TOP 3 COUNT(T.t_id) as countnum, F.a_airport, A.city
                             FROM Staff S NATURAL JOIN Flight F NATURAL JOIN Ticket T, Airport A
                             WHERE A.airport_name = F.a_airport and S.user_name = '{$username}' 
                             and Month(cast(F.d_date_time as datetime)) between Month(CURDATE())-3 and Month(CURDATE())
                             GROUP BY F.a_airport
                             ORDER BY countnum DESC
                             LIMIT 3";
                    $result = $conn->query($sql);
                    if ($result-> num_rows>0){
                    while ($row = $result -> fetch_assoc()){
                        echo "<tr>
                                  <td class='view-table-td'>".$row["a_airport"]."</td>
                                  <td class='view-table-td'>".$row["city"]."</td>
                            </tr>";
                        }
                    echo "</table>";
                    }
                    else{
                        echo "Flight Unfound";
                        }
                    $conn->close();
                    }
                  
                  else{
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



    <div class="content-box">
    <br/><br/><br/><br/>
    <div class="container" style="width: 100%">
          <h3>Top 3 Destination Last Year</h3>
        </div>
            <div class="row" style="width: 99%; margin:0 auto;">
              <table class="table table-hover view-table" >
                <thead style="background-color: #a1a1a1">
                
                <tr>
              <th class="view-table-head">Airport ID</th>
              <th class="view-table-head">City</th>
            </tr>
          </thead>
          <tbody>
            
              </form>
EOT;
?>

              <?PHP
                  $conn = new mysqli("localhost","root","","Air_Ticket_Reservation_System") or die("Connect failed: %s\n". $conn -> error);
                  if($_SESSION["username"]){
                    $username = $_SESSION["username"];
                    $conn = new MySQLi("localhost","root","","Air_Ticket_Reservation_System");
                    $sql = "SELECT COUNT(T.t_id) as countnum, F.a_airport, A.city
                             FROM Staff S NATURAL JOIN Flight F NATURAL JOIN Ticket T, Airport A
                             WHERE A.airport_name = F.a_airport and S.user_name = '{$username}' 
                             and Year(cast(F.d_date_time as datetime)) = Year(CURDATE())
                             GROUP BY F.a_airport
                             ORDER BY countnum DESC
                             Limit 3";
                    $result = $conn->query($sql);
                    if ($result-> num_rows>0){
                    while ($row = $result -> fetch_assoc()){
                        echo "<tr>
                                  <td class='view-table-td'>".$row["a_airport"]."</td>
                                  <td class='view-table-td'>".$row["city"]."</td>
                            </tr>";
                        }
                    echo "</table>";
                    }
                    else{
                        echo "Flight Unfound";
                        }
                    $conn->close();
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

      <!-- jQuery (Bootstrap 的 JavaScript 插件需要引入 jQuery) -->
      <script src="https://code.jquery.com/jquery.js"></script>
      <script src="components/navigation.js"></script>
   </body>
</html>
EOT;
?>
