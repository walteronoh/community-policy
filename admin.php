<?php
include('index.php');
if(empty($_SESSION['username'])){
	header('location:login.php');
}
?>
<HTML>
<head>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div class="admincent">
<div>
<?php if(isset($_SESSION['success'])): ?>
<div>
<h2 style="color:lime;"><?php echo $_SESSION['success'];
unset($_SESSION['success']); ?>
</h2>
</div>
<?php endif ?>
<?php if(isset($_SESSION['username'])): ?>
<a>Welcome  <?php echo $_SESSION['username']; ?></a></br>
<a href="login.php?logout='1'" style="color:red;">Log out</a>
<?php endif ?>
</div>
<div class="admin">

			<p><a href="admin_caretaker.php">View caretakers</a></p>
			<p><a href="rental.php">View users</a></p>
	
</div>
</div>
</body>
</HTML>