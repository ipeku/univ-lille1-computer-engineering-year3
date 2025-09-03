<?php
    spl_autoload_register(function($classe){require "lib/$classe.class.php";}); // règle de chargement des classes
    
    $dsn_tw2 =  require('lib/dsn_tw2_def.php');

    require("lib/fonctions_html.php");
 
    try {
        $dl = new DataLayer($dsn_tw2);
        $regions = $dl->getRegions();
        $table_regions = regionsToTable($regions);
        require("views/pageRegions.php");
    } catch (ParmsException $e) {
        require "views/pageErreur.php";
    }
   
?>