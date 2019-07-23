<?php
include('index.php');
if(empty($_SESSION['username'])){
	header('location:login.php');
}
$db=mysqli_connect('localhost','root','','houses');
$firstname=$lastname=$phone=$plot=$username=$password=$password1="";
$firstnameErr=$lastnameErr=$phoneErr=$plotErr=$usernameErr=$passwordErr="";
$errors=0;
$update="";
if(isset($_GET['update'])){
	$id=$_GET['update'];
	$update= true;
	$record=mysqli_query($db,"SELECT * FROM user WHERE id=$id");
	while($row=mysqli_fetch_array($record)){
		$firstname=$row['firstname'];
		$lastname=$row['lastname'];
		$phone=$row['phone'];
		$house=$row['house_no'];
		$username=$row['username'];
	}
	
}
if(isset ($_POST['add']))
{
	$firstname= mysqli_real_escape_string($db, $_POST['firstname']);
	$lastname= mysqli_real_escape_string($db, $_POST['lastname']);
	$phone= mysqli_real_escape_string($db, $_POST['phone']);
	$plot= mysqli_real_escape_string($db, $_POST['plot_no']);
	$username= mysqli_real_escape_string($db, $_POST['username']);
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
	if(empty($plot)){
		$plotErr="Plot number required"; $errors=1;
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
			$query = "SELECT * FROM caretaker WHERE username='$username' LIMIT 1";
            $results = mysqli_query($db, $query);
                if (mysqli_num_rows($results)==1) {
                $usernameErr="Username already exists"; $errors=1;
                }
		    }			
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

  	$query = "INSERT INTO caretaker (firstname, lastname, phone, plot_no, username, password) 
  			  VALUES('$firstname', '$lastname', '$phone', '$plot', '$username', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['message'] = "Successfully Registered";
  }
}
if(isset($_GET['del'])){
	$id=$_GET['del'];
	$record=mysqli_query($db,"DELETE FROM caretaker WHERE id=$id");
	$_SESSION['message']="Member deleted";
}
if(isset($_POST['update'])){
	$id=$_POST['id'];
	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
	$phone=$_POST['phone'];
	$plot=$_POST['plot_no'];
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
	if(empty($plot)){
		$plotErr="House number required"; $errors=1;
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
	$query = "UPDATE caretaker SET firstname='$firstname', lastname='$lastname', phone='$phone', plot_no='$plot', username='$username' WHERE id=$id";
  	mysqli_query($db, $query);
	$_SESSION['message']="Member updated";
	}
}
?>
<HTML>
<head>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div>
<?php if(isset($_SESSION['username'])): ?>
<p>  <?php echo $_SESSION['username']; ?></p>
<a href="login.php?logout='1'" style="color:red;">Log out</a>
<?php endif ?>
</div>
<?php if(isset($_SESSION['message'])):?>
<div class="msg">
<?php 
echo $_SESSION['message'];
unset ($_SESSION['message']);
?>
</div>
<?php endif ?>
<?php $result=mysqli_query($db,"SELECT * FROM caretaker "); ?>
<table>
<thead>
<tr>
<th>First Name</th>
<th>Last Name</th>
<th>Phone</th>
<th>Plot</th>
<th>Username</th>
<th colspan="2">Action</th>
</tr>
</thead>
<?php while($row = mysqli_fetch_array( $result )) { ?>
<tr>
<td><?php echo $row['firstname']; ?></td>
<td><?php echo $row['lastname']; ?></td>
<td><?php echo $row['phone']; ?></td>
<td><?php echo $row['plot_no']; ?></td>
<td><?php echo $row['username']; ?></td>
<td><a href="admin_caretaker.php?del=<?php echo $row['id']?>" class="del_btn">Delete</a></td>
<td><a href="admin_caretaker.php?update=<?php echo $row['id']?>" class="edit_btn">Update</a></td>
</tr>
<?php } ?>
</table>
<form action="" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>"/>
<div class="input-group"><input type="text" name="firstname" placeholder="FirstName" value="<?php echo $firstname;?>"/><br></div>
<div class="error"><?php echo $firstnameErr; ?><br></div>
<div class="input-group"><input type="text" name="lastname" placeholder="LastName" value="<?php echo $lastname;?>"/><br></div>
<div class="error"><?php echo $lastnameErr; ?><br></div>
<div class="input-group"><input type="number" name="phone" placeholder="PhoneNumber" value="<?php echo $phone;?>"/><br></div>
<div class="error"><?php echo $phoneErr; ?><br></div>
<div class="input-group"><input type="number" name="plot_no" placeholder="PlotNo" value="<?php echo $plot;?>"/><br></div>
<div class="error"><?php echo $plotErr; ?><br></div>
<div class="input-group"><input type="text" name="username" placeholder="Username" value="<?php echo $username;?>"/><br><div>
<div class="error"><?php echo $usernameErr; ?><br></div>
<div class="input-group"><input type="password" name="password1" placeholder="Password" /><br></div>
<div class="input-group"><input type="password" name="password" placeholder="Confirm Password" /><br></div>
<div class="error"><?php echo $passwordErr; ?><br></div>
<?php if($update == true):?>
<div class="input-group"><button class="btn" type="submit" name="update" >Update</button><div>
<?php else:?>
<div class="input-group"><button class="btn" type="submit" name="add" >Add</button></div>
<?php endif ?>
</form>
</body>
</HTML>