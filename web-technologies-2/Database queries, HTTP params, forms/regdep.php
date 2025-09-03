<?php
    spl_autoload_register(function($classe){require "lib/$classe.class.php";}); // règle de chargement des classes
    
    $dsn_tw2 = require('lib/dsn_tw2_def.php');

    require("lib/fonctions_html.php");
    require("lib/fonctions_parms.php");
    setlocale(LC_ALL, 'fr_FR.utf8');

    /** 
        forme 'équivalente' ASCII, sans accents, diacritiques ni ligatures
    */
    function unaccent(string $text) : string {
        return iconv('utf8', 'ascii//TRANSLIT', $text);
    }

    try {        
        $dl = new DataLayer($dsn_tw2);
        $regions = $dl->getRegions();
        require("views/pageFormuDep.php");
    } catch (ParmsException $e) {
        require "views/pageErreur.php";
    }
   
?>