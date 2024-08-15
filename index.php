<?php 
	if(isset($_GET['pesan'])){
		if($_GET['pesan']=="gagal"){
			echo "<div class='alert'>Username dan Password tidak sesuai !</div>";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>FORM LOGIN</title>
        <link rel="shortcut icon" type="image/x-icon" href="admin/logo-removebg-preview.ico">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
 
	<div class="kotak_login">
		<img src="img/logo-removebg-preview.png" width="100px" style="margin-left: 35%;">
		<p class="tulisan_login">Silahkan login</p>
 
		<form action="cek_login.php" method="post" autocomplete="off">
			<label>Username</label>
			<input type="text" name="username" class="form_login" placeholder="Username .." required="required">
 
			<label>Password</label>
			<input type="password" name="password" class="form_login" placeholder="Password .." required="required">
 
			<input type="submit" class="tombol_login" value="LOGIN">
			<br/>
			<br/>
		</form>
		
	</div>
 
 
</body>
</html>