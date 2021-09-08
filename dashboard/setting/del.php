<?php
    // เรียกใช้ไฟล์ เชื่อมต่อ  database
    include("./control/connection.php");
    
    $id = $_GET['id'];

    $sql    = "DELETE FROM member WHERE id = '".$id."'";
    $query  = $conn->query($sql); 
    if($query){
        echo "successfully <br>";
        echo "<a href='index.php'>ย้อนกลับ</a>";
    } else 
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
?>