<?php
    session_start();
    $conn = new mysqli("localhost","solidifiedray","Ray826589!","solidifiedray") or die("Connect failed: %s\n". $conn -> error);
    if($_SESSION["username"]){
        $username = $_SESSION["username"];
        $conn = new MySQLi("localhost","solidifiedray","Ray826589!","solidifiedray");
        //check last six month
        $dataPoints = array();
        $sql = "SELECT MONTHNAME(cast(T.purchase_date_time as datetime)) as mon, SUM(sold_price) as num 
                FROM Ticket T WHERE T.c_email = '{$username}' 
                and MONTH(cast(T.purchase_date_time as datetime)) between MONTH(CURDATE())-6 AND MONTH(CURDATE())
                Group by mon";
        $result = $conn->query($sql);
        while ($row = $result -> fetch_assoc()) {
            $dataPoints[] = array('label'=>$row['mon'], 'y'=>$row['num']);
        }
        //check last year
        $dataPoints2 = array();
        $sql2 = "SELECT SUM(sold_price) as num 
                 FROM Ticket T WHERE T.c_email = '{$username}' 
                 and YEAR(cast(T.purchase_date_time as datetime)) = YEAR(CURDATE())-1";
        $result2 = $conn->query($sql2);
        while ($row2 = $result2 -> fetch_assoc()) {
            $total_amt = $row2['num'];
        }

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
        var chart1 = new CanvasJS.Chart("chartContainer1",{
            animationEnabled: true,
                title:{
                    text: "Amount Spent Last Six Month"
                },
                axisY: {
                    title: "Amount"
                },

        data: [{
            type: "bar",
            yValueFormatString: "",
            indexLabel: "{y}",
            indexLabelPlacement: "inside",
            indexLabelFontWeight: "bolder",
            indexLabelFontColor: "white",
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
    });
        chart1.render();

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
                <?php echo "<font class='login-text'>Total Amount Spent Last Year</font><br/>"; ?>
              <?php echo "<font class='login-text'>Total: $".$total_amt." </font><br/>"; ?>
              <div id="chartContainer1" style="height: 370px; width: 100%;"></div>
            </div>
            <br/><br/>
            <a href="search_spending.php">
              <font class="login-text"> <object align="right">
              <u>SEARCH</u>
              </font>  
            </a>
            <br/>
            <a href="user.php">
              <font class="login-text"> <object align="right">
              <u>BACK</u>
              </font>  
            </a>
            <br/><br/>
          </div>
      </div>             

      <!-- jQuery (Bootstrap 的 JavaScript 插件需要引入 jQuery) -->
      <script src="https://code.jquery.com/jquery.js"></script>
      <script src="components/navigation.js?v=1.1"></script>
      <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
   </body>
</html>

