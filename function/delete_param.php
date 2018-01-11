<?php
	include("../include/connect.php");
	include("../include/function.php");
	include("../class/message_class.php");

	$message = new message();

	$delName = confirmParam($_REQUEST["name"]);

	if($delName == "c")
	{
		$id = idConfirm($_REQUEST["id"]);
		if ($id == "false")
		{
			$message->getMessageCode("ERR_FALSE_INPUT");
			$message->displayMessage();
		} else {
			$cat = getSingleCategorie($con,$id);

			if(empty($cat))
			{
				$message->getMessageCode("ERR_CATEGORIE_LOST");
				$message->displayMessage();
			} else {
				$sql = "UPDATE achievement SET ac_categorie = NULL WHERE ac_categorie = '$id'";
				if (mysqli_query($con,$sql))
				{
					$sql = "DELETE FROM categorie WHERE ID = '$id'";
					if (mysqli_query($con,$sql))
					{
						$message->getMessageCode("SUC_DELETE_CATEGORIE");
						$message->displayMessage();
					} else {
						$message->getMessageCode("ERR_DB");
						$message->displayMessage();
					}
				} else {
					$message->getMessageCode("ERR_DB");
					$message->displayMessage();
				}
			}
		}

	} else if ($delName == "t") {
		$id = $idConfirm["id"];
		if ($id == "false")
		{
			$message->getMessageCode("ERR_FALSE_INPUT");
			$message->displayMesssage();
		} else {
			$trig = getSingleTrigger($con,$id);

			if (empty($trig))
			{
				$message->getMessageCode("ERR_TRIGGER_LOST");
				$message->displayMessage();
			} else {
				$sql = "UPDATE achievement SET ac_trigger = NULL WHERE ac_trigger = '$id'";
				if(mysqli_query($con,$sql))
				{
					$sql = "DELETE FROM ac_trigger WHERE ID = '$id'";
					if(mysqli_query($con,$sql))
					{
						$message->getMessageCode("SUC_DELETE_TRIGGER");
						$message->displayMessage();
					} else {
						$message->getMessageCode("ERR_DB");
						$message->displayMessage();
					}
				} else {
					$message->getMessageCode("ERR_DB");
					$message->displayMessage();
				}
			}
		}
	}
?>