
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
          <h3><font color="white">Frequent Customer (Last Year) Information</font></h3>
        </div>
            <div class="row" style="width: 99%; margin:0 auto;">
              <table class="table table-hover view-table" >
                <thead style="background-color: #a1a1a1">
                
                <tr>
                    <th class="view-table-head">Email</th>
                    <th class="view-table-head">Name</th>
                    <th class="view-table-head">Building Name</th>
                    <th class="view-table-head">Street</th>
                    <th class="view-table-head">City</th>
                    <th class="view-table-head">State</th>
                    <th class="view-table-head">Phone Number</th>
                    <th class="view-table-head">Passport Number</th>
                    <th class="view-table-head">Passport Expiration</th>
                    <th class="view-table-head">Passport Country</th>
                    <th class="view-table-head">Date Of Birth</th>
                </tr>
                </thead>
                <tbody>

EOT;
?>

                    <?PHP
                        session_start();
                        if($_SESSION["username"]){
                            $username = $_SESSION["username"];
                            $conn = new MySQLi("localhost","solidifiedray","Ray826589!","solidifiedray");
                            $sql = "SELECT COUNT(Ticket.t_id) as countnum,Ticket.c_email 
                                    FROM Staff NATURAL JOIN Flight F NATURAL JOIN Ticket 
                                    WHERE Staff.user_name = '{$username}' and
                                    year(cast(F.d_date_time as datetime)) = YEAR(CURDATE())-1
                                    GROUP BY Ticket.c_email 
                                    ORDER BY countnum DESC LIMIT 1";
                            $result = $conn->query($sql);

                            while ($row = $result -> fetch_assoc()){
                                $number = $row["countnum"];
                                $topcust = $row["c_email"];
                            }
                        
                            $sql2 = "SELECT Distinct Customer.*  
                                    FROM Customer 
                                    WHERE Customer.c_email = '{$topcust}'";
                            $result2 = $conn->query($sql2);
                            
                            if ($result2-> num_rows>0){
                            while ($row = $result2 -> fetch_assoc()){
                                echo "<tr>
                                        <td class='view-table-td'>".$row["c_email"]."</td>
                                        <td class='view-table-td'>".$row["c_name"]."</td>
                                        <td class='view-table-td'>".$row["building_name"]."</td>
                                        <td class='view-table-td'>".$row["street"]."</td>
                                        <td class='view-table-td'>".$row["city"]."</td>
                                        <td class='view-table-td'>".$row["state"]."</td>
                                        <td class='view-table-td'>".$row["phone_num"]."</td>
                                        <td class='view-table-td'>".$row["passport_num"]."</td>
                                        <td class='view-table-td'>".$row["passport_expiration"]."</td>
                                        <td class='view-table-td'>".$row["passport_country"]."</td>
                                        <td class='view-table-td'>".$row["date_of_birth"]."</td>
                                    </tr>";
                                }
                            echo "</table>";
                            $conn->close();
                      }else{
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



    <div class="content-box">
    <br/><br/><br/><br/>
    <div class="container" style="width: 100%">
          <h3><font color="white">Flights Taken By Frequent Customer Till Now</font></h3>
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
                  if($_SESSION["username"]){
                    $username = $_SESSION["username"];
                    $conn = new MySQLi("localhost","solidifiedray","Ray826589!","solidifiedray");
                    $sql1 = "SELECT COUNT(Ticket.t_id) as countnum,Ticket.c_email 
                            FROM Staff NATURAL JOIN Flight F NATURAL JOIN Ticket 
                            WHERE Staff.user_name = '{$username}' 
                            and year(cast(F.d_date_time as datetime)) = YEAR(CURDATE())-1
                            GROUP BY Ticket.c_email 
                            ORDER BY countnum DESC LIMIT 1";
                    $result1 = $conn->query($sql1);

                    while ($row = $result1 -> fetch_assoc()){
                        $number = $row["countnum"];
                        $topcust = $row["c_email"];
                    }

                      $sql = "SELECT Flight.* 
                      FROM Ticket Natural Join Staff Natural Join Flight 
                      WHERE Staff.user_name = '{$username}' and Ticket.c_email = '{$topcust}' 
                      and cast(Flight.d_date_time as datetime) < now()";

                      $result = $conn->query($sql);
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
                                    <td class='view-table-td'>".$row["status"]."</td>
                              </tr>";
                          }
                      echo "</table>";
                      }
                      else{
                          }
                      $conn->close();
                      }
                  
                  else{
                      echo "<script> alert('You need to login first');location.href='login.html' </script>";
                    }
              ?>
<?php
  print <<<EOT

  　<br/><br/><br/><br/>
    <div class="container" style="width: 100%">
          <h3><font color="white">All Customer Information</font></h3>
        </div>
            <div class="row" style="width: 99%; margin:0 auto;">
              <table class="table table-hover view-table" >
                <thead style="background-color: #a1a1a1">
                
                <tr>
                <th class="view-table-head">Email</th>
                <th class="view-table-head">Name</th>
                <th class="view-table-head">Building Name</th>
                <th class="view-table-head">Street</th>
                <th class="view-table-head">City</th>
                <th class="view-table-head">State</th>
                <th class="view-table-head">Phone Number</th>
                <th class="view-table-head">Passport Number</th>
                <th class="view-table-head">Passport Expiration</th>
                <th class="view-table-head">Passport Country</th>
                <th class="view-table-head">Date Of Birth</th>
                <th class="view-table-head">View His/Her Flight</th>
            </tr>
          </thead>
          <tbody>
            
              </form>
EOT;
?>

              <?PHP
                  if($_SESSION["username"]){
                    $username = $_SESSION["username"];
                    $conn = new MySQLi("localhost","solidifiedray","Ray826589!","solidifiedray");
                    
                      $sql = "SELECT DISTINCT Customer.* 
                              FROM Staff natural join Ticket, Customer 
                              where Customer.c_email = Ticket.c_email 
                              and staff.user_name = '{$username}'";

                      $result = $conn->query($sql);
                      if ($result-> num_rows>0){
                      while ($row = $result -> fetch_assoc()){
                          echo "<tr>
                            <td class='view-table-td'>".$row["c_email"]."</td>
                            <td class='view-table-td'>".$row["c_name"]."</td>
                            <td class='view-table-td'>".$row["building_name"]."</td>
                            <td class='view-table-td'>".$row["street"]."</td>
                            <td class='view-table-td'>".$row["city"]."</td>
                            <td class='view-table-td'>".$row["state"]."</td>
                            <td class='view-table-td'>".$row["phone_num"]."</td>
                            <td class='view-table-td'>".$row["passport_num"]."</td>
                            <td class='view-table-td'>".$row["passport_expiration"]."</td>
                            <td class='view-table-td'>".$row["passport_country"]."</td>
                            <td class='view-table-td'>".$row["date_of_birth"]."</td>
                            <td class='view-table-td'><a href='frequent.php?c_email=".$row["c_email"]."'/>View Flights</a>
                              </tr>";
                          }
                      echo "</table>";
                      }
                      else{
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



                <h3><font color="white">Flight Information Till Now</font></h3>
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
                    </tr>
                  </thead>
                  <tbody>
                    
                      </form>
EOT;
?>
<?PHP
                        if($_SESSION["username"]){
                          $conn = new MySQLi("localhost","solidifiedray","Ray826589!","solidifiedray");
                          $username = $_SESSION["username"];
                          $email= $_GET["c_email"];
                          if (!empty($_GET["c_email"])){
                              $sql = "SELECT Flight.* 
                                      FROM Ticket Natural Join Staff Natural Join Flight 
                                      WHERE Staff.user_name = '{$username}' and Ticket.c_email = '{$_GET["c_email"]}' 
                                      and cast(Flight.d_date_time as datetime) < now()";                       
                              $result = $conn->query($sql);
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
                                    <td class='view-table-td'>".$row["status"]."</td>
                                          
                                      </tr>";
                                  }
                              echo "</table>";
                              $conn->close();
                              }
                          }
                          
                        }else{
                          echo "<script> alert('You need to login first');location.href='login.html' </script>";
                        }
                          
?>
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


