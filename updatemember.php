<?php
include('view.php');
$db=mysqli_connect('localhost','root','','houses');
$firstname=$secondname=$gender=$message="";
$firstnameErr=$secondnameErr=$genderErr="";
$errors=0;
if(isset($_POST['update'])){
	$id=$_POST['id'];
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
    $query = "UPDATE members SET firstname='$firstname', secondname='$secondname', gender='$gender' WHERE id=$id";
  	mysqli_query($db, $query);
	$message=".....Member Successfully Updated.....";
  }
}
?>
<html>
<form action="updatemember.php" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>"/>
<label>FirstName</label></br>
<input type="text" name="firstname" value="<?php echo $firstname; ?>"/></br>
<?php echo $firstnameErr; ?><br>
<label>SecondName</label></br>
<input type="text" name="secondname" value="<?php echo $secondname; ?>"/></br>
<?php echo $secondnameErr; ?><br>
<label>Gender</label></br>
<input type="radio" name="gender" value="Male" checked/>Male
<input type="radio" name="gender" value="Female"/>Female</br>
<?php echo $genderErr; ?><br>
<input type="submit" name="update" placeholder="Submit" /></br>
<?php echo $message; ?><br>
</form>
</html>