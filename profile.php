<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT']."/default/conn.php");

if(!isset($_SESSION['id']))
{
	header("Location: login.php");
	exit();
} 
else
{
	$sid = $_SESSION['id'];

	$sql = "SELECT * FROM register WHERE id=$sid";
	$result = $conn->query($sql);
	if($result -> num_rows == 1)
	{
		while($row = $result->fetch_assoc())
		{
			$id = $row['id'];
			$fname = $row['fname'];
			$lname = $row['lname'];
			$fullname = $fname." ".$lname;
			$gender = $row['gender'];
			$dob = $row['dob'];
			$blood = $row['blood'];
			$languages = $row['language'];
			$address = $row['address'];
			$email = $row['email'];
			$mobile = $row['mobile'];
			$photo = $row['photo'];
			
		}
	}
}

	
	
?>


<!DOCTYPE html>
<html>
<head>
	<title>Student Profile</title>
	<link rel="stylesheet" href="/css/materialize.css">
	<link rel="stylesheet" href="/css/materialize.min.css">
</head>	

<body class="grey lighten-4">
<div class="container">
		<div class="row">
			<div class="col l12 m12 s12">
				<h5><p class="center teal darken-2 white-text" style="padding:10px;border-radius:5px;font-family:Comic Sans Ms">Profile Details</p></h5>
				<h5><a href="edit.php" class="left btn lighten-5">Edit</a></h5>
				<h5><a href="logout.php" class="right btn">logout</a></h5>
			</div>
		</div>
	</div>

<div class="container">
	<div class="row">
		<div class="col l12 m12 s12">
			<div class="card green lighten-5 hoverable" style="padding:10px;">
				<table>
					<tr>
						<td>Photo</td>
						<td><?php echo "<img src = 'upload/".$photo."' height='150px' width='150px' />" ?></td>
					</tr>
					<tr>
						<td>Name</td>
						<td><?php echo $fullname; ?></td>
					</tr>
					<tr>
						<td>DOB</td>
						<td><?php echo $dob; ?></td>
					</tr>
					<tr>
						<td>Gender</td>
						<td><?php echo $gender; ?></td>
					</tr>
					<tr>
						<td>Blood Group</td>
						<td><?php echo $blood; ?></td>
					</tr>
					<tr>
						<td>Languages Known</td>
						<td><?php echo $languages; ?></td>
					</tr>
					<tr>
						<td>Address</td>
						<td><?php echo $address; ?></td>
					</tr>
					<tr>
						<td>E-Mail ID</td>
						<td><?php echo $email; ?></td>
					</tr>
					<tr>
						<td>Mobile Number</td>
						<td><?php echo $mobile; ?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>

<script src="/js/materialize.js"></script>
<script src="/js/materialize.min.js"></script>
<script>M.AutoInit();</script>

</body>
</html>