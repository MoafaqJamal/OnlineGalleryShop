<?php
session_start(); 
if($_POST['username'] == NULL){
	header('Location: ../client/login.html');
}
?>

<html>
<body>
<div align="center">
<?php
	
	$input_username = $_POST['username'];
	$input_password = $_POST['password'];
	
	$login = 0;
	foreach(file('../database/users.txt') as $line) {
		list($username, $password) = explode(",",$line);
		if($username == $input_username){
			if($password == $input_password."\n"){
				$login = 1;
				$_SESSION['userlogin'] = $input_username;
				header('Location: ../client/gallery.php');
				break;
			}
		}
	}
	
	if($login==0){
		echo "Something went wrong!";
	}
	
	echo "<br/><a href='../database/users.txt'>users.txt</a>";
	echo "<br/><a href='../client/register.html'>register</a>";
	echo "<br/><a href='../client/login.html'>login</a>";
?>

</div>
</body>
</html>
