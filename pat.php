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
  echo "<script>console.log('Debug Objects: " . $_POST['save'] . "' );</script>";
    $P_name = $_POST['P_name'];
    $Bb_name = $_POST['Bb_name'];
    $Blood_type = $_POST['Blood_type'];
    $Gender = $_POST['Gender'];
    $Hospital_address = $_POST['Hospital_address'];
	  $Phno = $_POST['Phno'];
    $P_Address = $_POST['P_Address'];
    $Required_Packets = $_POST['Required_Packets'];
   
    
    $checkTable2 = "SELECT Bb_id FROM blood_bank WHERE Bb_name = '$Bb_name' ";
    $result2 = mysqli_query($conn,$checkTable2);
   $x3 = mysqli_fetch_row($result2);
   // $sql_query="CREATE TRIGGER Displaying BEFORE insert on Patient FOR EACH ROW BEGIN
   // DECLARE nb INT default 0; 
   // SET nb =( SELECT Avl_units FROM Blood1 b WHERE b.Bb_id='$x3' AND b.Blood_type='$Blood_type')
   // IF( NEW.nb<'$Required_Packets') THEN
    // SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='WARNING: Available units is less';  ELSE 
    $sql_query=  "INSERT INTO patient (P_name,Gender,Hospital_address,Phno,P_address,Blood_type,Bb_id)
	 VALUES ( '$P_name', '$Gender', '$Hospital_address','$Phno','$P_Address','$Blood_type','$x3[0]')";
     // $sql_query2="UPDATE Blood1 SET Avl_units=Avl_units+1  WHERE Blood1.Bb_id='$x3' AND Blood1.Blood_type='$Blood_type'";
   // $sql_query3 = "CREATE TRIGGER Displaying
                  // AFTER INSERT ON Patient,request 
                  // FOR EACH ROW
                  // SIGNAL SQLSTATE '50001' PRINT MESSAGE_TEXT='The requested units is '$Required_Packets''";
  if (mysqli_query($conn, $sql_query)) {
    $P_id = $conn->insert_id;
    $Bb_name = $_POST['Bb_name'];
    $checkTable = "SELECT Bb_id FROM blood_bank WHERE Bb_name = '$Bb_name' ";
    $result1 = mysqli_query($conn, $checkTable);
    $x1 = mysqli_fetch_row($result1);
    $sql_query1 = "INSERT INTO request (P_id,Bb_id,Required_Packets)
       VALUES ( '$P_id','$x1[0]','$Required_Packets')";
    $result = $conn->query($sql_query1);
    $sql_query3 = "SELECT Avl_units FROM Blood1 WHERE Bb_id='$x1[0]' AND Blood_type='$Blood_type'";
    $result4 = mysqli_query($conn, $sql_query3);
    $x3 = mysqli_fetch_row($result4);
    $result7 = $conn->query("CALL Unit_checking($x1[0],'$Blood_type',$Required_Packets,$P_id)");
    while ($row = mysqli_fetch_array($result7)) {
    //  echo $row[0];
      // echo $Required_Packets;
      if ($row[0] > $Required_Packets) {
        //$Blood_type = $_POST['Blood_type'];
        //$Required_Packets = $_POST['Required_Packets'];
       //$Bb_name = $_POST['Bb_name'];
  //  $checkTable6 = "SELECT Bb_id FROM blood_bank WHERE blood_bank.Bb_name = '$Bb_name' ";
   // $result6 = mysqli_query($conn,$checkTable6);
    //if($result6 === false) {
     // die("Database query failed");
      //  } else {
          // use mysqli_fetch_row() here.

         // $x10 = mysqli_fetch_row($result6);
          // $x7 = $row[0];
          // echo "Updating rows";
          // mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
          $sql_query5 = "UPDATE blood1 SET Avl_units= Avl_units-'$Required_Packets' WHERE Bb_id='$x1[0]' AND Blood_type='$Blood_type'";
          $result5 = mysqli_query($conn, $sql_query5);
          echo '<script type="text/javascript">';
          echo ' alert("Requested units available in stock")';
          // echo 'alert("Units delivered")';
          //  include('login.html');
          echo '</script>';
          include('weblogin.html');
         } else {
        echo '<script type="text/javascript">';
        echo 'alert("Stock not available")';
       // echo 'alert("Please try in another blood bank")';
        echo '</script>';
        include('Patient.html');
       // echo "Error: " . $sql . "" . mysqli_error($conn);
      }
    }
  }
// = $_POST['Required_Packets'];
      // $sql_query1 = "INSERT INTO request (P_id,Bb_id,Required_Packets)
      // VALUES ( '$P_id','$x1','$Required_Packets')";
        //$result2 = $conn->query($sql_query3);
       // $cn=new PDO($Blood_type,$x3[2],$Required_Packets,$x1[0]);
   // echo "Function running";
//$q=$conn->query('SELECT  Unit_check()');
//$res=mysqli_fetch_all($q);
//print_r($res);
   // $mysqli->query("SET @mesg=' '");
   // $stm = $mysqli->prepare("call Unit_checking(?,?,?,@mesg,@msg)");
    //$stm->bind_param("iis", $Bbid, $Pid, $Bloodtype);
    //$Bbid = $x1[0];
    //$Pid = $P_id;
    //$Bloodtype = $Blood_type;
    //$stm->execute();
   // $Bbid = $x1[0];
   // $Pid = $P_id;
   // $Bloodtype = $Blood_type;
   //  $sql = "call Unit_checking('$x1[0],$P_id,$Blood_type,@mesg,@msg');";
     //    $res = $mysqli_query($conn, $sql);
    //$result = $mysqli->query("select @mesg as pout");
   // $result1 = $mysqli->query("select @msg as pin");
      //  echo "pout";
   // $row = $result->fetch_assoc();
   // echo $row['pout'];
    //$row1 = $result1->fetch_assoc();
  //  echo "$res";
   // $sql_query4 = ('CALL Unit_check($Blood_type,$x3[2],$Required_Packets,$x1[0])');
   // $res=$sql_query->
   // print_r($res);
   // if ('pin' =='TRUE') {
    //  $sql_query2 = "UPDATE Blood1 SET Avl_units=Avl_units-'$Required_Packets'  WHERE Blood1.Bb_id='$x1' AND Blood1.Blood_type='$Blood_type'";
    //  $conn->query($sql_query2);
     // echo '<script type="text/javascript">';
      //echo ' alert("Stock Not Available")';
       //  include('login.html');
    // echo '</script>';
    //} //elseif($res == 2){
      //$sql_query2 = "UPDATE Blood1 SET Avl_units=Avl_units-'$Required_Packets'  WHERE Blood1.Bb_id='$x1' AND Blood1.Blood_type='$Blood_type'";
      //$conn->query($sql_query2);
    // else{
   //   echo "Error: " . $sql . "" . mysqli_error($conn);
   // }
	//	echo "New Details Entry inserted successfully !";
     // if((mysqli_query($conn, $sql_query1))){
     // echo "Successfully printed";
     // } else{
     // echo "Error: " . $sql . "" . mysqli_error($conn);
 //}
	  else {
		echo "Error: " . $sql . "" . mysqli_error($conn);
	 }
   // include('request.php');
    // $P_name = $_POST['P_name'];
    // $checkTable1 = "SELECT P_id FROM Patient WHERE P_name = '$P_name' ";
     //$result1 = $conn->query($checkTable1);
    //$x2 = mysqli_num_rows($result1);
    // $Bb_name = $_POST['Bb_name'];
     //$checkTable = "SELECT Bb_id FROM blood_bank WHERE Bb_name = '$Bb_name' ";
     //$result = $conn->query($checkTable);
     //$x1 = mysqli_num_rows($result);
     // = $_POST['Required_Packets'];
    // $sql_query1 = "INSERT INTO request (P_id,Bb_id,Required_Packets)
	 //VALUES ( '$x2','$x1','$Required_Packets')";
    //if(mysqli_query($conn, $sql_query1)){
      //  echo "Successfully printed";
    //} else{
      //  echo "Error: " . $sql . "" . mysqli_error($conn);
    //}
     
     
	 mysqli_close($conn);
}
?>