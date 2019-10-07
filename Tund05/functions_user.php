<?php

session_start();

function signUp($name, $surname, $email, $gender, $birthDate, $password){
	$notice = null;
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("INSERT INTO vpusers (firstname, lastname, birthdate, gender, email, password) VALUES(?,?,?,?,?,?)");
	echo $conn->error;
	$options = ["cost" => 12, "salt" => substr(sha1(rand()), 0, 22)];
	$pwdhash = password_hash($password, PASSWORD_BCRYPT, $options);
	$stmt->bind_param("sssiss", $name, $surname, $birthDate, $gender, $email, $pwdhash);
	if($stmt->execute()){
		$notice = "Kasutaja loomine õnnestus!";
	} else {
		$notice = "Kasutaja loomisel tekkis tehniline viga: " .$stmt->error;
	}
	$stmt -> close();
	$conn -> close();
	return $notice;
}

 function signIn($email, $password){
	$notice = null;
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $mysqli->prepare("SELECT password FROM vpusers WHERE email=?");
	echo $mysqli->error;
	$stmt->bind_param("s", $email);
	$stmt->bind_result($passwordFromDb);
	if($stmt->execute()){
		//päring õnnestus
	  if($stmt->fetch()){
		//kasutaja olemas
		if(password_verify($password, $passwordFromDb)){
		  //kui salasõna klapib
		  $stmt->close();
		  $stmt = $mysqli->prepare("SELECT id, firstname, lastname FROM vpusers WHERE email = ?");
		  echo $mysqli->error;
		  $stmt->bind_param("s", $email);
		  $stmt->bind_result($idFromDb, $firstnameFromDb, $lastnameFromDb);
		  $stmt->execute();
		  $stmt->fetch();
		  $notice = "Sisse logis " .$firstnameFromDb ." " .$lastnameFromDb ."!";
		 
		} else {
		  $notice = "Vale parool!";
		}
	    } else {
		$notice = "Sellist kasutajat (" .$email .") ei leitud!";  
	  }
	    } else {
	  $notice = "Sisselogimisel tekkis tehniline viga!" .$stmt->error;
	}
	
	      $stmt->close();
	      $mysqli->close();
		  return $notice;
    }
