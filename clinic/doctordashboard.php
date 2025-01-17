<?php
session_start();
include_once '../assets/conn/dbconnect.php';
if(!isset($_SESSION['doctorSession']))
{
header("Location: ../index.php");
}
$usersession = $_SESSION['doctorSession'];
$res=mysqli_query($con,"SELECT * FROM doctor WHERE doctorId=".$usersession);
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);



?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <style>
      table {
        border-collapse: collapse;
        width: 100%;
        color: #588c7e;
        font-family: monospace;
        font-size: 12px;
        text-align: left;
      }
      th {
        background-color: #588c7e;
        color: white;
      }
      tr:nth-child(even){background-color: #f2f2f2;}
    </style>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
<div class="sidebar">
    <div class="logo-details">
        <div class="logo_name">WCHC Clinic</div>
        <i class='bx bx-menu' id="btn" ></i>
    </div>
    <ul class="nav-list">
      <li>
         <a href="doctordashboard.php">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Dashboard</span>
        </a>
         <span class="tooltip">Dashboard</span>
      </li>
      <li>
       <a href="addschedule.php">
       <i class='bx bxs-calendar' ></i>
         <span class="links_name">Schedule</span>
       </a>
       <span class="tooltip">Schedule</span>
     </li>
     <li>
       <a href="patientlist.php">
       <i class='bx bx-user-pin'></i>
         <span class="links_name">Patient List</span>
       </a>
       <span class="tooltip">Patient List</span>
     </li>
     <li>
         <a href="doctorprofile.php">
         <i class='bx bx-user'></i>
          <span class="links_name">Staff Profile</span>
        </a>
         <span class="tooltip">Staff Profile</span>
      </li>
     <li class="profile">
         <div class="profile-details">
           <!--<img src="profile.jpg" alt="profileImg">-->
           <div class="name_job">
           </div>
         </div>
         <a href="logout.php?logout"><i class='bx bx-log-out' id="log_out" ></i></a>
     </li>
    </ul>
  </div>
  <section class="home-section">

                <h2>
                Dashboard
                </h2>
              
    
            <h3>Appointment List</h3>

            <table>
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Contact No.</th>
                        <th>Email</th>
                        <th>Day</th>
                        <th>Date</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Status</th>
                        <th>Complete</th>
                    </tr>
                </thead>
                
                <?php 
                $res=mysqli_query($con,"SELECT a.*, b.*,c.*
                                        FROM patient a
                                        JOIN appointment b
                                        On a.icPatient = b.patientIc
                                        JOIN doctorschedule c
                                        On b.scheduleId=c.scheduleId
                                        Order By appId desc");
                      if (!$res) {
                        printf("Error: %s\n", mysqli_error($con));
                        exit();
                    }
                while ($appointment=mysqli_fetch_array($res)) {
                    
                    if ($appointment['status']=='process') {
                        $status="danger";
                        $icon='remove';
                        $checked='';

                    } else {
                        $status="success";
                        $icon='ok';
                        $checked = 'disabled';
                    }

                    echo "<tbody>";
                    echo "<tr>";
                        echo "<td>" . $appointment['patientFirstName'] . "</td>";
                        echo "<td>" . $appointment['patientLastName'] . "</td>";
                        echo "<td>" . $appointment['patientPhone'] . "</td>";
                        echo "<td>" . $appointment['patientEmail'] . "</td>";
                        echo "<td>" . $appointment['scheduleDay'] . "</td>";
                        echo "<td>" . $appointment['scheduleDate'] . "</td>";
                        echo "<td>" . $appointment['startTime'] . "</td>";
                        echo "<td>" . $appointment['endTime'] . "</td>";
                        echo "<td>" . $appointment['status'] . "</td>";
                        echo "<form method='POST'>";
                        echo "<td ><input type='checkbox' name='enable' id='enable' value='".$appointment['appId']."' onclick='chkit(".$appointment['appId'].",this.checked);' ".$checked."></td>";

                    
                } 
                    echo "</tr>";
                echo "</tbody>";
            echo "</table>";
            echo "<div>";
            echo "<div>";
            echo "<button type='submit' value='Submit' name='submit'>Update</button>";
            echo "</div>";
            echo "</div>";
            ?>
  </section>
                    <!-- panel end -->
<script type="text/javascript">
function chkit(uid, chk) {
   chk = (chk==true ? "1" : "0");
   var url = "checkdb.php?userid="+uid+"&chkYesNo="+chk;
   if(window.XMLHttpRequest) {
      req = new XMLHttpRequest();
   } else if(window.ActiveXObject) {
      req = new ActiveXObject("Microsoft.XMLHTTP");
   }
   // Use get instead of post.
   req.open("GET", url, true);
   req.send(null);
}
</script>


 
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->
        </div>



          <script>
          let sidebar = document.querySelector(".sidebar");
          let closeBtn = document.querySelector("#btn");
          let searchBtn = document.querySelector(".bx-search");

          closeBtn.addEventListener("click", ()=>{
            sidebar.classList.toggle("open");
            menuBtnChange();//calling the function(optional)
          });

          searchBtn.addEventListener("click", ()=>{ // Sidebar open when you click on the search iocn
            sidebar.classList.toggle("open");
            menuBtnChange(); //calling the function(optional)
          });

          // following are the code to change sidebar button(optional)
          function menuBtnChange() {
          if(sidebar.classList.contains("open")){
            closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the iocns class
          }else {
            closeBtn.classList.replace("bx-menu-alt-right","bx-menu");//replacing the iocns class
          }
          }
          </script>

    </body>
</html>