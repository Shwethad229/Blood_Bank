<?php
	$Blood_type = $_POST['Blood_type'];
	$Gender = $_POST['Gender'];
        $Weight = $_POST['Weight'];
        $Address = $_POST['Address'];
        $Donor_name = $_POST['Donor_name'];
        $BP=$_POST['BP'];
	$Phone_Number = $_POST['Phone_Number'];
        $DOB=$_POST['DOB'];

	// Database connection
	$conn = new mysqli('localhost','root','','bloodbank');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $conn->prepare("insert into registration(Blood_type,Gender,Weight,Address,Donor_name,BP,Phone_Number,DOB) values(?, ?, ?, ?, ?, ?,?,?)");
		$stmt->bind_param("ssisssii", $Blood_type, $Gender, $Weight, $Address, $Donor_name, $BP,$Phone_Number,$DOB);
		$execval = $stmt->execute();
		echo $execval;
		echo "Registration successfully...";
		$stmt->close();
		$conn->close();
	}
?>
