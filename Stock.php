<?php
$server_name="localhost";
$username="root";
$password="";
$database_name="blood_bank2";

$conn=mysqli_connect($server_name,$username,$password,$database_name);
if(!$conn)
{
	die("Connection Failed:" . mysqli_connect_error());

}
//echo " ending ";
// SQL query to select data from database
if (isset($_POST['save'])) {
    $Bb_name = $_POST['Bb_name'];
    $Blood_type = $_POST['Blood_type'];
    $checkTable2 = "SELECT Bb_id FROM Blood_bank WHERE Bb_name = '$Bb_name' ";
    $result2 = mysqli_query($conn,$checkTable2);
    $x3 = mysqli_fetch_assoc($result2);
    $x4 = $x3['Bb_id'];
    $sql =" SELECT Blood_bank.Bb_name,blood1.Blood_type,blood1.Avl_units 
    FROM blood1 INNER JOIN Blood_bank ON Blood_bank.Bb_id = blood1.Bb_id 
    WHERE Blood_bank.Bb_id=$x4 AND Blood_bank.Bb_name='$Bb_name' AND blood1.Blood_type='$Blood_type' 
    ORDER BY blood1.Bb_id";
    $result = mysqli_query($conn,$sql);

    if (!$result) {
        die(" Data Connectiom error :" . $mysqli->error);
    }
    $rows = $result->num_rows;
   // echo "Donor Details ";
    echo "<table><tr><th>Blood_bank Name</th><th>Blood_type</th><th>Avl_units</th></tr>";
    for ($j = 0; $j < $rows; ++$j) {
        $result->data_seek($j);
        $row = $result->fetch_array(MYSQLI_NUM);
        echo "<tr>";
        for ($k = 0; $k < 3; ++$k) {
            echo "<td>$row[$k]</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}else {
    echo "Error: " . $sql . "" . mysqli_error($conn);
 }
?>
