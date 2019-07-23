<?php
include('index.php');
if(empty($_SESSION['username'])){
	header('location:login.php');
}
$db=mysqli_connect('localhost', 'root','','houses');
$usercode=$position="";
$usercodeErr="";
$errors=0;
if(isset($_POST['submit'])){
$position=$_POST['position'];
$usercode=mysqli_real_escape_string($db,$_POST['usercode']);
if(empty($usercode)){
	$usercodeErr="Usercode required"; $errors=1;
}
if( $errors==0){
switch($position){
case "RENTAL":
    $query = "SELECT * FROM user WHERE usercode='$usercode'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results)==1) {
      $_SESSION['username'] = $username;
	header('location:add.php ');}
	else{
		$usercodeErr="Invalid Usercode"; $errors=1;
	}
break;
case "PERSONAL":
    $query = "SELECT * FROM user WHERE usercode='$usercode' ";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results)==1) {
      $_SESSION['username'] = $username;
	header('location:add.php ');}
	else{
		$usercodeErr="Invalid Usercode"; $errors=1;
	}
break;
}
}
}
?>
<HTML>
<head>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
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
<form action="" method="post">
<select name="position">
<option>--SELECT--</option>
<option>RENTAL</option>
<option>PERSONAL</option>
</select><br>
<div class="input-group"><input type="text" name="usercode" placeholder="ENTER USERCODE" /><br></div>
<?php echo $usercodeErr;?>
<div class="input-group"><input class="btn" type="submit" name="submit" value="SUBMIT" /></div>
</form>
</HTML>