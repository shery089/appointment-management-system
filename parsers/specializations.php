<?php 
	$specializations = $_POST['specializations'];
	for ($i = 0, $count = count($specializations); $i < $count; $i++) 
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
	}
?>