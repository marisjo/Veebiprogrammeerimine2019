<?php
  require("../../../config_vp2019.php");
  require("functions_film.php");
  //echo $serverHost;
  $userName = "Maris Jool";
  $database = "if19_maris_jo_1";
  
  

  $filmInfoHTML = readAllFilms();
  $filmAge = 50;
  $oldFilmInfoHTML = readOldFilms($filmAge);
  

  
  
  
  
  
   require("header.php");

   echo "<h1>" .$userName .", veebiprogrammeerimine</h1>";
  ?>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>

  <hr>
  <h2>Eesti filmid</h2>
  <p>Preaegu meie andmebaasis on järgmised filmid:</p>
  <?php
    echo $filmInfoHTML;
	echo "<hr>";
	echo "<h2>Filmid, mis on vanemad kui " .$filmAge ." aastat.</h2>";
	echo $oldFilmInfoHTML;
  ?>
  
</body>
</html>