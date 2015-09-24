<?php
include "date.php";
include "calendar.php";
?>
<html>
<head>
<title>date_generation
</title>
<link href="style.css" rel="stylesheet">
<link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div>Укажите диапазон дат в формате dd-mm-yyyy, например, 30-12-2006, и выберите день недели из списка:</div>
<form action="index.php" name="fields" method="GET">
<input type="text" name="from" value="<?php if ($_GET['submitted'] or $_GET['calendar_from'] or $_GET['calendar_to'] or $_GET['hide']) {echo $_GET['from'];}?>"/>
<input type="submit" name="calendar_from" value="#"/>
<input type="submit" name="hide" value="<<"/>(скрыть календарь)<br>
<input type="text" name="to" value="<?php if ($_GET['submitted'] or $_GET['calendar_from'] or $_GET['calendar_to'] or $_GET['hide']) {echo $_GET['to'];}?>"/>
<input type="submit" name="calendar_to" value="#"/>

<select name='week'>
<option value="1" <?php if ($_GET['week']==1) {echo "selected";}?>>понедельник</option>
<option value="2" <?php if ($_GET['week']==2) {echo "selected";}?>>вторник</option>
<option value="3" <?php if ($_GET['week']==3) {echo "selected";}?>>среда</option>
<option value="4" <?php if ($_GET['week']==4) {echo "selected";}?>>четверг</option>
<option value="5" <?php if ($_GET['week']==5) {echo "selected";}?>>пятница</option>
<option value="6" <?php if ($_GET['week']==6) {echo "selected";}?>>суббота</option>
<option value="0" <?php if ($_GET['week']==0) {echo "selected";}?>>воскресенье</option>
</select><br>
<input type="submit" name="submitted" value="submit"/>
</form>
<?php
if($_GET["calendar_from"])
{calendar('fields','from');}

if($_GET["calendar_to"])
{
	calendar('fields','to');
}
if($_GET["submitted"])
{
	
	$range=new Range($_GET['from'],$_GET['to']);
	if(!$range->get_validation_logs())
	{
		echo "
		<table class='table table-hover'><thead><td><div>Список дат:</div></td></thead>";
		$list=$range->create_list($_GET['week']);
		for($i=0;$i<count($list);$i++)
		{
			$list[$i]=explode("-", $list[$i]);
			$newlist[$i]=$list[$i][0].".".$list[$i][1].".".$list[$i][2].' '.$list[$i][3];
			echo "<tr><td>$newlist[$i]</td></tr>";
		}
		echo "</table>";
	}
 	
}

?>

</body>

</html>
