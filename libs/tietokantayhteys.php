<?php


/** Funktio joka palauttaa yhteyden tietokantaan PDO-oliona. */
function getTietokantayhteys() {
	$tunnus = "databasetest";
	$salasana= "testymctest";

  //Muuttuja, jonka sisalto sailyy getTietokantayhteys-kutsujen valilla.
  static $yhteys = null; 
  
  //Jos $yhteys on null, pitaa se muodostaa.
  if ($yhteys == null) { 
    //Tama koodi suoritetaan vain kerran, silla seuraavilla 
    //funktion suorituskerroilla $yhteys-muuttujassa on sisaltoa.
    $yhteys = new PDO("mysql:host=board.bunbunmaru.com;dbname=forumproject", $tunnus, $salasana);
    $yhteys->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  }

  return $yhteys;
}