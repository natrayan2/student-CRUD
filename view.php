<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT']."/default/conn.php");
$error="";
$output="";

$sql = "SELECT * FROM register";
	$result = $conn->query($sql);
	if($result -> num_rows > 0)
	{
		$i=1;
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
			$output .='	
						<tr>
							<td class="center">'.$i.'</td>
							<td class="center">'.$fullname.'</td>
							<td class="center">'.$gender.'</td>
							<td class="center">'.$dob.'</td>
							<td class="center">'.$blood.'</td>
							<td class="center">'.$languages.'</td>
							<td class="center">'.$address.'</td>
							<td class="center">'.$email.'</td>
							<td class="center">'.$mobile.'</td>
							<td class="center"><img src="upload/'.$photo.'" height="100px" width="100px"/></td>
							<td class="center">
								<a href="edit.php?id='.$row["id"].'">Edit/Update</a><br>
								<a href="delete.php?id='.$row["id"].'"><p style="color:red">Delete</p></a>
							</td>
						</tr>
						';
			$i++;
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Student Login</title>
	<link rel="stylesheet" href="/css/materialize.css">
	<link rel="stylesheet" href="/css/materialize.min.css">
</head>
<body bgcolor="#e3f2fd" style="padding:20px 20px;"><br><br>
<div class="row teal">
	<div class="col l12 m12 s12">
		<h5 class="left bold" style="color:white;font-family:Algerian;">All Student Details</h5>
		<a href="index.php"><h5 class="right btn" style="color:orange ;font-family:Algerian;background-color:white;">Home</h5></a>
	</div>
</div>
<div class="card z-depth-0 padding_20">
	<div class="row">
		<div class="col l12">
			<table class="striped">
				<tr>
					<th class="center">ID</th>
					<th class="center">Student Name</th>
					<th class="center">Gender</th>
					<th class="center">DOB</th>
					<th class="center">BLOOD Group</th>
					<th class="center">Languages Known</th>
					<th class="center">Address</th>
					<th class="center">Email</th>
					<th class="center">Mobile</th>
					<th class="center">Photo</th>
					<th class="center">Action</th>
				</tr>
				<tr>
					<?php echo $output; ?>
				</tr>
			</table>
		</div>
	</div>
</div><br>



<script src="/js/materialize.js"></script>
<script src="/js/materialize.min.js"></script>
<script>
	M.AutoInit();
	//    select option
	instance.selectOption(el);
</script>

</body>
</html>