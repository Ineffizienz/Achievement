<?php
class Achievement {
	
	private $id = "";
	private $title = "";
	private $message = "";
	private $image = "";
	private $ac_template = "";
	private $ac = "";
	private $r_id = "--ID--";
	private $r_title = "--HEADLINE--";
	private $r_message = "--TEXT--";
	private $r_image = "--IMAGE--";

	public function getDetails($id,$title,$message,$image)
	{
		$this->id = $id;
		$this->title = html_entity_decode($title);
		$this->message = html_entity_decode($message);

		if(empty($image))
		{
			$this->image = "NULL";
		} else {
			$this->image = "images/" . $image;
		}

		$this->buildAchievement();
	}

	public function getDetailsLowAc($achievement_details)
	{
		if (empty($achievement_details))
		{
			$this->ac = "File not Found.";
		} else {

				$this->title = html_entity_decode($achievement_details["title"]);
				$this->message = html_entity_decode($achievement_details["message"]);

				if (empty($achievement_details["image_url"]))
				{
					$this->image = "NULL";
				} else {
					$this->image = "images/" . $achievement_details["image_url"];
				}

				$this->buildLowAchievement();
		}
	}

	public function buildAchievement()
	{
		$this->ac_template = file_get_contents("template/part/achievement.html");

		if($this->image == "NULL")
		{
			$this->ac = str_replace(array($this->r_id,$this->r_title,$this->r_message,$this->r_image), array($this->id,$this->title,$this->message,"images/keinbild.jpg"),$this->ac_template);
		} else {	
			if(file_exists($this->image))
			{

				$this->ac = str_replace(array($this->r_id,$this->r_title,$this->r_message,$this->r_image), array($this->id,$this->title,$this->message,$this->image), $this->ac_template);

			} else {
				$this->ac = str_replace(array($this->r_id,$this->r_title,$this->r_message,$this->r_image), array($this->id,$this->title,$this->message,"Kein Bild"), $this->ac_template);
			}
		}
	}

	public function buildLowAchievement()
	{
		$this->ac_template = file_get_contents("template/part/low_achievement.html");

		if($this->image == "NULL")
		{
			$this->ac .= str_replace(array($this->r_title,$this->r_message,$this->r_image), array($this->title,$this->message,"images/keinbild.jpg"),$this->ac_template);
		} else {
			if(file_exists($this->image))
			{
				$this->ac = str_replace(array($this->r_title,$this->r_message,$this->r_image), array($this->title,$this->message,$this->image), $this->ac_template);
			} else {
				$this->ac = str_replace(array($this->r_title,$this->r_message,$this->r_image), array($this->title,$this->message,"Kein Bild"), $this->ac_template);
			}
		}
	}

	public function displayAchievement()
	{
		return $this->ac;
	}	
}
	
?>