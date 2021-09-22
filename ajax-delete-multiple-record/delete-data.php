<?php

    $conn = mysqli_connect("localhost","root","","test1") or die("CONNECTION FAILED.!");

    $std_id = $_POST['id'];

    $str = implode("," , $std_id);
    
    $sql = "DELETE FROM student WHERE id IN ({$str})";
    if(mysqli_query($conn,$sql)){
        echo  1;
    }else{
        echo  0;
    }
?>