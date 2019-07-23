<?php include('index.php'); ?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<?php $result=mysqli_query($db,"SELECT * FROM members "); ?>
<table>
<thead>
<tr>
<th>First Name</th>
<th>Last Name</th>
<th>Gender</th>
</tr>
</thead>
<?php while($row = mysqli_fetch_array( $result )) { ?>
<tr>
<td><?php echo $row['firstname']; ?></td>
<td><?php echo $row['secondname']; ?></td>
<td><?php echo $row['gender']; ?></td>
</tr>
<?php } ?>
</table>
</body>
</html>