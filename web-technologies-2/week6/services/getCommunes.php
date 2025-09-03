<?php
set_include_path('..'.PATH_SEPARATOR);
require_once('lib/common_service.php');
require_once('lib/fonctions_parms.php'); 
$dsn = require('lib/dsn_perso_def.php');

try {
    $data = new DataLayer($dsn);
    $territoire = checkUnsignedInt('territoire', NULL, FALSE);
    $liste = $data->getCommunes($territoire);
    echo produceResultAnswer($liste);
} catch (PDOException $e) {
    echo produceErrorAnswer($e->getMessage());
} catch (ParmsException $e) {
    echo produceErrorAnswer($e->getMessage());
}

?>