<?php
	require 'libs/tietokantayhteys.php';
	$yhteys = getTietokantayhteys();
  
  $sql = "SELECT UserID, Username, Password FROM Users";
  $kysely = getTietokantayhteys()->prepare($sql); $kysely->execute();
	
  foreach($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
	echo $tulos->UserID . " | ";
	echo $tulos->Username . " | ";
	echo $tulos->Password . "<br>";
  }