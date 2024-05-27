<?php
$server_name="localhost";
$username="root";
$password="";
$database_name="blood_bank2";

$conn=mysqli_connect($server_name,$username,$password,$database_name);
//now check the connection
if(!$conn)
{
	die("Connection Failed:" . mysqli_connect_error());

}
if(isset($_POST['save']))
{
 
        $Name = $_POST['Name'];
        $B_type = $_POST['B_type'];
        $Gender = $_POST['Gender'];
        $Weight = $_POST['Weight'];
        $Address = $_POST['Address'];
        $BP = $_POST['BP'];
        $Phno = $_POST['Phno'];
        $DOB = $_POST['DOB'];
        $Registered_date =$_POST["Registered_date"];
        $name = $_POST['name'];
        $Bb_name = $_POST['Bb_name'];
    $checkTable = "SELECT d_id FROM Doctor WHERE name = '$name' ";
    $result = mysqli_query($conn,$checkTable);
    $x1 = mysqli_fetch_row($result);
    //$Bb_name = $_POST['Bb_name'];
    $checkTable2 = "SELECT Bb_id FROM Blood_bank WHERE Bb_name = '$Bb_name' ";
    $result2 = mysqli_query($conn,$checkTable2);
    $x3 = mysqli_fetch_row($result2);
    $query = mysqli_query($conn,"SELECT Phno FROM Donor WHERE Donor.Phno=$Phno and donor.B_type='$B_type'");
  if (mysqli_num_rows($query) != 0) {
    echo '<script type="text/javascript">';
      echo 'alert("Donor already registered")';
      echo '</script>';
    $q1 = "SELECT Registered_date FROM donor WHERE Phno=$Phno";
    $result5 = mysqli_query($conn, $q1);
    $row = mysqli_fetch_assoc($result5);
    $x10 = $row['Registered_date'];
    $date1 = date_create($x10);
    $date2 = date_create($Registered_date);
    $diff=date_diff($date1,$date2);
    $x11= $diff->format("%R%a days");
    if($x11<45){
      echo '<script type="text/javascript">';
      echo 'alert("cannot donate blood ")';
      echo '</script>';
      include('weblogin.html');
    }else{
     // $date3 = date_create($Registered_date);
    //  $date4 = date('Y-m-j');
      $sql_query3 = "UPDATE donor SET donor.Registered_date=NOW() WHERE Phno=$Phno and donor.B_type='$B_type'";
      $result9 = mysqli_query($conn, $sql_query3);
      $Bb_name = $_POST['Bb_name'];
    $checkTable2 = "SELECT Bb_id FROM Blood_bank WHERE Bb_name = '$Bb_name' ";
    $result2 = mysqli_query($conn,$checkTable2);
    $x3 = mysqli_fetch_row($result2);
    $sql_query1="UPDATE Blood1 set Avl_units=Avl_units+1 WHERE Blood1.Bb_id='$x3[0]' and Blood1.Blood_type='$B_type'";
      $result8 = mysqli_query($conn, $sql_query1);
      //$sql_query3 = "UPDATE donor SET donor.Registered_data=$Registered_date WHERE Phno=$Phno and donor.B_type='$B_type'";
      //$result9 = mysqli_query($conn, $sql_query3);
      echo '<script type="text/javascript">';
      echo 'alert("Donated blood successfully")';
      echo '</script>';
      include('weblogin.html');
    }
 } else {

    //$x1 = $result->fetch_assoc();
    // $count = mysqli_num_rows($result);
    //if company does not exists the add it.
    //  if ($count == 0){
    //  echo "there is no row named ";
    //   }
// $nameArray = explode(" ", $_POST['name']);
///$name = $nameArray[0];


    ////$statement = $conn->prepare("SELECT d_id FROM doctor WHERE name = :name");
//$statement->execute(array(':name' => $name));
//$row = $statement->fetch();
//$d_id = $row['d_id'];
    $sql_query = ("INSERT INTO donor (Name,B_type,Gender,Weight,Address,BP,Phno,DOB,Registered_date,d_id,Bb_id)
	 VALUES ( '$Name','$B_type', '$Gender', '$Weight', '$Address','$BP','$Phno','$DOB','$Registered_date',$x1[0],$x3[0])");
    // execute statement
    // $stmt->execute();
    // $Name = $_POST['Name'];
    // $checkTable1 = "SELECT do_id FROM donor WHERE Name = '$Name' ";
    //$result1 = mysqli_query($conn,$checkTable1);
    //$x2 = mysqli_num_rows($result1);
    // $Bb_name = $_POST['Bb_name'];
    //$checkTable2 = "SELECT Bb_id FROM Blood_bank WHERE Bb_name = '$Bb_name' ";
    //$result2 = mysqli_query($conn,$checkTable2);
    //$x3 = mysqli_fetch_row($result2);
    //   $sql_query1="UPDATE Blood1 SET Avl_units=Avl_units+1  WHERE Blood1.Bb_id='$x3' AND Blood1.Blood_type='$B_type'";
    // $sql_query2 = ;
    // echo $sql_query1;
    //  if ($conn->query($sql_query1) === TRUE) {
    // echo "Record updated successfully";
    // } else {
    //  echo "Error updating record: " . $conn->error;
    // }
    // $result3=mysqli_query($conn,$sql_query);
    // $x4=mysqli_num_rows($result3);
    //$sql_query =("INSERT INTO Blood1 (Avl_units)
    //  VALUES ( '$x4')");                                  // and mysqli_query($conn, $sql_query1)
    if (mysqli_query($conn, $sql_query)) {
      // if ($conn->query($sql_query2) === TRUE) {

      //   echo "New Details Entry inserted successfully !";
      echo '<script type="text/javascript">';
      echo ' alert("Details Entered Successfully")';
      //  include('login.html');
      echo '</script>';
      include('weblogin.html');
      // } else {
      //    echo "Error updating record: " . $conn->error;
      //    }
    } else {
      echo ("Error: " . $sql . "" . mysqli_error($conn));
    }
    // if (mysqli_query($conn, $sql_query1))  {
    //   echo "New Details Entry inserted successfully !";
    //  } else {
    //  echo "Error: " . $sql . "" . mysqli_error($conn);
    //   }
//	 mysqli_close($conn);
  }
}
?>