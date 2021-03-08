	<!DOCTYPE html>
<html>
<head>
<title>login</title>
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
	<a href="<?php echo base_url()?>first/index"> BACK HOME </a>

	<form method="post" action="<?php echo base_url()?>first/login">
		<table>
			<tr>
				<td>email</td>
		<td><input type="email" name="email" placeholder="email"></td>
			</tr>
			<tr>
		<td>password</td>
			<td><input type="password" name="password" placeholder="password"></td>
		</tr>
		<tr>

		<td><input type="submit" name="submit" value="login"></td>
		<td><a href="<?php echo base_url()?>first/forget">FORGOT PASSWORD </a> </td>
		<td><a href="<?php echo base_url()?>first/resetpassword">RESET PASSWORD </a> </td>

		</tr>
		</table>
	</form>
</body>
</html>