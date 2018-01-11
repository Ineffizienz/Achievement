<?php
	header("Content-Type: text/html; charset=utf-8");
	include("init/get_parameter.php");

	function build_content($file) // liest HTML-Fragmente ein und fügt sie an der entsprechenden Stelle ein
	{
		if (file_exists("template/" . $file))
		{
			$data = fopen("template/" . $file, "r");
			while (!feof($data))
			{
				if (!isset($content))
				{
					$content = fgets($data);
				} else {	
					$content .= fgets($data);
				}
			}
			fclose($data);
			return $content;
		}
	}

	function build_option($id, $value)
	{
		$part = file_get_contents("template/part/option.html");
		$option = str_replace(array("--ID--","--VALUE--"), array($id,$value), $part);

		return $option;

	}

	function buildButton($name,$id)
	{

		$part = file_get_contents("template/part/button.html");
		$button = str_replace(array("--NAME--","--ID--"),array($name,$id),$part);

		return $button;
	}

	function createCatSelect($con)
	{
		$cat = getCategories($con);
		
		if (empty($cat))
		{
			$select = build_option("0","Keine Angabe");
		} else {
			$select = build_option("0","Keine Angabe");
			foreach ($cat as $categorie)
			{
					$select .= build_option($categorie["ID"],$categorie["c_name"]);
			}
		}
		

		return $select;
	}

	function createTrigSelect($con)
	{
		$trig = getTrigger($con);
		if (empty($trig))
		{
			$select = build_option("0","Keine Angabe");

		} else {
			$select = build_option("0","Keine Angabe");
			foreach ($trig as $trigger)
			{
				$select .= build_option($trigger["ID"],$trigger["trigger_title"]);
			}
		}
		

		return $select;
	}

	function displayOnlyAc($ac_array)
	{
		if (!empty($ac_array))
		{
			foreach ($ac_array as $ac)
			{
				$output = new Achievement();
				$output->getDetails($ac["ID"],utf8_encode($ac["title"]),$ac["message"],$ac["image_url"]);
				if (!isset($value))
				{
					$value = $output->displayAchievement();
				} else {
					$value .= $output->displayAchievement();
				}
			}

			return $value;

		} else {
			
			$output = "";
			return $output;
		}

		
	}

	function currentState($con)
	{
		$categorie = getCategories($con);

		foreach ($categorie as $cat)
		{
			$achievement = array();
			$achievement = getAchievementByCategorie($con,$cat["ID"]);
			$new_set = "";
			foreach ($achievement as $ac)
			{
				$value = new Achievement();
				$value->getDetailsLowAc($ac);
				
				$new_set .= $value->displayAchievement();
			}

			$part = file_get_contents("template/part/current.html");

			if(!isset($output))
			{
				$output = str_replace(array("--CATEGORY--","--AC--"), array($cat["c_name"],$new_set), $part);
			} else {
				$output .= str_replace(array("--CATEGORY--","--AC--"), array($cat["c_name"],$new_set), $part);
			}
			

		}

		$no_cat = getNoCatAc($con);

		$value = new Achievement();		
		$value->getDetailsLowAc($no_cat);

		if(!isset($output))
		{
			$output = str_replace(array("--CATEGORY--","--AC--"), array("Ohne Kategorie",$value->displayAchievement()),$part);
		} else {
			$output .= str_replace(array("--CATEGORY--","--AC--"), array("Ohne Kategorie",$value->displayAchievement()),$part);
		}

		return $output;
	}

	function displayCategories($con)
	{
		$categories = getCategories($con);

		foreach ($categories as $categorie)
		{
			$button = buildButton("c",$categorie["ID"]);
			if (!isset($output))
			{
				$output = "<li>" . $categorie["c_name"] . $button .  "</li>";
			} else {
				$output .= "<li>" . $categorie["c_name"] . $button .  "</li>";
			}
		}

		return $output;
	}

	function displayTrigger($con)
	{
		$trigger = getTrigger($con);

		foreach ($trigger as $single_trigger)
		{
			$button = buildButton("t",$single_trigger["ID"]);
			if(!isset($output))
			{
				$output = "<li>" . $single_trigger["trigger_title"] . $button . "</li>";
			} else {
				$output .= "<li>" . $single_trigger["trigger_title"] . $button . "</li>";
			}
		}

		return $output;
	}

	function idConfirm($input)
	{
		if(ctype_digit($input))
		{
			return $input;
		} else {
			return "false";
		}
	}

	function confirmTitle($title)
	{
		$title = htmlentities($title);
		$title = utf8_encode($title);
		$length = strlen($title);
		if($length <= "180")
		{
			return $title;
		} else {
			return 0;
		}
	}

	function confirmText($text)
	{
		$text = htmlentities($text);
		$length = strlen($text);

		if($length <= "150")
		{
			return $text;
		} else {
			return 0;
		}
	}

	function confirmParam($param)
	{
		$length = strlen($param);

		if($length = "1")
		{
			if (!is_numeric($param))
			{
				return $param;
			} else {
				return 0;
			}
		} else {
			return 0;
		}
	}
?>