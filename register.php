<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT']."/default/conn.php");
$error="";

if(isset($_POST['save']))
{
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$gender = $_POST['gender'];
	$dob = $_POST['dob'];
	$blood = $_POST['blood'];
	$address = $_POST['address'];
	$email = $_POST['email'];
	$mobile = $_POST['mobile'];
	if(!empty($_POST['languages'])) 
	{
		$languages= implode(',',$_POST['languages']);
	}
	if(isset($_FILES["image"]))
	{
		$target_dir = "upload/";
		$fileName = $_FILES["image"]["name"];
		$fileTmpLoc = $_FILES["image"]["tmp_name"];
		$fileconvpath = $target_dir.$fileName;
		move_uploaded_file($fileTmpLoc, $fileconvpath);
	}
	else
	{
		echo '<script type="text/javascript"> alert("image not set.") </script>';
	}
	$check="SELECT * FROM register WHERE email='$email' AND mobile='$mobile' ";
	$result = mysqli_query($conn, $check);
	if(mysqli_num_rows($result) > 0)
	{	
		echo '<script type="text/javascript"> alert("Your email address or mobile number already used") </script>';		
	}
	else
	{
		$sql = "INSERT INTO register (fname, lname, gender, dob, blood, language, address, email, mobile, photo) 
				VALUES ('$fname','$lname','$gender','$dob','$blood','$languages','$address','$email','$mobile', '$fileName')";
		if($conn->query($sql) === TRUE)
		{
			echo '<script type="text/javascript"> alert("Record saved successfully") </script>';
		}
		else
		{
			echo '<script type="text/javascript"> alert("Record NOT saved") </script>';		
		}
	}
}		

?>

<!DOCTYPE html>
<html>
<head>
	<title>Student Register</title>
	<link rel="stylesheet" href="/css/materialize.css">
	<link rel="stylesheet" href="/css/materialize.min.css">
</head>	
<body class="grey lighten-3"><br>
	<div class="container">
		<div class="row">
			<div class="col l12 m12 s12">
				<h5 class="center" style="color:teal;font-family:Algerian;">Enter the Student Details</h5>
			</div>
		</div>
	</div>
	<div class="row grey" style="padding:20px 20px">
	<div class="card" style="padding:10px;">
		<form action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]);?>" method="POST" enctype="multipart/form-data">
		<div class="row"><?php echo $error; ?></div>
		<div class="row">
			<div class="input-field col l4 m3 s6">
				<input placeholder="First Name" id="firstname" name="fname" type="text" class="validate" required>
				<label for="fname">First Name</label>
			</div>
			<div class="input-field col l4 m3 s6">
				<input placeholder="Last Name" id="lastname" name="lname" type="text" class="validate" required>
				<label for="lname">Last Name</label>
			</div>
			<div class="input-field col l2 m3 s6">
				<p>
				  <label>
					<input name="gender" type="radio" value="Male" />
					<span>Male</span>
				  </label>
				</p>
			</div>
			<div class="input-field col l2 m3 s6">
				<p>
				  <label>
					<input name="gender" type="radio" value="Female" />
					<span>Female</span>
				  </label>
				</p>
			</div>
		</div>
		<div class="row">
			<div class="input-field col l4 m4 s6">
				 <input type="text" class="datepicker" name="dob" placeholder="Date of Birth" required>
				 <label for="dob">DOB</label>
			</div>
			<div class="input-field col l4 m4 s6">
				 <select name="blood" required>
					<option disabled selected>Choose Blood Group</option>
					<option value="A+ve">A+ve</option>
					<option value="B+ve">B+ve</option>
					<option value="O+ve">O+ve</option>
					<option value="AB+ve">AB+ve</option>
					<option value="A-ve">A-ve</option>
					<option value="B-ve">B-ve</option>
					<option value="O-ve">O-ve</option>
					<option value="AB-ve">AB-ve</option>
				</select>
				 <label for="blood">Blood Group</label>
			</div>
			<div class="input-field col l4 m4 s6">
				<select name="languages[]" multiple required>
					<option value="" disabled>Choose Languages</option>
					<option value="c">c</option>
					<option value="java">java</option>
					<option value="php">php</option>
					<option value="mysql">mysql</option>
				</select>
				 <label for="languages">Languages Known</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col l4 m4 s6">
				<textarea id="textarea1" name="address" class="materialize-textarea" required></textarea>
				<label for="address">Address</label>
			</div>
			<div class="input-field col l4 m4 s6">
				<input id="email" type="email" name="email" class="validate" required>
				<label for="email">Email</label>
			</div>
			<div class="input-field col l4 m4 s6">
				<input type="text" name="mobile" class="validate" maxlength="10" required>
				<label for="mobile">Mobile No</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<div class="file-field input-field">
					<div class="btn purple darken-4 waves-effect waves-light">
						<span>Profile</span>
						<input type="file" name="image" >
					</div>
					<div class="file-path-wrapper">
						<input class="file-path validate" type="text" placeholder="Upload product image">
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="center">
				<input type="submit" name="save" value="Save" class="btn green">
				<input type="reset" name="reset" value="Reset" class="btn">
				<a href="/index.php" class="btn">Back To Login</a>
			</div>
		</div>
		</form>
	</div>
	</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.datepicker');
    var instances = M.Datepicker.init(elems, options);
  });
  
   document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems, options);
  });
</script>
<script src="/js/materialize.js"></script>
<script src="/js/materialize.min.js"></script>
<script>M.AutoInit();</script>

</body>
</html>