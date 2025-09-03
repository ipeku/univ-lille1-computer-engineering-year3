<?php
spl_autoload_register(function ($className) { // règle de chargement des fichiers de classe
  include ("lib/{$className}.class.php");
});

require('lib/fonctions_parms.php');
$dsn = require('lib/dsn_perso_def.php'); // chaîne de connexion à la base de données

try {
   $nom = checkString('nom', NULL, TRUE);
   $prenom = checkString('prenom', NULL, TRUE);
   $login = checkString('login', NULL, TRUE);
   $password = checkString('password', NULL, TRUE);
   
   $dataLayer = new DataLayer($dsn);

   $res = $dataLayer->createUser($login, $password, $nom, $prenom);

   if ($res){
     require('views/pageCreateOK.php');
     exit();
   } else {
     $erreurCreation = true;
     require('views/pageRegister.php');
     exit();
   }
 } catch (ParmsException $e) {
     require('views/pageRegister.php');
 }

?>
