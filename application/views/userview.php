<!DOCTYPE html>
<html>
<head>
	<title> USER VIEW</title>
</head>
<body>
	<a href="<?php echo base_url()?>first/index"> BACK HOME </a>
	<form method="get" action="<?php echo base_url();?>first/flview">
	<table border="1">
		<tr>
			<th>ID</th>
			<th>FIRST NAME</th>
			<th>LAST NAME</th>
			<th>DATE OF BIRTH</th>
			<th>DISTRICT</th>
			<th>ADDRESS</th>
			<th>PHONE NUMBER</th>
			<th>PINCODE</th>
			<th>USERNAME</th>
			<th>EMAIL</th>
			<th>DELETE</th>
			<th>APPROVE</th>
			<th>REJECT</th>
			
			

			
		</tr>
	</thead>
	
		<?php 
		if($n->num_rows()>0)
		{
			foreach ($n->result() as $row)
			 {
				
		?>
				<tr>
					<td><?php echo $row->id;?></td>
					<td><?php echo $row->fname;?></td>
					<td><?php echo $row->lname;?></td>
					<td><?php echo $row->dob;?></td>
					<td><?php echo $row->district;?></td>
					<td><?php echo $row->address;?></td>
					<td><?php echo $row->phno;?></td>
					<td><?php echo $row->pin;?></td>
					<td><?php echo $row->username;?></td>
					<td><?php echo $row->email;?></td>
					<input type="hidden" value="<?php echo $row->id;?>">
					<td><a href="<?php echo base_url()?>first/flightdelete/<?php echo $row->id;?>">DELETE</a></td>

		
				<?php
					if($row->status==1)
					{?>
						<td>Approved</td>
						<td><a href="<?php echo base_url()?>first/rejectdetails/<?php echo $row->id;?>">Reject</a></td>
					<?php
					}
					elseif($row->status==2)
					{
						?>
						<td><a href="<?php echo base_url()?>first/approvedetails/<?php echo $row->id;?>">Approve</a></td>
						<td>Rejected</td>
						<?php
						}
						else
						{

						?>
					<td><a href="<?php echo base_url()?>first/approvedetails/<?php echo $row->id;?>">Approve</a></td>
					<td><a href="<?php echo base_url()?>first/rejectdetails/<?php echo $row->id;?>">Reject</a></td>
				</tr>
				
					<?php
					}
				}
				}
					?>

			</tbody>

		</table>
	</form>
</body>
</html>