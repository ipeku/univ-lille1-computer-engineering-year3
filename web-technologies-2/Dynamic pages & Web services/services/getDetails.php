<?php
set_include_path('..'.PATH_SEPARATOR);
require_once('lib/common_service.php');
require_once('lib/fonctions_parms.php'); //inutile ici : pas de paramètres
$dsn = require('lib/dsn_perso_def.php'); // chaîne de connexion à la base de données

try {
    $data = new DataLayer($dsn);
    $insee = checkUnsignedInt('insee', NULL, TRUE);
    $liste = $data->getDetails($insee);

    if ($liste === NULL) 
        throw new ParmsException("insee est incorrecte");
    echo produceResultAnswer($liste);
} catch (PDOException $e) {
    echo produceErrorAnswer($e->getMessage());
} catch (ParmsException $e) {
    echo produceErrorAnswer($e->getMessage());
}

?>
