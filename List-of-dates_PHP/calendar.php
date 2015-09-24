<?php
function &calendar($FormName,$InputName)
{
$menu = array(
    "1,Январь",
    "2,Февраль",
    "3,Март",
    "4,Апрель",
    "5,Май",
    "6,Июнь",
    "7,Июль",
    "8,Август",
    "9,Сентябрь",
    "10,Октябрь",
    "11,Ноябрь",
    "12,Декабрь"
    );

$date = new DateTime(strftime("%Y-%m-%d"));
$CurDay = date_format($date,"j");
$FCurDay = date_format($date,"d");
$CurMonth = date_format($date,"n");
$FCurMonth = date_format($date,"m");
$CurYear = date_format($date,"Y");
$ChValue = "$CurYear-$FCurMonth-$FCurDay";
if ((isset($_POST['SetMonth'])) && ($_POST['SetMonth'] != $CurMonth) ) 
{
  $DeltaMonth = $_POST['SetMonth']-$CurMonth;
 
  $d28 = $CurDay-28;
  if ($d28 > 0) 
  {
    $modif = "-$d28 day";
    $date -> modify($modif);
  }

  $modif = "$DeltaMonth month";
  if ($DeltaMonth > 0) $modif = "+$modif";
  $date -> modify($modif);
}
if ( (isset($_POST['SetYear'])) && ($_POST['SetYear'] != $CurYear) ) 
{
   $DeltaYear = $_POST['SetYear']-$CurYear;
   $modif = "$DeltaYear year";
   if ($DeltaYear > 0) $modif = "+$modif";
   $date -> modify($modif);
}
if ( (isset($_POST['ChoiseD'])) ) 
{
    $ChValue = $_POST['ChoiseD'];
}

$NewMonth = date_format($date,"n");
$FNewMonth = date_format($date,"m");
$NewYear = date_format($date,"Y");
echo "<form name='Calendar' action='' method='POST'>\n";
echo "<table><tr><td>";
echo "<select name='SetMonth' onchange='this.form.submit()'>";
foreach ($menu as $value) {
    $submenu = preg_split("/\,/", $value);
    $selected = "";
    if ($submenu[0] == $NewMonth) $selected = "selected";
    echo "<option $selected value = '$submenu[0]'>$submenu[1]</option>";
}     
echo "</select></td><td>";
echo "<input type='button' value='<' size=1 onclick='SetYear.value=$NewYear-1; this.form.submit()' />";
echo "<input type='text' name='SetYear' value='$NewYear' size=4 maxlength=4 readonly />";
echo "<input type='button' value='>' size=1 onclick='SetYear.value=$NewYear+1; this.form.submit()' />";
echo "</td></tr></table>";
echo "<table border='1'>";
$mnth = $NewMonth;
echo "<tr bgcolor=#D3D3D3><td>Пн</td><td>Вт</td><td>Ср</td><td>Чт</td><td>Пт</td><td>Сб</td><td>Вс</td></tr>\n";
$i=1;
$j=1;
echo "<tr>";
$LastDay = date_format($date,"j");
$DeltaDay = $LastDay-$j;
$modifm = "-$DeltaDay day";
$date -> modify($modifm);
while ($mnth == $NewMonth) {
  $LastDay = date_format($date,"j");
  $FLastDay = date_format($date,"d");
  $dw = date_format($date,"w");
  if ($dw == $i) {
    if (($LastDay == $CurDay) && ($CurMonth == $NewMonth) && ($CurYear == $NewYear) ) {
      $color="green";
    } else if (($i == 0) | ($i == 6)) {
      $color="red";
    } else {
      $color="#FFFFFF";
    }
    echo "<td bgcolor=$color
		onmouseover=\"this.style.backgroundColor='blue'; this.style.color='white'\"
		onmouseout=\"this.style.backgroundColor='$color'; this.style.color='black'\"
		onClick=\"$FormName.$InputName.value='$FLastDay-$FNewMonth-$NewYear'\">$LastDay</td>";
    $modifp = "+1 day";
    $date -> modify($modifp);
    $j++;
  } else {
    if (($i == 0) | ($i == 6)) {
      $color="red";
    } else {
      $color="#FFFFFF";
    }
    echo "<td bgcolor=$color></td>";
  }
  $mnth = date_format($date,"n");
  $i++;
  if ($i == 1) echo "</tr><tr>";  
  if ($i > 6) {
    $i=0;
  }
}
echo "</tr></table></form>";

}
?>