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
              <table class="search-table">
                <tr>
                  <td class="search-table-td">
                    <br/>
                    <form class="form-horizontal" role="form" action="search.php" method="post">
                      <font class="login-subtitle">Departure Airport:</font><br/>
                      <div class="form-group">
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="d_airport" name="d_airport" placeholder="Please enter departure airport">
                        </div>
                      </div>
                      <font class="login-subtitle">Arrival Airport:</font><br/>
                      <div class="form-group">
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="a_airport" name="a_airport" placeholder="Please enter arrival ariport">
                        </div>
                      </div>
                      <font class="login-subtitle">Departure Date:</font><br/>
                      <div class="form-group">
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="d_date" name="d_date" placeholder="Please enter departure date">
                        </div>
                      </div>
                      <font class="login-subtitle">Return Date:</font><br/>
                      <div class="form-group">
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="r_date" name="r_date" placeholder="Please enter return date if you want to search round trip or leave it blank">
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
                    <th class="view-table-head">price</th>
                    <th class="view-table-head">status</th>
                    <th class="view-table-head"></th>
                    <th class="view-table-head"></th>
                  </tr>
                </thead>
                <tbody>
                  
                    </form>

                    <?PHP
                        $conn = new mysqli("localhost","solidifiedray","Ray826589!","solidifiedray") or die("Connect failed: %s\n". $conn -> error);

                        $d_airport = $_POST["d_airport"];
                        $a_airport = $_POST["a_airport"];
                        $d_date = $_POST["d_date"];
                        $r_date = $_POST["r_date"];

                        if(!empty($_POST["d_airport"])){
                        $sql = "SELECT * FROM Flight WHERE 
                        (d_airport = '{$d_airport}' and a_airport = '{$a_airport}' and d_date_time like'%{$d_date}%'
                        or a_airport = '{$d_airport}' and d_airport = '{$a_airport}' and d_date_time like'%{$r_date}%')";


                        $result = $conn->query($sql);
                        if ($result-> num_rows>0){
                        while ($row = $result -> fetch_assoc()){
                            $sql1 = "SELECT seat FROM Flight NATURAL JOIN Airplane WHERE f_id = '{$row["f_id"]}'";
                            $conn1 = $conn->query($sql1);
                            $tot_ticket = mysqli_fetch_array($conn1);
            
                            $sql2 = "SELECT COUNT(t_id) FROM Flight NATURAL JOIN Ticket WHERE f_id = '{$row["f_id"]}' and d_date_time='{$row["d_date_time"]}'";
                            $conn2 = $conn->query($sql2);
                            $num_sold = mysqli_fetch_array($conn2);

                            if ($num_sold[0] != 0){
                              $price = ($tot_ticket[0]/$num_sold[0] > 0.7)?1.2*$row["base_price"]:$row["base_price"];
                            }else{
                              $price = $row["base_price"];
                            }

                            
                            echo "<tr>
                                      <td class='view-table-td'>".$row["f_id"]."</td>
                                      <td class='view-table-td'>".$row["d_date_time"]."</td>
                                      <td class='view-table-td'>".$row["al_name"]."</td>
                                      <td class='view-table-td'>".$row["ap_id"]."</td>
                                      <td class='view-table-td'>".$row["d_airport"]."</td>
                                      <td class='view-table-td'>".$row["a_airport"]."</td>
                                      <td class='view-table-td'>".$row["a_date_time"]."</td>
                                      <td class='view-table-td'>".number_format($price, 2, '.', ' ')."</td><td>".$row["status"]."</td>
                                      <td class='view-table-td'>"."View Comment"."</td>
                                      <td class='view-table-td'>"."Purchase"."</td>
                                  </tr>";
                            }
                        echo "</table>";
                        }
                        else{
                            echo "0";
                            }
                        $conn->close();
                        }
                    ?>
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
