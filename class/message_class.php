<?php
class message {

	private $messageCode = "";
	private $messageText = "";
	private $message = "";
	private $sir_brummel = "";

	public function getMessageCode($messageCode)
	{

		$this->messageCode = $messageCode;

		$this->buildMessageText();

	}

	public function buildMessageText()
	{
		if (substr($this->messageCode,0,3) == "ERR")
		{
			if (file_exists("../template/message/error_msg.txt"))
			{
				$lines = file("../template/message/error_msg.txt");
				foreach ($lines as $line)
				{
					if(preg_match("/" . $this->messageCode . "/isUe",$line))
					{
						$this->messageText = ltrim($line,$this->messageCode . ":");
					}
				}
			}
		} else {
			if (file_exists("../template/message/success_msg.txt"))
	        {
	            $lines = file("../template/message/success_msg.txt");
	            foreach ($lines as $line)
	            {
	            	if (strpos($line, $this->messageCode) == $this->messageCode)
	            	{
	            		$this->messageText = ltrim($line,$this->messageCode . ":");
	            	}
	            }
	        }
		}

		$this->buildSirBrummel();
	}

	public function buildSirBrummel()
	{

		if (file_exists("../template/message.html"))
		{
			$this->sir_brummel = file_get_contents("../template/message.html");

			$this->message = str_replace("--Message--", $this->messageText, $this->sir_brummel);
		} else {
			$this->message = "File not found.";
		}

	}

	public function displayMessage()
	{
		echo $this->message;
	}

}
?>