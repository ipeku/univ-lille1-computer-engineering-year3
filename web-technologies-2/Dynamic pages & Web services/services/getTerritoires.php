<?php
/**
 *  Service web getTerritoires
 *  - paramètres attendus : aucun
 *  - résultat : la liste des territoires de la MEL
 * 
 *  territoire : est un objet comportant les attributs  
 *   -- id  (chaîne) identifiant
 *   -- nom (chaîne)
 *   -- min_lat, min_lon, max_lat, max_lon : nombres (latitudes/longitudes mini et maxi)
 * 
 */
set_include_path('..'.PATH_SEPARATOR);
require_once('lib/common_service.php');
// require_once('lib/fonctions_parms.php'); //inutile ici : pas de paramètres
$dsn = require('lib/dsn_perso_def.php'); // chaîne de connexion à la base de données

try{
    $data = new DataLayer($dsn);
    $territoires = $data->getTerritoires();
    
    echo produceResultAnswer($territoires);
}
catch (PDOException $e){
    echo produceErrorAnswer($e->getMessage());
}


?>
