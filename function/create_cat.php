<?php
	//include($_SERVER["DOCUMENT_ROOT"] . "/Achievement/include/init/constant.php");
	include("../class/message_class.php");
	include("../include/function.php");
	include("../include/connect.php");

	$message = new message();

	if (empty($_REQUEST["cat"]))
	{
		$message->getMessageCode("ERR_NO_CAT");
		$message->displayMessage();
	} else {
		$cat = confirmTitle($_REQUEST["cat"]);
		if($cat == "0")
		{
			$message->getMessageCode("ERR_FALSE_INPUT");
			$message->displayMessage();
		} else {
			$sql = "INSERT INTO categorie (c_name) VALUES ('$cat')";
			if(mysqli_query($con,$sql))
			{
				$message->getMessageCode("SUC_NEW_CAT");
				$message->displayMessage();
			} else {
				$message->getMessageCode("ERR_DB");
				$message->displayMessage();
			}
		}
	}
?>
