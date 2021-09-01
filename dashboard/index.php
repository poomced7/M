<?php
include ("./navbar.php");



$token = $_GET["token"];
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

  $_SESSION['online'] = $token;

  $showtoken = $conn->query("SELECT * FROM member WHERE token = '$token' ");
  while ($row = $showtoken->fetch_array()) {
    $id = $row["id"];
    $point = $row["point"];
    $name = $row["name"];
    $lastname = $row["lastname"];
    $user_status = $row["user_status"];
  
  }


  
  
  if($user_status == "admin"){
    $_SESSION["swal"] = "notify";
       $title ="กำลังพาไปยังการจัดการระบบ Admin..";
       $text = "กรุณารอสักครู่...";
       $icon ="settings";
       $link = "./?app=admin&token=$token";
       }else{
  if($user_status == "member"){
  
  }

}
  

}

 
  

?>


<div class="alert alert-info" role="alert">
<center><h3>ยินดีต้อนรับ คุณ <?php echo $name;?> <?php echo $lastname;?> &nbsp;🟢</h3></center>
</div>

<div class="alert alert-success" role="alert">
  <center><h1 class="alert-heading">จำนวนแต้มสะสมของท่านขณะนี้</h1>
  <p> <div id="point"><br><h2>แต้ม</h2></p></div>
  <br>

  <div class="alert alert-secondary" role="alert">
  <p class="mb-0">หากสะสมแต้มครบแล้วสามารถนำไปแลกของรางวัลตามที่ระบุไว้ได้ที่พนักงาน !!</p>
  <hr>

  <a onClick="window.location.reload();" class="btn btn-outline-dark btn-lg btn-block" role="button" aria-pressed="true">รีเฟรชคะแนน</a></center><br>
  <a href="./?app=logout" class="btn btn-outline-info btn-lg btn-block" role="button" aria-pressed="true">ของรางวัล</a></center><br>
  <a href="./?app=logout" class="btn btn-outline-danger btn-lg btn-block" role="button" aria-pressed="true">ออกจากระบบ</a></center><br>


</div>









<script>
function loadXMLDoc1() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("point").innerHTML =
      this.responseText;
    }
  };
  xhttp.open("GET", "./?app=show&token=<?php echo $token;?>", true);
  xhttp.send();
}
setInterval(function(){
	loadXMLDoc1();
	// 1sec
},1000);

window.onload = loadXMLDoc;
</script>