<table>
	<tr>
		<th>Order number</th>
        <th>Name</th>
        <th>Apartment</th>
        <th>Date</th>
        <th>Comment</th>
    </tr>
    
	<?php
		foreach ($result as $key => $value)
		{
	?>
	<tr>
		<td><?php echo $value[0];?></td>
        <td><a href="User_orders.php" class='link'><?php echo $value[1];?></a></td>
        <td><?php echo $value[2];?></td>
        <td><?php echo $value[3];?></td>
        <td><?php echo $value[4];?></td>
	</tr>
	<?php
		}
	?>
</table>