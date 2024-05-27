<?php
//echo "Starting ";
$user = 'root';
$password = '';
// Database name is geeksforgeeks
$database = 'blood_bank2';
// Server is localhost with
// port number 3306
$servername='localhost';
$mysqli = new Mysqli($servername, $user,$password, $database);
//Checking for connections
if ($mysqli->connect_error)
{
die($mysqli->connect_error);
}

//echo " ending ";
// SQL query to select data from database
$sql = "SELECT * FROM donor";
$result = $mysqli->query($sql);

if (!$result) 
{
    die(" Data Connectiom errpr :".$mysqli->error);
}
$rows = $result->num_rows;
//echo "Donor Details ";
echo "<table><tr><th>D_id</th><th>Name</th><th>B_type<th>Gender</th><th>Weight</th><th>Address</th><th>BP</th><th>Phno</th><th>DOB</th><th>Doctor_id</th></tr>";
for ($j = 0 ; $j < $rows; ++$j)
{
 $result->data_seek($j);
$row=$result->fetch_array(MYSQLI_NUM);
echo "<tr>";
for ( $k = 0; $k < 10; ++$k) 
{
echo "<td>$row[$k]</td>";
}
echo "</tr>";
}
echo "</table>";
?>
