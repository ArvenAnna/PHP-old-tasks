<form id="rentForm">
    <table>
    <caption><h1>Order form:</h1></caption>
        <tr><td align="right" valign="top">E-mail:</td>
            <td><input type="email" name="email" size="25" class="field"></td>
        </tr>
        <tr><td align="right" valign="top" >Name:</td>
            <td><input type="text" name="name" size="25" class="field"></td>
        </tr>
        <tr><td align="right" valign="top">Apartment:</td>
		
            <td>					
			<select name="apartment">
				<?php 
					$count=count($result);
					for ($i=0; $i<$count; $i++)
					{
				?>
			<option value="<?php echo $result[$i][0]; ?>"><?php echo $result[$i][0]; ?></option>
				<?php
					}
					echo $count;
				?>
                </select>
            </td>
        </tr>
		<tr><td align="right" valign="top">Comment:</td>
            <td><textarea cols="25" rows="3" wrap="physical" name='comment'></textarea>
            </td>
        </tr>
        <tr><td align="right" colspan="2">
                <input type="submit" name="submit" value="Send">
                <input type="reset" name="reset" value="Clear">
            </td>
        </tr>
    </table>
</form>