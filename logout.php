<?php
  //Avataan istunto
  session_start();

  //Poistetaan istunnosta merkintä kirjautuneesta käyttäjästä -> Kirjaudutaan ulos
  unset($_SESSION["user"]);

  //Yleensä kannattaa ulkos kirjautumisen jälkeen ohjata käyttäjä kirjautumissivulle
  header('Location: index.php');
?>