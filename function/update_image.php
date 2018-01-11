<?php
	include("../include/connect.php");
	include("../include/function.php");
	include("../class/message_class.php");

	$message = new message();

	$acid = idConfirm($_REQUEST["acid"]);

	if ($acid == "false")
	{
		$message->getMessageCode("ERR_FALSE_INPUT");
		$message->displayMessage();
	} else {
		if ($_FILES["file"]["size"] != 0)
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

					$current_image = getCurrentImage($con,$acid);

					if(!empty($current_image))
					{
						$other_use = getOtherUse($con,$current_image);
						if (empty($other_use))
						{
							unlink("../images/" . $current_image);
						}
					}

					move_uploaded_file($_FILES["file"]["tmp_name"], "../images/" . $_FILES["file"]["name"]);
					$path = $_FILES["file"]["name"]; 

					$sql = "UPDATE achievement SET image_url = '$path' WHERE ID = '$acid'";
					if(mysqli_query($con,$sql))
					{
						$message->getMessageCode("SUC_ASSIGN_IMG");
						$message->displayMessage();
					} else {
						$message->getMessageCode("ERR_DB");
						$message->displayMessage();
					}
				}
			}
		}
	}

?>