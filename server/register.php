<html>
<body>
<div align="center">
<?php
	

	if($_POST['username'] == NULL || $_POST['password'] == NULL || $_POST['password'] == "e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855"){
		exit(header('Location: ../client/register.html'));
	}
	
	$input_username = $_POST['username'];
	$input_password = $_POST['password'];
	
	$register = 0;
	foreach(file('../database/users.txt') as $line) {
		list($username, $password) = explode(",",$line);
		if($username == $input_username){
			$register = 1; // in case username exist
			break;
		}
	}
	
	if($register == 1){
		echo "The user exist!";
	}else{
		$file = fopen("../database/users.txt","a");
		fwrite($file,$input_username.",".$input_password."\n");
		fclose($file);
		echo "The user has been registered";
	}
	
	echo "<br/><a href='../database/users.txt'>users.txt</a>";
	echo "<br/><a href='../client/register.html'>register</a>";
	echo "<br/><a href='../client/login.html'>login</a>";
?>
</div>
</body>
</html>
