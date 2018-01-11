<?php
	header("Content-Type: text/html; charset=utf-8");
	error_reporting(E_ALL);

	include("include/connect.php");
	include("include/function.php");
	include("include/controller.php");

	include("class/template_class.php");
	include("class/achievement_class.php");

	$tpl = new template();

	$tpl->load("index.html");

	$tpl->assign("navigation",build_content("nav.html"));
	$tpl->assign("content",$content);
	$tpl->assign("categorie",createCatSelect($con));
	$tpl->assign("trigger",createTrigSelect($con));
	$tpl->assign("achievements",displayOnlyAc(getAchievements($con)));
	$tpl->assign("current",currentState($con));
	$tpl->assign("categories",displayCategories($con));
	$tpl->assign("trigger_name",displayTrigger($con));
	$tpl->assign("assign_categorie",createCatSelect($con));
	$tpl->assign("assign_trigger",createTrigSelect($con));

	$tpl->display();
?>