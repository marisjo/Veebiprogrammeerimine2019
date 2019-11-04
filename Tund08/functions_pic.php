<?php

require("../../../config_vp2019.php");
$database = "if19_maris_jo_1";

  function setPicSize($myTempImage, $imageW, $imageH, $imageNewW, $imageNewH){
	  $myNewImage = imagecreatetruecolor($imageNewW, $imageNewH);
	  imagecopyresampled($myNewImage, $myTempImage, 0, 0, 0, 0, $imageNewW, $imageNewH, $imageW, $imageH);
	  return $myNewImage;
	  
	  }
	 
?>

<?php	 
  function addPicData($filename, $altText, $privacy){
		$notice = null;
		$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $conn->prepare("INSERT INTO vpphotos (userid, filename, alttext, privacy) VALUES (?, ?, ?, ?)");
		echo $conn->error;
		$stmt->bind_param("issi", $_SESSION["userID"], $filename, $altText, $privacy);
		if($stmt->execute()){
			$notice = " Pildi andmed salvestati andmebaasi!";
		} else {
			$notice = " Pildi andmete salvestamine ebaönnestus tehnilistel põhjustel! " .$stmt->error;
		}
		$stmt->close();
		$conn->close();
		return $notice;
		
		
		
  }