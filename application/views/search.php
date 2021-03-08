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
		width:400px;
		text-align:center;

	}
	input
	{
		padding:10px;
		margin:20px;
	}
</style>
<body>

	<form method="post" action="<?php echo base_url()?>first/login">
		<center><table>
			<tr><td>
				DEPARTURE:</td><td><select name="dest">
					<option>TRIVANDRUM</option> 
					<option>KOCHI</option> 
					<option>KOZHIKODE</option> 
					<option>KANNUR</option> 
				</select>
				</td></tr>
			</tr>
			<tr><td>
				DESTINATION:</td><td><select name="dest">
					<option>TRIVANDRUM</option> 
					<option>KOCHI</option> 
					<option>KOZHIKODE</option> 
					<option>KANNUR</option> 
				</select>
				</td></tr>
		<tr>
				<td>DATE</td>
		<td><input type="date" name="sdate" placeholder="DATE OF JOURNEY"></td>
			</tr>
			
		<tr>
		<td><input type="submit" name="submit" value="ok"></td>
		</tr>
		</table>
	</form>
</body>
</html>