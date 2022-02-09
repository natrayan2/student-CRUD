<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT']."/default/conn.php");
$error="";
$isEdit=false;
$eid="";

if(!isset($_SESSION['id']) && isset($_GET['id']))
{
	$gid=$_GET['id'];
	$id=$fname=$lname=$dob=$gender=$blood=$languages=$address=$email=$mobile=$photo="";
	$sql = "SELECT * FROM register WHERE id=$gid";
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
			$address = $row['address'];
			$email = $row['email'];
			$mobile = $row['mobile'];
			$photo = $row['photo'];
			if(!empty($row['language'])) 
			{
				$languages= explode(',',$row['language']);
						
			}
		}
	}
	
	if(isset($_POST['update']))
	{
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$gender = $_POST['gender'];
		$dob = $_POST['dob'];
		if(!empty($_POST['languages'])) 
		{
			$languages= implode(',',$_POST['languages']);
		}
		$blood = $_POST['blood'];
		$address = $_POST['address'];
		$email = $_POST['email'];
		$mobile = $_POST['mobile'];
		
		if(isset($_FILES["image"]))
		{	
			$target_dir = "upload/";
			$fileName = $_FILES["image"]["name"];
			$fileTmpLoc = $_FILES["image"]["tmp_name"];
			$fileconvpath = $target_dir.$fileName;
			move_uploaded_file($fileTmpLoc, $fileconvpath);
		}
		$sql = "UPDATE register SET fname='$fname',lname='$lname',gender='$gender',dob='$dob',language='$languages',
				blood='$blood',address='$address',email='$email',mobile='$mobile',photo='$fileName' WHERE id='$gid'";
		if ($conn->query($sql) === TRUE)
		{
			//echo '<script type="text/javascript"> alert("updated successfully") </script>';
			header("Location: view.php");
			exit();
		}
	}
} 
else
{
	$id=$fname=$lname=$dob=$gender=$blood=$languages=$address=$email=$mobile=$photo="";
	$sid=$_SESSION['id'];
	$sql2 = "SELECT * FROM register WHERE id=$sid";
	$result2 = $conn->query($sql2);
	if($result2 -> num_rows == 1)
	{
		while($row = $result2->fetch_assoc())
		{
			$id = $row['id'];
			$fname = $row['fname'];
			$lname = $row['lname'];
			$fullname = $fname." ".$lname;
			$gender = $row['gender'];
			$dob = $row['dob'];
			$blood = $row['blood'];
			$address = $row['address'];
			$email = $row['email'];
			$mobile = $row['mobile'];
			$photo = $row['photo'];
			if(!empty($row['language'])) 
			{
				$languages= explode(',',$row['language']);
						
			}
		}
	}
	
	
	if(isset($_POST['update']))
	{
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$gender = $_POST['gender'];
		$dob = $_POST['dob'];
		if(!empty($_POST['languages'])) 
		{
			$languages= implode(',',$_POST['languages']);
		}
		$blood = $_POST['blood'];
		$address = $_POST['address'];
		$email = $_POST['email'];
		$mobile = $_POST['mobile'];
		
		if(isset($_FILES["image"]))
		{	
			$target_dir = "upload/";
			$fileName = $_FILES["image"]["name"];
			$fileTmpLoc = $_FILES["image"]["tmp_name"];
			$fileconvpath = $target_dir.$fileName;
			move_uploaded_file($fileTmpLoc, $fileconvpath);
		}
		$sql = "UPDATE register SET fname='$fname',lname='$lname',gender='$gender',dob='$dob',language='$languages',blood='$blood',address='$address',
				email='$email',mobile='$mobile',photo='$fileName' WHERE id='$sid'";
		if ($conn->query($sql) === TRUE)
		{
			//echo '<script type="text/javascript"> alert("updated successfully") </script>';
			header("Location: profile.php");
			exit();
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
			<div class="input-field col l3 m6 s6">
				<input placeholder="First Name" id="firstname" name="fname" value="<?php echo $fname; ?>" type="text" class="validate">
				<label for="fname">First Name</label>
			</div>
			<div class="input-field col l3 m6 s6">
				<input placeholder="Last Name" id="lastname" name="lname" type="text" value="<?php echo $lname; ?>" class="validate">
				<label for="lname">Last Name</label>
			</div>
			<div class="input-field col l1 m3 s6">
				<p>
				  <label>
					<input name="gender" type="radio" value="Male" <?php if($gender=="Male") echo 'checked="checked"' ?> />
					<span>Male</span>
				  </label>
				</p>
			</div>
			<div class="input-field col l1 m3 s6">
				<p>
				  <label>
					<input name="gender" type="radio" value="Female" <?php if($gender=="Female") echo 'checked="checked"' ?> />
					<span>Female</span>
				  </label>
				</p>
			</div>
			<div class="input-field col l3 m6 s6 push-l1">
				<?php echo '<img src="upload/'.$photo.'" height="100px" width="100px"/>' ?>
			</div>
		</div>
		<div class="row">
			<div class="input-field col l4 m4 s6">
				 <input type="text" class="datepicker" value="<?php echo $dob; ?>" name="dob" placeholder="Date of Birth">
				 <label for="dob">DOB</label>
			</div>
			<div class="input-field col l4 m4 s6">
				 <select name="blood">
					<option disabled selected>Choose Blood Group</option>
					<option value="A+ve"<?php if ($blood == 'A+ve') echo 'selected="selected"'; ?>>A+ve</option>
					<option value="B+ve"<?php if ($blood == 'B+ve') echo 'selected="selected"'; ?>>B+ve</option>
					<option value="O+ve"<?php if ($blood == 'O+ve') echo 'selected="selected"'; ?>>O+ve</option>
					<option value="AB+ve"<?php if ($blood == 'AB+ve') echo 'selected="selected"'; ?>>AB+ve</option>
					<option value="A-ve"<?php if ($blood == 'A-ve') echo 'selected="selected"'; ?>>A-ve</option>
					<option value="B-ve"<?php if ($blood == 'B-ve') echo 'selected="selected"'; ?>>B-ve</option>
					<option value="O-ve"<?php if ($blood == 'O-ve') echo 'selected="selected"'; ?>>O-ve</option>
					<option value="AB-ve"<?php if ($blood == 'AB-ve') echo 'selected="selected"'; ?>>AB-ve</option>
				</select>
				 <label for="blood">Blood Group</label>
			</div>
			
			<div class="input-field col l4 m4 s6">
				<select name="languages[]" multiple>
					<option disabled>Choose Languages</option>
					<?php
						$c=$java=$php=$mysql=false;
						foreach ($languages as $lang) 
						{
							if($lang=="c"){ $c=true; }
							else if($lang=="java"){ $java=true; }
							else if($lang=="php"){ $php=true; }
							else if($lang=="mysql"){ $mysql=true; }
						}
					?>
					<option value="c"<?php if ($c) echo 'selected="selected"'; ?>>c</option>
					<option value="java"<?php if ($java) echo 'selected="selected"'; ?>>java</option>
					<option value="php"<?php if ($php) echo 'selected="selected"'; ?>>php</option>
					<option value="mysql"<?php if ($mysql) echo 'selected="selected"'; ?>>mysql</option>
				</select>
				 <label for="languages">Languages Known</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col l4 m4 s6">
				<input id="address" type="text" class="validate" name="address" value="<?php echo $address; ?>">
				<label for="address">Address</label>
			</div>
			<div class="input-field col l4 m4 s6">
				<input id="email" type="email" name="email" value="<?php echo $email; ?>" class="validate">
				<label for="email">Email</label>
			</div>
			<div class="input-field col l4 m4 s6">
				<input type="text" name="mobile" class="validate" value="<?php echo $mobile; ?>" maxlength="10"/>
				<label for="mobile">Mobile No</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col l4 m6 s6">
				<div class="file-field input-field">
					<div class="btn purple darken-4 waves-effect waves-light">
						<span>New Profile</span>
						<input type="file" name="image" value="<?php echo 'upload/'.$photo; ?>">
						<input type="hidden" name="old_photo" value="<?php echo $row['photo']; ?>">
					</div>
					<div class="file-path-wrapper">
						<input class="file-path validate" type="text" value="<?php echo $photo; ?>" placeholder="Upload profile photo">
					</div>
				</div>
			</div>
			<div class="col l4 m6 s6 center">
				<input type="submit" name="update" value="Update" class="btn green">
				<a href="view.php" class="btn">Back</a>
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