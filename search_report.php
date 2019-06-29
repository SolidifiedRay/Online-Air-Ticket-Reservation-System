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
                  
      </div>
        <div id="nav">
            <public-header></public-header>
        </div> 
        <div class="content-box">
            <br/><br/><br/><br/>
            <div class="container" style="width: 100%">
            <h3>Check Number of Ticket Sold (Monthly)</h3>
              <div class="row" style="width: 99%; margin:0 auto;">
                <table class="search-table">
                  <tr>
                    <td class="search-table-td">
                      <br/>
                      <form class="form-horizontal" role="form" action="search_report.php" method="post">
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
                      </tbody>
                </table>
<?php
    session_start();
    $conn = new mysqli("localhost","root","","Air_Ticket_Reservation_System") or die("Connect failed: %s\n". $conn -> error);
    if($_SESSION["username"]){
        $conn = new MySQLi("localhost","root","","Air_Ticket_Reservation_System");
        $username = $_SESSION["username"];
        $start = $_POST["start"]??'';
        $end = $_POST["end"]??'';
        if(!empty($_POST["start"])||!empty($_POST["end"])){
            $dataPoints3 = array();
            $sql3 = "SELECT MONTHNAME(cast(F.d_date_time as datetime)) as mon, count(t_id) as num 
                    FROM Staff S NATURAL JOIN Flight F NATURAL JOIN Ticket T
                    WHERE S.user_name = '{$username}' 
                    and cast(F.d_date_time as datetime) BETWEEN cast('{$start}' as datetime) and cast('{$end}' as datetime)
                    Group by mon";
            $result3 = $conn->query($sql3);
            while ($row3 = $result3 -> fetch_assoc()) {
                $dataPoints3[] = array('label'=>$row3['mon'], 'y'=>$row3['num']);
            }  
            $conn->close();
        }
    }
?>  
<script>
      window.onload = function() {
        var chart3 = new CanvasJS.Chart("chartContainer3",{
            animationEnabled: true,
                title:{
                    text: "TOTAL NUMBER OF TICKET SOLD LAST YEAR"
                },
                axisY: {
                    title: "Number"
                },

        data: [{
            type: "bar",
            yValueFormatString: "",
            indexLabel: "{y}",
            indexLabelPlacement: "inside",
            indexLabelFontWeight: "bolder",
            indexLabelFontColor: "white",
            dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart3.render();

 }</script>
   </head>
   <body background="img/background.jpg" class="index-background">

      <div id="nav">
          <public-header></public-header>
      </div> 
      <div class="content-box">
          <br/><br/><br/><br/>
          <div class="container" style="width: 100%">
            <div class="row" style="width: 99%; margin:0 auto;">
              <div id="chartContainer3" style="height: 370px; width: 100%;"></div>
            </div>
          </div>
                <a href="progress_report.php".php">
                  <font class="login-text"> <object align="right">
                  <u>BACK</u>
                  </font>  
                </a>
              </div>
            </div>             

      <!-- jQuery (Bootstrap 的 JavaScript 插件需要引入 jQuery) -->
      <script src="https://code.jquery.com/jquery.js"></script>
      <script src="components/navigation.js?v=1.1"></script>
      <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
   </body>
</html>

