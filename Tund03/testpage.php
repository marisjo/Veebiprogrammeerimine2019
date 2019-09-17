<?php
  $userName = "Maris Jool";
  
  $photoDir = "../Photos/";
  $photoTypes = ["image/jpeg", img/png"];
  $fullTimeNow = date("d.m.Y H:i:s");
  $hourNow = date("H;i");
  $partOfDay = "hägune aeg";
  
 
  if($hourNow < 8){
	$partOfDay = "hommik";
    }
  
	
  if ($hourNow > 16){ 
    $partOfDay = "õhtu";
	}
	
  if ($hourNow > 24){
	$partOfDay = "öö";
	}
	
	//info semestri kulgemise kohta
	$semesterStart = new DateTime("2019-9-2");
	$semesterEnd = new DateTime("2019-12-13");
	$semesterDuration = $semesterStart -> diff($semesterEnd);
	$today = new DateTime("now");
	$semesterElapsed = $semesterStart -> diff($semesterEnd);
	//echo $semesterDuration;
	//var_dump($semesterDuration);
	//<p>Semester on täies hoos:
    //<meter min="0" max="112" value="16">13%</meter>
    //</p>
	$semesterInfoHTML = null;
	if($semesterElapsed -> format("%r%a") >= 0) {
	  $semesterInfoHTML = "<P>Semester on täies hoos:";
      $semesterInfoHTML .= '<meter min="0" max="' .$semesterDuration -> format("%r%a") . '" ';
	  $semesterInfoHTML .= 'value="' .$semesterElapsed -> format("%r%a") .'">';
	  $semesterInfoHTML .= round($semesterElapsed -> format("%r%a") / $semesterDuration -> format("%r%a") * 100, 1) ."%";
	  $semesterInfoHTML .= "</meter> </p>";
	  }
	
	// foto näitamine lehel
	
	$fileList = array_slice (scandir($photoDir), 2);
	//var_dump($fileList); 
	$photoList = [];
	foreach ($fileList as $file){
		$fileInfo = getImagesize($photoDir .$file);
		//var_dump($fileInfo)
		if (in_array($fileInfo["mime"], $photoTypes)){
			array_push($photoList, $file);
		}
	
	}
	
	//$photoList = ["tlu_terra_600x400_1.jpg", "tlu_terra_600x400_2.jpg", "tlu_terra_600x400_3.jpg"];//array ehk massiiv
	//var_dump($photoList);
	$photoCount = count($photoList);
	//echo $photoCount;
	$photoNum = mt_rand(0, $photoCount -1);
	//echo $photoList [$photoNum];
	//<img src = "../Photos/tlu_terra_600x400_1.jpg" alt="TLÜ Terra õppehoone">
	$randomImgHTML = '<img src="' .$photoDir .$photoList [photoNum] .'" alt ="Juhuslik foto">';
	
	
	require ("header.php");

    echo "<p>Lehe avamise hetkel oli aeg: " .$fullTimeNow .", " .$partOfDay .".</p>";
 ?>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
 <?php 
    echo $semesterInfoHTML;

 ?>
 
  
  <p>Teretulemast <em>minu</em> uuele veebilehele!</p>
  <body bgcolor="white">
  <body background="sini.jpg" ALT="some text" WIDTH=1920 HEIGHT=1080>
<main>
    Siia tulevad minu tehtud pildid
  </main>
  <footer>
   Siia tuleb copyright info ja mõned lingid
  </footer>
  
  <?php 
    echo $randomImgHTML;
	
	
?>	
	
  
  
  </body>
</html>