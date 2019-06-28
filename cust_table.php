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
          <h3>Customer</h3>
            <div class="row" style="width: 99%; margin:0 auto;">
              <table class="table table-hover view-table" >
                <thead style="background-color: #a1a1a1">
                  <tr>
                    <th class="view-table-head">Ticket ID</th>
                    <th class="view-table-head">Email</th>
                    <th class="view-table-head">Name</th>
                    <th class="view-table-head">Building Name</th>
                    <th class="view-table-head">Stree</th>
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
                  
                    </form>

                    <?PHP
                      session_start();
                      if($_SESSION["username"]){
                        $conn = new mysqli("localhost","root","","Air_Ticket_Reservation_System") or die("Connect failed: %s\n". $conn -> error);
                        $username = $_SESSION["username"];
                        $flight_num = $_GET["f_id"];
                        $d_date = $_GET["d_date_time"];
                        $sql = "SELECT T.t_id, C.* FROM Customer C Natural Join Ticket T Natural Join Flight F 
                                Where F.f_id = '{$flight_num}' and F.d_date_time = '{$d_date}'";                        
                        $result = $conn->query($sql);

                        if ($result-> num_rows>0){
                          while ($row = $result -> fetch_assoc()){
                            
                            
                            //END
                            echo "<tr>
                                      <td class='view-table-td'>".$row["t_id"]."</td>
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
                        }
                        
                      }else{
                        echo "<script> alert('You need to login first');location.href='login.html' </script>";
                      }
                        
                    ?>
                </tbody>
              </table>
              <a href="staff_view.php">
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
