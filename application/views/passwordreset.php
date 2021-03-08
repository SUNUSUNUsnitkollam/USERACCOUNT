<!DOCTYPE html>
<html>
<head>
<title>login</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href='//fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
</head>
<style>
	form
	{
		border:2px solid;
		margin-left:400px;
		width:500px;
		text-align:center;

	}
	input
	{
		padding:10px;
		margin:20px;
	}
</style>
<body>

<div id="main">
<div id="login">
<?php echo @$error; ?>
<center><h2>Change Password</h2></center>
<br>
<form method="post" action='<?php echo base_url(); ?>first/resetpassword'>
		<label>Old Password :</label>
		<input type="password" name="old_pass" id="name" placeholder="Old Pass"/><br /><br />
		<label>New Password :</label>
		<input type="password" name="new_pass" id="password" placeholder="New Password"/><br/><br />
		<label>Confirm Password :</label>
		<input type="password" name="confirm_pass" id="password" placeholder="Confirm Password"/><br/><br />
		<input type="submit" value="RESET" name="change_pass"/><br />
</form>
</div>
</div>
</body>
</html>