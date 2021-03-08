<!DOCTYPE html>
<html>
<head>
	<title></title>
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
		padding:5px;
		margin:15px;
	}
	
</style>
</head>
<body>
	<a href="<?php echo base_url()?>first/index"> BACK HOME </a>
	<form name="myform" action="<?php echo base_url()?>first/registrationForm" method="POST">

		<table>
			<h1>Registration form</h1>
			<tr><td>
				FIRST NAME:</td><td><input type="text" name="fname" placeholder="firstname" pattern=".{3,}"   required title="3 characters minimum" maxlength="25"></td></tr>
			<tr><td>
				LAST NAME:</td><td><input type="text" name="lname"  placeholder="lastname" pattern=".{3,}"   required title="3 characters minimum"  maxlength="25"></td></tr>
			<tr><td>
				DATE OF BIRTH:</td><td><input type="date" name="dob" required ></td></tr>
				<tr><td>
				DISTRICT:</td><td><select name="dis">
					<option>TRIVANDRUM</option> 
					<option>KOLLAM</option> 
					<option>KOZHIKODE</option> 
					<option>KANNUR</option> 
				</select>
				</td></tr>

			<tr><td>
				ADDRESS:</td><td><textarea name="address"></textarea></td></tr>
			<tr><td>	
				PHONE NUMBER:</td><td><input type="text" name="phno" id="phno" placeholder="phoneno" required minlength="10"maxlength="12"></td><td><span id="phno_result"></td></span></tr>
				<tr><td>	
				PINCODE:</td><td><input type="text" name="pin"   placeholder="Enter your pincode" required minlength="5"maxlength="10"></td></tr>
				<tr><td>	
				USERNAME:</td><td><input type="text" name="uname" id="uname" placeholder="Enter your username" required minlength="12"maxlength="12"></td><td><span id="uname_result"></td></span></tr></tr>
			<tr><td>	
				EMAIL ID:</td><td><input type="email" name="email" id="email" required></td><span id="email_result"></span></tr>
			
			<tr><td>
				PASSWORD:</td><td><input type="password" name="password" placeholder="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"></td></td></tr>
				</table>
				<input type="submit" name="submit" align="center">
		
	</form>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>  
 $(document).ready(function(){  
      $('#email').change(function(){  
           var email = $('#email').val();  
           if(email != '')  
           {  
                $.ajax({  
                     url:"<?php echo base_url(); ?>first/email_availibility",  
                     method:"POST",  
                     data:{email:email},  
                     success:function(data){  
                          $('#email_result').html(data);  
                     }  
                });  
           }  
      });  

      $('#phno').change(function(){  
           var phno = $('#phno').val();  
           if(phno != '')  
           {  
                $.ajax({  
                     url:"<?php echo base_url(); ?>first/phno_availability",  
                     method:"POST",  
                     data:{phno:phno},  
                     success:function(data){  
                          $('#phno_result').html(data);  
                     }  
                });  
           }  
      });  
       $('#uname').change(function(){  
           var uname = $('#uname').val();  
           if(uname != '')  
           {  
                $.ajax({  
                     url:"<?php echo base_url(); ?>first/uname_availability",  
                     method:"POST",  
                     data:{uname:uname},  
                     success:function(data){  
                          $('#uname_result').html(data);  
                     }  
                });  
           }  
      });  
 });  
 </script>  

<!--</body>
</html>-->








 
 
</body>
</html>