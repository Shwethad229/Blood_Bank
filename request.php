<?php
$checkTable = "SELECT Bb_id FROM blood_bank WHERE Bb_name = '$Bb_name' ";
$result = mysqli_query($conn,$checkTable);
$x1 = mysqli_num_rows($result);
// = $_POST['Required_Packets'];
$checkTable1 = "SELECT P_id FROM patient WHERE P_name = '$P_name' ";
$result1 = mysqli_query($conn,$checkTable1);
$x2 = mysqli_num_rows($result1);
$sql_query1 = "INSERT INTO request (P_id,Bb_id,Required_Packets)
VALUES ( '$x2','$x1','$Required_Packets')";
 if((mysqli_query($conn, $sql_query1))){
    echo "Successfully printed";
 } else{
    echo "Error: " . $sql . "" . mysqli_error($conn);
 }
 ?>