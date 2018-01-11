<?php
	include("../include/connect.php");
	include("../include/function.php");
	include("../class/message_class.php");

	$message = new message();

	$ac = idConfirm($_REQUEST["ac"]);

	if ($ac == "0")
	{
		$message->getMessageCode("ERR_FALSE_INPUT");
		$message->displayMessage();
	} else {
		$confirm_ac = getSingleAc($con,$ac);

		if (empty($confirm_ac))
		{
			$message->getMessageCode("ERR_AC_LOST");
			$message->displayMessage();
		} else {
			
			unlink("../images/" . $confirm_ac[0]["image_url"]);

			$sql = "DELETE FROM achievement WHERE ID = '$ac'";

			if(mysqli_query($con,$sql))
			{
				$message->getMessageCode("SUC_DELETE_AC");
				$message->displayMessage();
			} else {
				$message->getMessageCode("ERR_DB");
				$message->displayMessage();
			}
		}
	}

?>