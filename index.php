<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT']."/default/conn.php");
$error="";

if(isset($_POST['submit']))
{
	if(!empty($_POST['email']) && !empty($_POST['mobile']))
	{
		$email = $_POST['email'];
		$pwd = $_POST['mobile'];
		$sql = "SELECT * from register WHERE email='$email' AND mobile='$pwd'";
		$result = $conn->query($sql);
		if($result->num_rows>0)
		{
			while($row=$result->fetch_assoc())
			{
				$_SESSION['email'] = $row['email'];
				$_SESSION['id'] = $row['id'];
				header("Location: profile.php");
				die();
			}
		}
		else
		{
			echo '<script type="text/javascript"> alert("Email or password is incorrect") </script>';		
		}
	}
	else
	{
		echo '<script type="text/javascript"> alert("Please enter email and password") </script>';		
	}
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Student Login</title>
	<link rel="stylesheet" href="/css/materialize.css">
	<link rel="stylesheet" href="/css/materialize.min.css">
	
<style>
*{
	margin:0;
	padding:0;
}
.b{
color:teal;
cursor:pointer;
padding:6px 50px;	
border:2px solid teal;
font-family:Algerian;
font-size:20px;
}
.b:hover{
	background-color:teal;
	color:white;
}
</style>


</head>
<body class="grey lighten-3"><br>
	<div class="container">
		<div class="row teal">
			<div class="col l12 m12 s12">
				<h5 class="left bold" style="color:white;font-family:Algerian;">Student Login</h5>
				<a href="/view.php"><h5 class="right btn" style="color:orange ;font-family:Algerian;background-color:white;">View</h5></a>
				<a href="register.php"><h5 class="right btn" style="color:white ;font-family:Algerian;">Sign up</h5></a>
			</div>
		</div>
		<div class="row">
		<div class="col l6 s12 m10 push-m1 push-l3">
			<div class="grey lighten-4 card">
				<div class="center" style="padding:20px">
					<div class="center">
						<img src="/images/login.png" width="200"><br/><br/>
					</div>
					<form action="index.php" method="post">
					<div class="center"><?php echo $error; ?></div>
						<input type="email" style="background-color:#eeeeee;color:blue;border-radius:40px;font-family:Comic Sans MS;border:none;padding-left:10px;" name="email" placeholder="Enter Your email" class="validate"/><br/>
						<input type="password" style="background-color:#eeeeee;color:blue;border-radius:40px;font-family:Comic Sans MS;border:none;padding-left:10px;" name="mobile" placeholder="Enter mobile Number" class="validate" maxlength="10"/><br/><br/>
						<input type="submit" class="b" style="" name="submit" value="Login" />
						<input type="reset" class="b" style="" name="reset" value="Reset" />
					</form>   
				</div>
			</div>
		</div>
	</div>
	</div>



<script src="/js/materialize.js"></script>
<script src="/js/materialize.min.js"></script>
<script>M.AutoInit();</script>

</body>
</html>