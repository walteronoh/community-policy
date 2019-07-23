<?php
session_start();
$db=mysqli_connect('localhost','root','','houses');
//echo uniqid();
$username=$position=$password=$message="";
$usernameErr=$positionErr=$passwordErr="";
$errors=0;
if(isset($_POST['login']))
{
	$username= mysqli_real_escape_string($db, $_POST['username']);
	$position= mysqli_real_escape_string($db, $_POST['position']);
	$password= mysqli_real_escape_string($db, $_POST['password']);
	if (empty($username)) {
    $usernameErr="Username is required"; $errors=1;
    }
    if (empty($password)) {
    $passwordErr="Password is required"; $errors=1;
    }
if ($errors == 0) {
switch($position){
case "Admin":
    //$password = md5($password);
    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results)==1) {
      $_SESSION['username'] = $username;
      $_SESSION['success'] = "You are now logged in as Admin";
      header('location:admin.php ');
    }else { 
    }
break;

case "Caretaker":
    $password = md5($password);
    $query = "SELECT * FROM caretaker WHERE username='$username' AND password='$password'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results)==1) {
      $_SESSION['username'] = $username;
      $_SESSION['success'] = "You are now logged in as Caretaker";
      header('location:admin_user.php ');
    }else { 
    }
break;

case "User":
    $password = md5($password);
    $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results)==1) {
      $_SESSION['username'] = $username;
      $_SESSION['success'] = "You are now logged in as user";
      header('location:homepage.php ');
    }else { 
    }
break;
}
}else{}
}
if(isset($_GET['logout']))
{
session_destroy();
unset($_SESSION['username']);
header('location:login.php');
}
?>

