<?php

    $conn = mysqli_connect("localhost","root","","test1") or die("CONNECTION FAILED.!");

    $sql = "SELECT * FROM student";
    $result = mysqli_query($conn,$sql) or die("QUERY FAILED.!");
    $output = "";
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $output .= "<tr>
            <td><input type='checkbox' value='{$row['id']}'></td>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['class']}</td>
            <td>{$row['age']}</td>
        </tr>";
        }
    }else{
        $output .= "No Record Found";
    }
    echo $output;
?>