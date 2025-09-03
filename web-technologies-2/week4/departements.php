<?php
    spl_autoload_register(function($classe){
        require "lib/$classe.class.php"; 
    });
    require("lib/fonctions_parms.php");
    $dsn_tw2 = require('lib/dsn_tw2_def.php');
    require("lib/fonctions_html.php");

    try {
        $dl = new DataLayer($dsn_tw2);
        $reg = checkString('reg', NULL, FALSE);
            $departements = $dl->getDepartementsRegions($reg);  
        
        $table_departements = departementsToTable($departements);
        
        require("views/pageDepartements.php");
    } catch (ParmsException $e) {
        require "views/pageErreur.php";
    }
?>
