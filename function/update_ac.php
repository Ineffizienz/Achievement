<?php
	
	include("../include/connect.php");
	include("../include/function.php");
	include("../class/message_class.php");

	$message = new message();

	$assign_cat = idConfirm($_REQUEST["assign_cat"]);
	$assign_trig = idConfirm($_REQUEST["assign_trig"]);
	$acid = idConfirm($_REQUEST["id"]);

	if (($assign_cat == "false") || ($assign_trig == "false") || ($acid == "false"))
	{
		$message->getMessageCode("ERR_FALSE_INPUT");
		$message->displayMessage();
	} else {
		$cat_id = getAcCategorie($con,$acid);
		$trig_id = getAcTrigger($con,$acid);

		if ($assign_cat !== $cat_id)
		{
			$sql = "UPDATE achievement SET ac_categorie = '$assign_cat' WHERE ID = '$acid'";
			if (mysqli_query($con,$sql))
			{
				$message->getMessageCode("SUC_ASSIGN_CATEGORIE");
				$message->displayMessage();
			} else {
				$message->getMessageCode("ERR_DB");
				$message->displayMessage();
			}
		}

		if ($assign_trig !== $trig_id)
		{
			$sql = "UPDATE achievement SET ac_trigger = '$assign_trig' WHERE ID = '$acid'";
			if (mysqli_query($con,$sql))
			{
				$message->getMessageCode("SUC_ASSIGN_TRIGGER");
				$message->displayMessage();
			} else {
				$message->getMessageCode("ERR_DB");
				$message->displayMessage();
			}
		}
	}

?>