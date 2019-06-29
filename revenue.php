<?php
session_start();
$conn = new mysqli("localhost","solidifiedray","Ray826589!","solidifiedray") or die("Connect failed: %s\n". $conn -> error);
$currentY = date('Y');
$lastyear_S1 = mktime(0, 0, 0, 1, 1,  $currentY-1 );
$lastyear_S2 = mktime(0, 0, 0, 4, 1,  $currentY-1 );
$lastyear_S3 = mktime(0, 0, 0, 7, 1,  $currentY-1 );
$lastyear_S4 = mktime(0, 0, 0, 10, 1,  $currentY-1 );
$lastyear_end = mktime(0, 0, 0, 12, 31,  $currentY-1 );
$s1 = date('Y-m-d',$lastyear_S1);
$s2 = date('Y-m-d',$lastyear_S2);
$s3 = date('Y-m-d',$lastyear_S3);
$s4 = date('Y-m-d',$lastyear_S4);
$end = date('Y-m-d',$lastyear_end);

if($_SESSION["username"]){
    $username = $_SESSION["username"];
    $dataPoints = array();

    $sql1 = "SELECT al_name,count(t_id) as num FROM Ticket Natural Join Staff S WHERE S.user_name = '{$username}' 
       and cast(Ticket.purchase_date_time as datetime) between '{$s1}' and '{$s2}' Group by al_name";
    $result1 = $conn->query($sql1);
    $row1 = $result1 -> fetch_assoc();

    $sql2 = "SELECT al_name,count(t_id) as num FROM Ticket Natural Join Staff S WHERE S.user_name = '{$username}' 
       and cast(Ticket.purchase_date_time as datetime) between '{$s2}' and '{$s3}' Group by al_name";
    $result2 = $conn->query($sql2);
    $row2 = $result2 -> fetch_assoc();

    $sql3 = "SELECT al_name,count(t_id) as num FROM Ticket Natural Join Staff S WHERE S.user_name = '{$username}' 
       and cast(Ticket.purchase_date_time as datetime) between '{$s3}' and '{$s4}' Group by al_name";
    $result3 = $conn->query($sql3);
    $row3 = $result3 -> fetch_assoc();

    $sql4 = "SELECT al_name,count(t_id) as num FROM Ticket Natural Join Staff S WHERE S.user_name = '{$username}' 
       and cast(Ticket.purchase_date_time as datetime) between '{$s4}' and '{$end}' Group by al_name";
    $result4 = $conn->query($sql4);
    $row4 = $result4 -> fetch_assoc();

    $total_ticket = $row1['num'] + $row2['num'] + $row3['num'] + $row4['num'];
    $q1 = (int)$row1['num'];
    $q2 = (int)$row2['num'];
    $q3 = (int)$row3['num'];
    $q4 = (int)$row4['num'];

    $airline_name =  $row1['al_name'];

    $dataPoints[] = array('label'=>'First Quarter', 'y'=>(($q1/$total_ticket)*100));
    $dataPoints[] = array('label'=>'Second Quarter', 'y'=>(($q2/$total_ticket)*100));
    $dataPoints[] = array('label'=>'Third Quarter', 'y'=>(($q3/$total_ticket)*100));
    $dataPoints[] = array('label'=>'Fourth Quarter', 'y'=>(($q4/$total_ticket)*100));
  }
 
?>

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
      <script>
      window.onload = function() {
       
       
      var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        title: {
          text: "View quarterly revenue earned"
        },
        subtitles: [{
        }],
        data: [{
          type: "pie",
          yValueFormatString: "#,##0.00\"%\"",
          indexLabel: "{label} ({y})",
          dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
      });
      chart.render();
       
      }
      </script>
   </head>
   <body background="img/background.jpg" class="index-background">

      <div id="nav">
          <public-header></public-header>
      </div> 

      <div class="content-box">
          <br/><br/><br/><br/>
          <div class="container" style="width: 100%">
            <div class="row" style="width: 99%; margin:0 auto;">
              <?php echo "<font class='login-text'>Ticket sold in last year in ".$airline_name."</font><br/>"; ?>
              <?php echo "<font class='login-text'>Total: ".$total_ticket." Tickets</font><br/>"; ?>
              <?php echo "<font class='login-text'>First Quarter: ".$q1." Tickets</font><br/>"; ?>
              <?php echo "<font class='login-text'>Second Quarter: ".$q2." Tickets</font><br/>"; ?>
              <?php echo "<font class='login-text'>Third Quarter: ".$q3." Tickets</font><br/>"; ?>
              <?php echo "<font class='login-text'>Fourth Quarter: ".$q4." Tickets</font><br/><br/>"; ?>
              <div id="chartContainer" style="height: 370px; width: 100%;"></div>
            </div>
          </div>
          <br/><br/>
          <a href="staff.php">
            <font class="login-text"> <object align="right">
            <u>BACK</u>
            </font>  
          </a>
          <br/><br/><br/><br/><br/><br/><br/>
      </div>

      <!-- jQuery (Bootstrap 的 JavaScript 插件需要引入 jQuery) -->
      <script src="https://code.jquery.com/jquery.js"></script>
      <script src="components/navigation.js?v=1.1"></script>
      <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
   </body>
</html>

