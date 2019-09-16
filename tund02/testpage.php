<?php
  $userName = "Maris Jool";
  $fullTimeNow = date("d.m.Y H:i:s");
  $hourNow = date("H;i");
  $partOfDay = "hägune aeg";
  
  
  if($hourNow < 8){
	$partOfDay = "hommik";
  }
  
  if($hourNow >= 12 and  < 17){ 
    $partOfDay = "lõuna";
	}
	
  if ($hourNow > 16){ 
    $partOfDay = "õhtu";
	}
	
  if ($hourNow > 24:1){
	$partOfDay = "öö";
	}
	
	

<!DOCTYPE html> 
<html lang="et">
<head>
  <meta charset="utf-8">
  <title >programmeerib veebi</title>
  <?php 
    echo $userName;
  ?>
  <meta name ="description" content = "See veebileht on loodud katsetamise eesmärgil.">
  <style>
body {background-color: #92a8d1;}
h1   {color: black;}
p    {color: black;}
</style>
</head>
<body>
  <hr>
  <?php
    echo "<p>Lehe avamise hetkel oli aeg: " .$fullTimeNow .", " .$partOfDay .".</p>";
  ?>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Teretulemast <em>minu</em> uuele veebilehele!</p>
  <body bgcolor="white">
  <body background="sini.jpg" ALT="some text" WIDTH=1920 HEIGHT=1080>
<main>
    Siia tulevad minu tehtud pildid
  </main>
  <footer>
   Siia tuleb copyright info ja mõned lingid
  </footer>
  </body>
</html>