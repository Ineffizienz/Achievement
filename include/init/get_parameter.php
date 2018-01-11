<?php

function getCategories($con)
{
	$cat = array();
	$result = mysqli_query($con,"SELECT ID,c_name FROM categorie");
	while($row=mysqli_fetch_array($result))
	{
		$cat[] = $row;
	}

	return $cat;
}

function getTrigger($con)
{
	$trig = array();
	$result = mysqli_query($con,"SELECT ID,trigger_title FROM ac_trigger");
	while($row=mysqli_fetch_array($result))
	{
		$trig[] = $row;
	}

	return $trig;
}

function getAchievements($con)
{
	$result = mysqli_query($con,"SELECT ID, title, image_url, message FROM achievement");
	while($row=mysqli_fetch_assoc($result))
	{
		$achievement[] = $row;
	}

	return $achievement;
}

function getAchievementByCategorie($con,$id)
{
	$ac = array();
	$result = mysqli_query($con,"SELECT ID,title,image_url,message FROM achievement WHERE ac_categorie = '$id'");
	while ($row=mysqli_fetch_assoc($result))
	{
		$ac[] = $row;
	}

	return $ac;
}

function getSingleAc($con,$id)
{
	$result = mysqli_query($con,"SELECT ID, title, image_url, message FROM achievement WHERE ID = '$id'");
	while ($row=mysqli_fetch_assoc($result))
	{
		$single_ac[] = $row;
	}

	return $single_ac;
}

function getSingleCategorie($con,$id)
{
	$result = mysqli_query($con,"SELECT ID, c_name FROM categorie WHERE ID = '$id'");
	while ($row=mysqli_fetch_assoc($result))
	{
		$single_cat[] = $row;
	}

	return $single_cat;
}

function getSingleTrigger($con,$id)
{
	$result = mysqli_query($con,"SELECT ID, trigger_title FROM ac_trigger WHERE ID = '$id'");
	while ($row=mysqli_fetch_assoc($result))
	{
		$single_trig[] = $row;
	}

	return $single_trig;
}

function getNoCatAc($con)
{
	$no_cat = array();
	$result = mysqli_query($con,"SELECT title, image_url, message FROM achievement WHERE ac_categorie = '0'");
	while($row=mysqli_fetch_assoc($result))
	{
		$no_cat[] = $row;
	}

	return $no_cat;
}

function getAcCategorie($con,$id)
{
	$result = mysqli_query($con,"SELECT ac_categorie FROM achievement WHERE ID = '$id'");
	while($row=mysqli_fetch_array($result))
	{
		$ac_cat = $row["ac_categorie"];
	}

	return $ac_cat;
}

function getAcTrigger($con,$id)
{
	$result = mysqli_query($con,"SELECT ac_trigger FROM achievement WHERE ID = '$id'");
	while($row=mysqli_fetch_array($result))
	{
		$ac_trig = $row["ac_trigger"];
	}

	return $ac_trig;
}

function getCurrentImage($con,$acid)
{
	$result = mysqli_query($con,"SELECT image_url FROM achievement WHERE ID = '$acid'");
	while($row=mysqli_fetch_array($result))
	{
		$current_image = $row["image_url"];
	}

	return $current_image;
}

function getOtherUse($con,$current_image)
{
	$result = mysqli_query($con,"SELECT ID FROM achievement WHERE image_url = '$current_image'");
	while($row=mysqli_fetch_array($result))
	{
		$other_use = $row["ID"];
	}

	return $other_use;
}
?>