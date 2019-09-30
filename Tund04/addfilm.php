<?php
  require("../../../config_vp2019.php");
  require("functions_film.php");
  //echo $serverHost;
  $userName = "Maris Jool";
  $database = "if19_maris_jo_1";
  $notice = null;
  
  //var_dump($_POST);
   if(isset($_POST["submitFilm"])){
	$filmTitle = $_POST["filmTitle"];
    $filmYear = $_POST["filmYear"];
    $filmDuration = $_POST["filmDuration"];
    $filmGenre = $_POST["filmGenre"];
    $filmCompany = $_POST["filmStudio"];
    $filmDirector = $_POST["filmDirector"];
	//salvestame, kui vähemalt pealkiri on olemas
	if(!empty($_POST["filmTitle"])){
	  //saveFilmInfo($_POST["filmTitle"], $_POST["filmYear"], $_POST["filmDuration"], $_POST["filmGenre"], $_POST["filmCompany"], $_POST["filmDirector"]);
	  saveFilmInfo($filmTitle, $filmYear, $filmDuration, $filmGenre, $filmCompany, $filmDirector);
	  $filmTitle = null;
      $filmYear = date("Y");
      $filmDuration = 80;
      $filmGenre = null;
      $filmCompany = null;
      $filmDirector = null;
	} else {
		$notice = "Palun sisestage vähemalt filmi pealkiri!";
	}
  }
  //$filmInfoHTML = readAllFilms();
  

  require("header.php");
  echo "<h1>" .$userName .", veebiprogrammeerimine</h1>";
?>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>

  <hr>
  <h2>Eesti filmid</h2>
  <p>Lisa uus film andmebaasi</p>
  <hr>
  <form method="POST">

    <label>Kirjuta filmi pealkiri</label>
	<input type="text" name="filmTitle">
	<br>
	<label>Filmi žanr: </label>
	<input type="text" name="filmGenre">
	<br>
	<label>Filmi lavastaja: </label>
	<input type="text" name="filmDirector">
	<br>
	<label>Filmi kestus (min): </label>
	<input type="number" min="1" max="300" value="80"  name="filmDuration">
	<br>
	<label>Filmi tootja: </label>
	<input type="text" name="filmStudio">
	<br>
	<label>Filmi tootmisaasta: </label>
	<input type="number" min="1912" max="2019" value="2019"  name="filmYear">
	<br>
	
	
	
	<input type="submit" value="Talleta filmi info" name="submitFilm">
	
  </form>
  
  
</body>
</html>