<?php
	//include($_SERVER["DOCUMENT_ROOT"] . "/Achievement/include/init/constant.php");
	include("../include/connect.php");
	include("../include/function.php");
	include("../class/message_class.php");

	$message = new message();

	if(empty($_REQUEST["name"]))
	{
		$message->getMessageCode("ERR_NO_AC_NAME");
		$message->displayMessage();
	} else {
		
		if(empty($_REQUEST["visibility"]))
		{
			$message->getMessageCode("ERR_NO_VISIB");
			$message->displayMessage();
		} else {
			if(($_FILES["file"]["size"] != 0))
			{
				if ($_FILES["file"]["size"] > 500000)
				{
					$message->getMessageCode("ERR_FILESIZE");
					$message->displayMessage();
				} else {
					$extension = pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);
					if (($extension !== "jpg") && ($extension !== "gif") && ($extension !== "png") && ($extension !== "jpeg"))
					{
						$message->getMessageCode("ERR_NO_IMAGE");
						$message->displayMessage();
					} else {
						move_uploaded_file($_FILES["file"]["tmp_name"], "../images/" . $_FILES["file"]["name"]);
						$path = $_FILES["file"]["name"];

						$title = confirmTitle($_REQUEST["name"]);
						$categorie = idConfirm($_REQUEST["categorie"]);
						$trigger = idConfirm($_REQUEST["trigger"]);
						$visib = idConfirm($_REQUEST["visibility"]);
						$text = confirmText($_REQUEST["text"]);

						if (($title == "0") || ($categorie == "false") || ($trigger == "false") || ($text == "0") || ($visib == "false"))
						{
							$message->getMessageCode("ERR_FALSE_INPUT");
							$message->displayMessage();
						} else {
							$sql = "INSERT INTO achievement (title,image_url,message,ac_trigger,ac_categorie,ac_visibility) VALUES ('$title','$path','$text','$trigger','$categorie','$visib')";

							if(mysqli_query($con,$sql))
							{
								$message->getMessageCode("SUC_CREATE_AC");
								$message->displayMessage();
							} else {
								$message->getMessageCode("ERR_DB");
								$message->displayMessage();
							}
						}
					}
				}
			} else {

				$title = confirmTitle($_REQUEST["name"]);
				$categorie = idConfirm($_REQUEST["categorie"]);
				$trigger = idConfirm($_REQUEST["trigger"]);
				$visib = idConfirm($_REQUEST["visibility"]);
				$text = confirmText($_REQUEST["text"]);
				
				if (($title == "0") || ($text == "0") || ($categorie == "false") || ($trigger == "false") || ($visib == "false"))
				{
					$message->getMessageCode("ERR_FALSE_INPUT");
					$message->displayMessage();
				} else {

					$sql = "INSERT INTO achievement (title,image_url,message,ac_trigger,ac_categorie,ac_visibility) VALUES ('$title',NULL,'$text','$trigger','$categorie','$visib')";

					if(mysqli_query($con,$sql))
					{
						$message->getMessageCode("SUC_CREATE_AC");
						$message->displayMessage();
					} else {
						$message->getMessageCode("ERR_DB");
						echo mysqli_error($con);
						$message->displayMessage();
					}				
				}
				
			}
		}
		

	}
?>