<?php
$n=50; 
    function getName($n) { 
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'; 
        $randomString = ''; 
      
        for ($i = 0; $i < $n; $i++) { 
            $index = rand(0, strlen($characters) - 1); 
            $randomString .= $characters[$index]; 
        } 
      
        return $randomString; 
    }
 $randomtoken = getName($n);

 $sql = "SELECT * FROM member";
 $result = $conn->query($sql);





$token = $_GET["token"];
$showtoken = $conn->query("SELECT * FROM member WHERE token = '$token' ");
while ($row = $showtoken->fetch_array()) {
  $id = $row["id"];
  $point = $row["point"];
  $name = $row["name"];
  $lastname = $row["lastname"];
  $user_status = $row["user_status"];
  $role = $row["role"];
}



$showtotal = $conn->query("SELECT * FROM total WHERE id = '1' ");
while ($row = $showtotal->fetch_array()) {
  $branch = $row["branch"];
  $sum = $row["sum"];
  $machinename = $row["machine_name"];
  $all = $row["all"];

}


$showtotal2 = $conn->query("SELECT * FROM total WHERE id = '2' ");
while ($row = $showtotal2->fetch_array()) {
  $branch2 = $row["branch"];
  $sum2 = $row["sum"];
  $machinename2 = $row["machine_name"];
  $all2 = $row["all"];

}

$tokencheck = $conn->query("SELECT *FROM member WHERE token = '$token' ");
if($tokencheck->num_rows <= 0){
  unset($_SESSION['online']);
    $_SESSION["swal"] = "notify";
    $title ="Token ไม่ถูกต้อง";
    $text = "กรุณาลองใหม่อีกครั้ง";
    $icon ="error";
    $button = "ตกลง";
    $link = "./?app=home";
}else{
    if($role == "0"){
      unset($_SESSION['online']);
      $_SESSION["swal"] = "notify";
         $title ="ไม่มีสิทธิ์เข้าถึงหน้านี้..";
         $icon ="error";
         $link = "./?app=home";}
         else{

          $sql_list = $conn->query("SELECT count(user_status) as count,user_status FROM member GROUP BY user_status"); //หาว่ามี user กี่คน
          while($row = $sql_list->fetch_array()){
          $user_status = $row["user_status"];
          $user_num = $row["count"];
          }
          
          






           
         



        
        }
}


?>

<div class="row">
<div class="col-1 "></div>
  <div class="col-10 bg-dark text-white">
    <br>
    <center><h3>ระบบจัดการฐานข้อมูลของ P.G.R. Machine</h3><center>
  
  <br>
  </div>
  <div class="col-1 "></div>
  </div>

<div class="row">
<div class="col-1 "></div>
  <div class="col-2 bg-dark" style="height:800px">
  <br>
  <hr color="#FFFFFF">
  <center><h5><font color="#FFFFFF"><?php echo $name;?> <?php echo $lastname;?> </font>&nbsp; <span class="badge badge-pill badge-warning">ADMIN</span> </h5></center>
  <hr color="#FFFFFF">
  <br>
  <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
  <a class="nav-link active btn-outline-light" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Home</a><br>
  <a class="nav-link btn-outline-light" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Member</a><br>
  <a class="nav-link btn-outline-light" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</a><br>
  <a class="nav-link btn-outline-light" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</a><br><br>
  <a href="./?app=logout" class="btn btn-danger btn-lg" role="button" aria-pressed="true">ออกจากระบบ</a></center>
</div>
  </div>
  <div class="col-8  bg-secondary text-white">
    <br>
  <div class="tab-content" id="v-pills-tabContent">
  <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
  
  <div class="col-1 "></div>


<div class="container">
<hr color="#FFFFFF">
<center><h2>Dashboard</h2></center>
<hr color="#FFFFFF">
<br>
<div class="row">
  <div class="col-4">

  <div class="card text-white bg-primary">
<div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
<div>
<div class="text-value-lg">
  <?php if($user_status == "member"){
echo $user_num ;
}else{
echo "0";
} ?>
</div>
<div>Members</div>
<br>
</div></div></div>


  </div>
  <div class="col-4">


  <div class="card text-white bg-danger">
<div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
<div>
<div class="text-value-lg"><?php echo $sum;?>&nbsp;/ 200 ใบ </div>
<div>เครื่อง : <?php echo $machinename;?></div>

<br>
</div></div></div>
    
  </div>
  <div class="col-4">
    

  <div class="card text-white bg-danger">
<div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
<div>
<div class="text-value-lg"><?php echo $sum2;?>&nbsp;/ 200 ใบ </div>
<div>เครื่อง : <?php echo $machinename2;?></div>
<br>
</div></div></div>


  </div>
  </div></div>
   



<div class="row">
  <div class="col-12 ">

<center>
<br>
  <div id="piechart"></div></center>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

  <script type="text/javascript">
  
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Task', 'Hours per Day'],
  ['PGR01 <?php echo "ทั้งหมด:$all ใบ";?>', <?php echo $all;?>],
  ['PGR02 <?php echo "ทั้งหมด:$all2 ใบ";?>', <?php echo $all2;?>],

]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'ข้อมูลจากทุกเครื่อง ', 'width':850, 'height':400 };

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script> 






  </div></div>




  </div>
  <!--หน้าที่2-->
  <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">

  <div class="container">
<div class="row">
  <div class="col-12 ">
  <hr color="#FFFFFF">
<center><h3>จัดการสมาชิก</h3></center>
<hr color="#FFFFFF">



  <table class="table table-hover table-dark">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Lastname</th>
      <th scope="col">Email</th>
      <th scope="col">Username</th>
      <th scope="col">Status</th>
      <th scope="col">Point</th>
      <th scope="col">Setting</th>
    </tr>
  </thead>
  <tbody>
    <tr>
    <?php while($row = $result->fetch_assoc()): ?>
      <th scope="row"><?php echo $row['id']; ?></th>
      <td><?php echo $row['name']; ?></td>
      <td><?php echo $row['lastname']; ?></td>
      <td><?php echo $row['email']; ?></td>
      <td><?php echo $row['username']; ?></td>
      <td><?php echo $row['user_status']; ?></td>
      <td><?php echo $row['point']; ?></td>
      <td><button type="button" class="btn btn-success">แก้ไข</button>&nbsp;
      <a href='.?app=del&id=" <?php echo $row['id'] ; ?>"' class="btn btn-danger" role="button" aria-pressed="true">ลบ</a>
    </td>
    </tr>
    <?php endwhile ?>
  </tbody>
</table>                                  href='.?app=del&id=".$row['id']."'


 </div>
  </div></div>



  </div> <!--หน้าที่2-->
  <!--หน้าที่3-->
  <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">.3..</div><!--หน้าที่3-->
  <!--หน้าที่4-->
  <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">..4.</div><!--หน้าที่4-->
</div>
  </div>
  </div>






