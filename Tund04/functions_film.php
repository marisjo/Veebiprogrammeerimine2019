<?php
  function readAllFilms(){
  //var_dump($GLOBALS);  
  //loeme andmebaasist filmide infot
  //loome andmebaaside �henduse ($mysqli  $conn)
  $conn = new mysqli($GLOBALS ["serverHost"], $GLOBALS ["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
  //valmistan ette p�ringu 
  $stmt = $conn -> prepare("SELECT pealkiri, aasta FROM film");
  echo $conn -> error;
  //$filmTitle = "T�hjus";
  $filmInfoHTML = null;
  $stmt -> bind_result ($filmTitle, $filmYear);
  $stmt -> execute();
  //sain pinu (stack) t�ie infot, hakkan �hekaupa v�tma, kuni saab
  while($stmt -> fetch()){
		//echo " Pealkiri: " .$filmTitle;
		$filmInfoHTML .= "<h3>" .$filmTitle ."</h3>";
		$filmInfoHTML .= "<p>" .$filmYear ."</p>";
	  }
	
  
      //sulgen �henduse 
      $stmt -> close();
      $conn ->close();
      return $filmInfoHTML;
}

function storeFilmInfo($filmTitle, $filmYear, $filmDuration, $filmGenre, $filmStudio, $filmDirector){
	 $conn = new mysqli($GLOBALS ["serverHost"], $GLOBALS ["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	   $stmt = $conn -> prepare ("INSERT INTO film (pealkiri, aasta, kestus, zanr, tootja, lavastaja) VALUES(?,?,?,?,?,?)");
	   echo $conn -> error;
	   //andmet��bid: s- string, i- integer, d-decimal
	   $stmt -> bind_param("siisss", $filmTitle, $filmYear, $filmDuration, $filmGenre, $filmStudio, $filmDirector);
	   $stmt -> execute();
	   
	   
	   $stmt -> close();
       $conn ->close();
}

  function readOldFilms($filmAge){
	  $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	  $maxYear = date("Y") - $filmAge;
	  $stmt = $conn->prepare("SELECT pealkiri, aasta FROM film WHERE aasta < ?");
	  $stmt->bind_param("i", $maxYear);
	  $stmt->bind_result($filmTitle, $filmYear);
	  $stmt->execute();
	  $filmInfoHTML = "";
	  while($stmt->fetch()){
		$filmInfoHTML .= "<h3>" .$filmTitle ."</h3>";
		$filmInfoHTML .= "<p>Tootmisaasta: " .$filmYear .".</p>";
	  }


      $stmt->close();
	  $conn->close();
      return $filmInfoHTML;
 }