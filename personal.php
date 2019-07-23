<?php
$db=mysqli_connect('localhost','root','','houses');
$userid=$firstname=$lastname=$phone=$house=$username=$usercode=$password=$password1=$message="";
$firstnameErr=$lastnameErr=$phoneErr=$houseErr=$usernameErr=$usercodeErr=$passwordErr="";
$errors=0;
if(isset ($_POST['add']))
{
	$firstname= mysqli_real_escape_string($db, $_POST['firstname']);
	$lastname= mysqli_real_escape_string($db, $_POST['lastname']);
	$phone= mysqli_real_escape_string($db, $_POST['phone']);
	$house= mysqli_real_escape_string($db, $_POST['house_no']);
	$username= mysqli_real_escape_string($db, $_POST['username']);
	$usercode= mysqli_real_escape_string($db, $_POST['usercode']);
	$password= mysqli_real_escape_string($db, $_POST['password']);
	$password1= mysqli_real_escape_string($db, $_POST['password1']);
	if(empty($firstname)){
		$firstnameErr="Firstname required"; $errors=1;
	}
	else{		
         $firstname=($_POST["firstname"]);
         if(!preg_match("/[a-zA-Z]/",$firstname)){
			 $firstnameErr="Only letters allowed"; $errors=1;
         } 
	}
	if(empty($lastname)){
		$lastnameErr="Lastname required"; $errors=1;
	}
	else{		
         $lastname=($_POST["lastname"]);
         if(!preg_match("/[a-zA-Z]/",$lastname)){
			 $lastnameErr="Only letters allowed"; $errors=1;
         } 
	}
	if(empty($phone)){
		$phoneErr="Phone Number required"; $errors=1;
	}
	else{
		$phone=($_POST["phone"]);
		if(!preg_match("/^(\+254|0)\d{9}$/",$phone)){
			$phoneErr="Invalid Phone number"; $errors=1;
		}
	}
	if(empty($house)){
		$houseErr="House number required"; $errors=1;
	}
	if(empty($username)){
		$usernameErr="Username required"; $errors=1;
	}
	else{		
         $username=($_POST["username"]);
         if(!preg_match("/[a-zA-Z]*$/",$username)){
			 $usernameErr="Only letters and white space allowed"; $errors=1;
         }
        else{
			$query = "SELECT * FROM user WHERE username='$username' LIMIT 1";
            $results = mysqli_query($db, $query);
                if (mysqli_num_rows($results)==1) {
                $usernameErr="Username already exists"; $errors=1;
                }
		    }		 
	}
	if(empty($usercode)){
		$usercodeErr="Usercode required"; $errors=1;
	}
	if(empty($password)){
		$passwordErr="Password required"; $errors=1;
	}
	else{
	if ($password1 != $password) {
	$passwordErr="The two passwords do not match"; $errors=1;
    }
	}
	if ($errors == 0) {
  	$password = md5($password);

  	$query = "INSERT INTO user (firstname, lastname, phone, house_no, username, usercode, password) 
  			  VALUES('$firstname', '$lastname', '$phone', '$house', '$username', '$usercode', '$password')";
  	mysqli_query($db, $query);
  	//$_SESSION['username'] = $username;
  	$_SESSION['success'] = "Successfully Registered";
	}
}
if(isset($_GET['del'])){
	$id=$_GET['del'];
	$record=mysqli_query($db,"DELETE FROM user WHERE id=$id");
	$_SESSION['message']="Member deleted";
}
if(isset($_POST['update'])){
	$id=$_POST['id'];
	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
	$phone=$_POST['phone'];
	$house=$_POST['house_no'];
	$username=$_POST['username'];
	if(empty($firstname)){
		$firstnameErr="Firstname required"; $errors=1;
	}
	else{
		$firstname=($_POST["firstname"]);
         if(!preg_match("/[a-zA-Z]/",$firstname)){
		 $firstnameErr="Only letters allowed"; $errors=1;}
	}
	if(empty($lastname)){
		$lastnameErr="Lastname required"; $errors=1;
	}
	else{
		$lastname=($_POST["lastname"]);
         if(!preg_match("/[a-zA-Z]/",$firstname)){
		 $lastnameErr="Only letters allowed"; $errors=1;}
	}
	if(empty($phone)){
		$phoneErr="Phone number required"; $errors=1;
	}
	else{
		$phone=($_POST["phone"]);
		if(!preg_match("/^(\+254|0)\d{9}$/",$phone)){
		$phoneErr="Invalid Phone number"; $errors=1;}
	}
	if(empty($house)){
		$houseErr="House number required"; $errors=1;
	}
	if(empty($username)){
		$usernameErr="Username required"; $errors=1;
	}
	else{
		$username=($_POST["username"]);
         if(!preg_match("/[a-zA-Z]*$/",$username)){
			 $usernameErr="Only letters and white space allowed"; $errors=1;
		 }
	}
	if ($errors == 0) {
	$query = "UPDATE user SET firstname='$firstname', lastname='$lastname', phone='$phone', house_no='$house', username='$username' WHERE id=$id";
  	mysqli_query($db, $query);
	$_SESSION['message']="Member updated";
	}
}
?>
