<?php
	include("../include/connect.php");
	include("../include/function.php");
	include("../class/message_class.php");

	$message = new message();

	if(empty($_REQUEST["trig"]))
	{
		$message->getMessageCode("ERR_NO_TRIGGER_NAME");
		$message->displayMessage();
	} else {
		$trigger_name = confirmTitle($_REQUEST["trig"]);
		if($trigger_name == "0")
		{
			$message->getMessageCode("ERR_FALSE_INPUT");
			$message->displayMessage();
		} else {

			$sql = "INSERT INTO ac_trigger (trigger_title) VALUES ('$trigger_name')";

			if(mysqli_query($con,$sql))
			{
				$message->getMessageCode("SUC_CREATE_TRIGGER");
				$message->displayMessage();
			} else {
				$message->getMessageCode("ERR_DB");
				$message->displayMessage();
			}
		}
	}
?>