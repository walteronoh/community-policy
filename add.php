<?php include('index.php'); ?>
<?php include('view.php'); ?>
<?php
$update="";
if(isset($_GET['update'])){
	$id=$_GET['update'];
	$update= true;
	$record=mysqli_query($db,"SELECT * FROM members WHERE id=$id");
	while($row=mysqli_fetch_array($record)){
		$firstname=$row['firstname'];
		$secondname=$row['secondname'];
		$gender=$row['gender'];
	}
	
}
if(isset($_GET['del'])){
	$id=$_GET['del'];
	$record=mysqli_query($db,"DELETE FROM members WHERE id=$id");
	$_SESSION['message']="Member deleted";
}
if(isset($_POST['update'])){
	$id=$_POST['id'];
	$firstname=$_POST['firstname'];
	$secondname=$_POST['secondname'];
	$gender=$_POST['gender'];
	$query = "UPDATE members SET firstname='$firstname', secondname='$secondname', gender='$gender' WHERE id=$id";
  	mysqli_query($db, $query);
	$_SESSION['message']="Member updated";
}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div>
<?php if(isset($_SESSION['success'])): ?>
<div>
<h2 style="color:lime;"><?php echo $_SESSION['success'];
unset($_SESSION['success']); ?>
</h2>
</div>
<?php endif ?>
<?php if(isset($_SESSION['username'])): ?>
<p>Welcome  <?php echo $_SESSION['username']; ?></p>
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
<?php $result=mysqli_query($db,"SELECT * FROM members "); ?>
<table>
<thead>
<tr>
<th>First Name</th>
<th>Last Name</th>
<th>Gender</th>
<th colspan="2">Action</th>
</tr>
</thead>
<?php while($row = mysqli_fetch_array( $result )) { ?>
<tr>
<td><?php echo $row['firstname']; ?></td>
<td><?php echo $row['secondname']; ?></td>
<td><?php echo $row['gender']; ?></td>
<td><a href="add.php?del=<?php echo $row['id']?>" class="del_btn">Delete</a></td>
<td><a href="add.php?update=<?php echo $row['id']?>" class="edit_btn">Update</a></td>
</tr>
<?php } ?>
</table>
<form action="add.php" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>"/>
<div class="input-group"><label>FirstName</label></br>
<input type="text" name="firstname" value="<?php echo $firstname; ?>"/></br></div>
<?php echo $firstnameErr; ?><br>
<div class="input-group"><label>SecondName</label></br>
<input type="text" name="secondname" value="<?php echo $secondname; ?>"/></br></div>
<?php echo $secondnameErr; ?><br>
<label>Gender</label></br>
<input type="radio" name="gender" value="Male" checked value="<?php echo $gender; ?>"/>Male 
<input type="radio" name="gender" value="Female"/>Female</br>
<?php echo $genderErr; ?><br>
<?php if($update == true):?>
<div class="input-group"><button class="btn" type="submit" name="update" >Update</button><div>
<?php else:?>
<div class="input-group"><button class="btn" type="submit" name="add" >Add</button></div>
<?php endif ?>
</form>
</body>
</html>