<?php
include('index.php');
?>
<HTML>
<head>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<form action="" method="post">
<div class="input-group"><p><label>USERNAME</label>
<div class="input-group"><input type="text" name="username" value="" /></p></div>
<div class="error"><?php echo $usernameErr  ?></div>
<p><label>POSITION</label></p>
<select name="position">
<option>--Select position--</option>
<option>Admin</option>
<option>Caretaker</option>
<option>User</option>
</select>
<p><label>PASSWORD</label>
<div class="input-group"><input type="password" name="password" value="" /></p></div>
<div class="error"><?php echo $passwordErr  ?></div>
<div class="input-group"><input type="submit" class="btn" name="login" value="LOGIN" /></div>
</form>

</body>
</HTML>