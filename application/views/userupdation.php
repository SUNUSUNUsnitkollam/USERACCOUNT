<DOCTYPE html>
  <center> <table>
      <thead>
       <h1> UPDATE PROFILE</h1>
      </thead>
      <tbody>
      <body>
    <a href="<?php echo base_url()?>first/index"> BACK HOME </a>
    <center><form method="post" action="<?php echo base_url()?>first/update">

        <?php 
    if(isset($user_data)) 
    {
      foreach($user_data->result() as $row1)
      {
      ?>
      <tr>
     <h1>Updation form</h1>
      <tr><td>
        FIRST NAME:</td><td><input type="text" name="fname" placeholder="firstname"  value="<?php echo $row1->fname;?>"pattern=".{3,}"   required title="3 characters minimum" maxlength="25"></td></tr>
      <tr><td>
        LAST NAME:</td><td><input type="text" name="lname"  placeholder="lastname" value="<?php echo $row1->lname;?>" pattern=".{3,}"   required title="3 characters minimum"  maxlength="25"></td></tr>
      <tr><td>
        DATE OF BIRTH:</td><td><input type="date" name="dob"  required ></td></tr>
        <tr><td>
        DISTRICT:</td><td><select name="dis">
          <option><?php echo $row1->district;?></option>  
          <option>KOLLAM</option> 
          <option>KOZHIKODE</option> 
          <option>KANNUR</option> 
        </select>
        </td></tr>

      <tr><td>
        ADDRESS:</td><td><textarea name="address"><?php echo $row1->address;?></textarea></td></tr>
      <tr><td>  
        PHONE NUMBER:</td><td><input type="text" name="phno"  placeholder="phoneno" value="<?php echo $row1->phno;?>" required minlength="10"maxlength="12"></td></tr>
        <tr><td>  
        PINCODE:</td><td><input type="text" name="pin"  placeholder="Enter your pincode"  value="<?php echo $row1->pin;?>"required minlength="5"maxlength="10"></td></tr>
        <tr><td>  
        USERNAME:</td><td><input type="text" name="uname"  placeholder="Enter your username" value="<?php echo $row1->username;?>"required minlength="12"maxlength="12"></td></tr>
      <tr><td>  
        EMAIL ID:</td><td><input type="email" name="email"  value="<?php echo $row1->email;?>"required></td></tr>
  
        </table>
        <input type="submit" name="submit" value="update" align="center"> <tr><td>
        </tr> 
  </form>
  </tbody>
</body>
</table>
<?php
          }
        } 
        ?>

  </html>
