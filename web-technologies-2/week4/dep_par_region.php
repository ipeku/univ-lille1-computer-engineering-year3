<?php
    spl_autoload_register(function($classe){require "lib/$classe.class.php";}); // règle de chargement des classes

    $dsn_tw2 = require('lib/dsn_tw2_def.php');

    require("lib/fonctions_html.php");
    require("lib/fonctions_parms.php");
    setlocale(LC_ALL, 'fr_FR.utf8');


    try {
        $dl = new DataLayer($dsn_tw2);
        $regions = $dl->getRegions();
        /* à compléter */
        $reg = checkString("reg", NULL, false);

        $departements = $dl->getDepartementsRegions($reg);

        $table_departements = departementsToTable($departements);

        $select_regions = regionsToOptions($regions);


        require("views/pageFormuRegion.php");
    } 
        catch (ParmsException $e) {
        require "views/pageErreur.php";
    }

?>
