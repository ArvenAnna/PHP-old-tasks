<div style="margin:20px;">Information about <b style="background-color:MediumSpringGreen"><?php echo $user; ?></b></div>

<table>
    <tr> 
        <th>Order number</th>
        <th>Date</th>
    </tr>
	<?php
		foreach ($result as $key => $value)
		{
	?>
    <tr>
        <td><?php echo $value[0];?></td>
        <td><?php echo $value[1];?></td>
    </tr>
	<?php
		}
	?>
</table>