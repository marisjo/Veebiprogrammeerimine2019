<?php
  require("../../../config_vp2019.php");
  require ("functions_main.php"); 
  require("functions_user.php");
  $database = "if19_maris_jo_1";
  
  $userName = "Sisselogimata kasutaja";
  
  
  $notice = "";
  $email = "";
  $emailError = "" ;
  $passwordError = "" ;
  
  $photoDir = "../Photos/";
  $photoTypes = ["image/jpeg", "img/png"];
  
  $fullTimeNow = date("d.m.Y H:i:s");
  $hourNow = date("H");
  $partOfDay = "hägune aeg";
  $weekDaysET =  ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
  $monthNamesET = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
  
 
  if($hourNow < 8){
    $partOfDay = "hommik";
  }
  if($hourNow > 16){ 
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
	$semesterElapsed = $semesterStart -> diff($today);
	//echo $semesterDuration;
	//var_dump($semesterDuration);
	//<p>Semester on täies hoos:
    //<meter min="0" max="112" value="16">13%</meter>
    //</p>
	$semesterInfoHTML = null;
	if($semesterElapsed -> format("%r%a") >= 0){
      $semesterInfoHTML = "<p>Semester on täies hoos:";
	  $semesterInfoHTML .= '<meter min="0" max="' .$semesterDuration -> format("%r%a") .'" ';
	  $semesterInfoHTML .= 'value="' .$semesterElapsed -> format("%r%a") .'">';
	  $semesterInfoHTML .= round($semesterElapsed -> format("%r%a") / $semesterDuration -> format("%r%a") * 100, 1) ."%";
	  $semesterInfoHTML .= "</meter> </p>";
	}
	
	if($semesterElapsed -> format("%r%a") <= 0){
		 $semesterInfoHTML = "<p>Semester on läbi saanud või pole veel alanud:";
    }
	
	//foto näitamine lehel
	$fileList = array_slice(scandir($photoDir), 2);
	//var_dump($fileList);
	$photoList = [];
	foreach ($fileList as $file){
		$fileInfo = getImagesize($photoDir .$file);
		//var_dump($fileInfo);
		if (in_array($fileInfo["mime"], $photoTypes)){
			array_push($photoList, $file);
		}
	}
	
	//$photoList = ["tlu_terra_600x400_1.jpg", "tlu_terra_600x400_2.jpg", "tlu_terra_600x400_3.jpg"];//array ehk massiiv
	//var_dump($photoList);
	$photoCount = count($photoList);
	//echo $photoCount;
	$photoNum = mt_rand(0, $photoCount -1);
	//echo $photoList[$photoNum];
	//<img src="../photos/tlu_terra_600x400_1.jpg" alt="TLÜ Terra õppehoone">
	$randomImgHTML = '<img src="' .$photoDir .$photoList[$photoNum] .'" alt="Juhuslik foto">';
	
	  if(isset($_POST["login"])){
		if (isset($_POST["email"]) and !empty($_POST["email"])){
		  $email = test_input($_POST["email"]);
		} else {
		  echo $emailError = "Palun sisesta kasutajatunnusena enda e-mail!";
		}
	  
		if (!isset($_POST["password"]) or strlen($_POST["password"]) < 8){
		  $passwordError = "Palun sisesta parool, milles on vähemalt 8 märki.";
		}
	  
		if(empty($emailError) and empty($passwordError)){
		  $notice = signIn($email, $_POST["password"]);
		} else {
			echo $notice = "Sisselogimine ebaõnnestus.";
		}
	  }
	
	require("header.php");

   echo "<h1>" .$userName .", koolitöö leht</h1>";
  ?>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <?php
    echo $semesterInfoHTML;
  ?>  
  <hr>

  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label>E-mail (kasutaja) :</label><br>
	  
	  <input type="email" name="email" value="<?php echo $email; ?>">&nbsp;<span><?php echo $emailError; ?></span><br>
	  
	  <label>Parool:</label><br>
	  <input name="password" type="password">&nbsp;<span><?php echo $passwordError; ?></span><br>
	  
	  <input name="login" type="submit" value="Logi sisse">&nbsp;<span><?php echo $notice; ?>
	  
	</form>
	<br>
	<h2>Kui pole kasutajakontot</h2>
	<p>Loo <a href="newuser.php" >kasutajakonto</a>!</p>
  <hr>
  <?php
    echo "<p>Lehe avamise hetkel oli aeg: " .$fullTimeNow .", " .$partOfDay .".</p>";
	echo $randomImgHTML;
  ?>
  
</body>
</html>