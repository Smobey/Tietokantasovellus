<?php
require 'libs/dbconnect.php';

$sql = "SELECT UserID, Username, Password FROM Users";
$kysely = getConnection()->prepare($sql);
$kysely->execute();

foreach($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
	echo $tulos->UserID . " | ";
	echo $tulos->Username . " | ";
	echo $tulos->Password . "<br>";
}