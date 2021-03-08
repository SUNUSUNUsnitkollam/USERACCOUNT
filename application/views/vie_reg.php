<!DOCTYPE html>
<html>
<head>
	<title>Reg Form</title>
</head>
<body>
	<form method="post" action=" ">
	<table border="1">
		<tr>
			<th>firstname</th>
			<th>lastname</th>
			<th>username</th>
			<th>mobile</th>
			<th>email</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
		<?php 
		if($n->num_rows()>0)
		{
			foreach ($n->result() as $row)
			 {
				
		?>
				<tr>
					<td><?php echo $row->firstname;?></td>
					<td><?php echo $row->lastname;?></td>
					<td><?php echo $row->username;?></td>
					<td><?php echo $row->mobile;?></td>
					<td><?php echo $row->email;?></td>
					<?php
					if($row->status==1)
					{
						?>
						<td>Approved</td>
						<td><a href="<?php echo base_url()?>first/reject/<?php echo $row->id;?>">reject</a></td>
						<?php
					}
					elseif($row->status==2)
					{
						?>
						<td>Rejected</td>
						<td><a href="<?php echo base_url()?>first/approve/<?php echo $row->id;?>"> approve</a></td>
						<?php
					}
					else
					{
						?>
					<td><a href="<?php echo base_url()?>first/approve/<?php echo $row->id;?>"> approve</a></td>
					<td><a href="<?php echo base_url()?>first/reject/<?php echo $row->id;?>">reject</a></td>
					</tr>
					<?php			
				}
			}
		}
		?>
		</table>
		</form>
		
</body>
</html>