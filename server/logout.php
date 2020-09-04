<div align="center">
<?php
	session_start();
	unset($_SESSION['userlogin']);
	
	echo "You have logged out";
	echo "<br/><br/><a href='../client/login.html'>login</a>";
?>
</div>
