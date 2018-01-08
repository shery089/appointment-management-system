<?php 
	$mr_number = $_POST['mr_number'];

	$sql = "SELECT * FROM patients WHERE mr_number like '% " . $mr_number . "%'";
/*	for ($i = 0, $count = count($specializations); $i < $count; $i++) 
	{
		if ($count == 1) 
		{
			echo $specializations[$i];
		}
		elseif ($i+1 == $count) 
		{
			echo $specializations[$i];
		}
		else
		{
			echo $specializations[$i] . ',';
		}
	}*/
?>