<?php
function print_row($height)
{
$white = round(200*(1 - abs($height-0.01)));
echo '<td> </td><td width="15" align="center"><table cellpadding="0" cellspacing="0">
<tr><td colspan="2" height="';
print $white;
echo '" width="15"> </td></tr>
<tr><td colspan="2" bgcolor="gray" height="1" width="15"></td></tr>
<tr><td bgcolor="#9AAEDE" height="';
print 199-$white;
echo '" width="15"> </td><td bgcolor="gray" width="1"></td></tr>
</table></td><td> </td>';
}

function print_row_array($day_order, $array)
{
$rows_number = count($array);
$colspan=$rows_number*3;
$max_value = 1; //to normalize

foreach($array as $item) if ($item > $max_value) $max_value = $item;
echo "<br><center><table border=\"0\" height=\"200\" cellpadding=\"0\" cellspacing=\"0\">
<tr><td rowspan=\"2\">
<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td valign=\"top\" height=\"200\"><div class=\"standard\">$max_value &nbsp;</div></td>
<td width=\"2\" bgcolor=\"black\"><img border=\"0\" width=\"2\" height=\"1\"></td></tr></table>
</td></tr><tr>";
for ($i=$rows_number-1; $i>=0; $i--) print_row ($array[$day_order[$i]] / $max_value);
echo '<tr><td></td><td height="2" bgcolor="black" colspan="';
print $colspan-1;
echo '"></td></tr><tr><td></td>';
for ($i=$rows_number-1; $i>=0; $i--) print "<td colspan=\"3\" width=\"25\" align=\"center\"><div class=\"standard\">&nbsp;" . $day_order[$i] . "&nbsp;</div></td>";
print "</tr><tr><td colspan=\"$colspan\" align=\"right\"><div class=\"standard\">Time -></div></td></tr></table></center>";
}

function show_statistics($show = "week")
{
	global $users;
	$day = 60*60*24;
	$month = $day*30;
	$timestamp = time();
	$rows = array();
	$day_order = array();
	
	if($show != "year"){
		$count = 0;
		$x_axis = "";
		if ($show == "week") {$count = 7; $x_axis = "D";}
		else {$count = 31; $x_axis = "j";}
		for ($i=0; $i<$count; $i++) {
			$day_name = date($x_axis, ($timestamp - $i*$day));
			if (!in_array($day_name, $day_order)) { //avoids sovrappositions
				$day_order[$i] = $day_name;
				$rows[$day_name] = 0;
				foreach($users as $item) 
					if ($item > ($timestamp - ($i+1)*$day) && $item < ($timestamp - $i*$day)) $rows[$day_name]++;
			}
		}
	}
	else {
		for ($i=0; $i<12; $i++) {
			$day_name = date("M", ($timestamp - $i*$month));
			$day_order[$i] = $day_name;
			$rows[$day_name] = 0;
				foreach($users as $item) 
					if ($item > ($timestamp - ($i+1)*$month) && $item < ($timestamp - $i*$month)) $rows[$day_name]++;
		}
	}
	
	print_row_array($day_order, $rows);
}

?> 
