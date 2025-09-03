<?php
/**
 * Ce script renvoie la chaîne DSN (partamètres de connexion à la base)
 */
// nom du fichier contenant les paramètres de connexion à la base

return 
    ( function (){
        $dsn_basename = 'webtp_tw2_dsn.txt';  
        return 'uri:' . preg_replace('!/public_html/.*!', '/'.$dsn_basename ,__DIR__);
    } )();
?>