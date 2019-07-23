<?php include('index.php')?>
<?php include('personal.php')?>
<?php

if(isset($_POST['generate'])){
$chars='0123456789abcdefghijklmnopqrstuvwxyz';
$userid=substr(str_shuffle($chars), 0,6);}
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
?>
<HTML>
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
<?php $result=mysqli_query($db,"SELECT * FROM user "); ?>
<table>
<thead>
<tr>
<th>First Name</th>
<th>Last Name</th>
<th>Phone</th>
<th>House</th>
<th>Username</th>
<th>Usercode</th>
<th colspan="2">Action</th>
</tr>
</thead>
<?php while($row = mysqli_fetch_array( $result )) { ?>
<tr>
<td><?php echo $row['firstname']; ?></td>
<td><?php echo $row['lastname']; ?></td>
<td><?php echo $row['phone']; ?></td>
<td><?php echo $row['house_no']; ?></td>
<td><?php echo $row['username']; ?></td>
<td><?php echo $row['usercode']; ?></td>
<td><a href="admin_user.php?del=<?php echo $row['id']?>" class="del_btn">Delete</a></td>
<td><a href="admin_user.php?update=<?php echo $row['id']?>" class="edit_btn">Update</a></td>
</tr>
<?php } ?>
</table>
<form action="admin_user.php" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>"/>
<?php if($update == true):?>
<div class="input-group"><input type="text" name="firstname" placeholder="FirstName" value="<?php echo $firstname;?>" /><br></div>
<?php echo $firstnameErr; ?><br>
<div class="input-group"><input type="text" name="lastname" placeholder="LastName" value="<?php echo $lastname;?>"/><br></div>
<?php echo $lastnameErr; ?><br>
<div class="input-group"><input type="number" name="phone" placeholder="PhoneNumber" value="<?php echo $phone;?>"/><br></div>
<?php echo $phoneErr; ?><br>
<div class="input-group"><input type="text" name="house_no" placeholder="HouseNo" value="<?php echo $house;?>"/><br></div>
<?php echo $houseErr; ?><br>
<div class="input-group"><input type="text" name="username" placeholder="Username" value="<?php echo $username;?>"/><br></div>
<?php echo $usernameErr; ?><br>
<div class="input-group"><button class="btn" type="submit" name="update" >Update</button></div>
<?php else:?>
<div class="input-group"><input class="btn" type="submit" name="generate" value="Generate Usercode"/></br></div>
<div class="input-group"><input type="text" name="usercode" value="<?php echo $userid;?>" /><br></div>
<?php echo $usercodeErr; ?><br>
<div class="input-group"><input type="text" name="firstname" placeholder="FirstName" value="<?php echo $firstname;?>" /><br></div>
<?php echo $firstnameErr; ?><br>
<div class="input-group"><input type="text" name="lastname" placeholder="LastName" value="<?php echo $lastname;?>"/><br></div>
<?php echo $lastnameErr; ?><br>
<div class="input-group"><input type="number" name="phone" placeholder="PhoneNumber" value="<?php echo $phone;?>"/><br></div>
<?php echo $phoneErr; ?><br>
<div class="input-group"><input type="text" name="house_no" placeholder="HouseNo" value="<?php echo $house;?>"/><br></div>
<?php echo $houseErr; ?><br>
<div class="input-group"><input type="text" name="username" placeholder="Username" value="<?php echo $username;?>"/><br></div>
<?php echo $usernameErr; ?><br>
<div class="input-group"><input type="password" name="password1" placeholder="Password" /><br></div>
<div class="input-group"><input type="password" name="password" placeholder="Confirm Password" /><br></div>
<?php echo $passwordErr; ?><br>
<div class="input-group"><button class="btn" type="submit" name="add" >Add</button></div>
<?php endif ?>
<?php echo $message; ?>
</form>
</body>
</HTML>