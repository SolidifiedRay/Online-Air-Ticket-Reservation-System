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
              <h3>Flights & Ratings</h3>
                <thead style="background-color: #a1a1a1">
                  <tr>
                    <th class="view-table-head">Flight Number</th>
                    <th class="view-table-head">Average Rating</th>
                    <th class="view-table-head">Flight Comment</th>
                  </tr>
                </thead>
                <tbody>
                  
                    </form>

                    <?PHP
                      session_start();
                      if($_SESSION["username"]){
                        $conn = new mysqli("localhost","root","","Air_Ticket_Reservation_System") or die("Connect failed: %s\n". $conn -> error);
                        $username = $_SESSION["username"];
                        $sql = "SELECT R.f_id, AVG(rate),R.d_date_time as average_rate 
                                FROM Rating R Natural Join Flight F Natural Join Staff S
                                Where S.user_name = '{$username}'
                                Group BY f_id";                        
                        $result = $conn->query($sql);

                        if ($result-> num_rows>0){
                          while ($row = $result -> fetch_assoc()){
                            
                            echo "<tr>
                                      <td class='view-table-td'>".$row["f_id"]."</td>
                                      <td class='view-table-td'>".$row["average_rate"]."</td>
                                      <td class='view-table-td'><a href='rating_view.php?f_id=".$row["f_id"]."'/>View Comments</a>
                                      
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



              <h3>Comment Section</h3>
              <table class="table table-hover view-table" >
                <thead style="background-color: #a1a1a1">
                  <tr>
                    <th class="view-table-head">Flight Number</th>
                    <th class="view-table-head">Departure Date</th>
                    <th class="view-table-head">Comments</th>
                  </tr>
                </thead>
                <tbody>
                  
                    </form>

                    <?PHP
                      if($_SESSION["username"]){
                        $conn = new mysqli("localhost","root","","Air_Ticket_Reservation_System") or die("Connect failed: %s\n". $conn -> error);
                        $username = $_SESSION["username"];
                        $f_id = $_GET["f_id"]??'';
                        if (!empty($f_id)){
                            $sql = "SELECT * FROM Rating Where f_id = '{$f_id}'";
                            //"SELECT R.f_id, R.d_date_time,R.comment
                            //FROM Rating R Natural Join Flight F Natural Join Staff S
                            //Where S.user_name = '{$username}'
                            //Group BY f_id";                        
                            $result = $conn->query($sql);

                            if ($result-> num_rows>0){
                            while ($row = $result -> fetch_assoc()){
                                
                                echo "<tr>
                                        <td class='view-table-td'>".$row["f_id"]."</td>
                                        <td class='view-table-td'>".$row["d_date_time"]."</td>
                                        <td class='view-table-td'>".$row["comment"]."</td>
                                        
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
              
              </a>
            </div>
          </div>
          <a href="staff.php">
                <font class="login-text"> <object align="right">
                <u>BACK</u>
                </font>  
          
          
          <br/><br/><br/><br/><br/><br/><br/>
      </div>

      <!-- jQuery (Bootstrap 的 JavaScript 插件需要引入 jQuery) -->
      <script src="https://code.jquery.com/jquery.js"></script>
      <script src="components/navigation.js"></script>
   </body>
</html>
