<?php
$db=mysqli_connect('localhost','root','','houses');
$firstname=$secondname=$gender="";
$firstnameErr=$secondnameErr=$genderErr="";
$errors=0;
if(isset($_POST['add'])){
	$firstname=mysqli_real_escape_string($db, $_POST['firstname']);
	$secondname=mysqli_real_escape_string($db, $_POST['secondname']);
	$gender=mysqli_real_escape_string($db, $_POST['gender']);
	if(empty($firstname)){
		$firstnameErr="First Name required";$errors=1;
	}
	if(empty($secondname)){
		$secondnameErr="Second Name required";$errors=1;
	}
	if(empty($gender)){
		$genderErr="Gender required";$errors=1;
	}
	if ($errors == 0) {
    $query = "INSERT INTO members (firstname, secondname, gender ) 
  			  VALUES('$firstname', '$secondname', '$gender')";
  	mysqli_query($db, $query);
	$_SESSION['message']="Member Successfully Added";
  }
}
?>