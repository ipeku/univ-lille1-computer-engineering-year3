<?php
spl_autoload_register(function ($className) { // règle de chargement des fichiers de classe
    include ("lib/{$className}.class.php");
});

require ('lib/authent_lib.php');         // fonctions d'authentification
$dsn = require('lib/dsn_perso_def.php'); // chaîne de connexion à la base de données

try {
    $dataLayer = new DataLayer($dsn);
   
    // test d'authentification (peut produire AuthentException) :
    $user = check_login_post($dataLayer->authentification(...));

    // page à afficher en cas de succès :
    require('views/pageSimple.php');
 }
 catch (AuthentException $authentException){
    // page à afficher en cas d'échec :
    require('views/pageLogin.php');
 }


?>
