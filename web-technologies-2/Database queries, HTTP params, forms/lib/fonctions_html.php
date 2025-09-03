<?php

/**
 * construit une ligne de table HTML représentant une région
 * @param string[] $r tableau associatif contenant au moins les clés reg et libelle
 */
function regionToRow(array $r):string{
    return "<tr><td>{$r["reg"]}</td><td>{$r["libelle"]}</td></tr>";
}

/**
 * construit une table HTML représentatnt une liste de régions
 * @param (string[])[] $regions liste de tableaux associatifs représentant une région
 */
function regionsToTable(array $regions):string{
 $rows = implode(array_map('regionToRow',$regions));
 return "<table><tbody>$rows</tbody></table>";
}
/* d'autres fonctions seront à créer ici pour l'exercice 1 */

function departementToRow(array $d):string {
    return "<tr><td>{$d['dep']}</td><td>{$d['libelle']}</td><td>{$d['libelle_reg']}</td></tr>";
    }

function departementsToTable(array $departements):string{
    $rows = implode(array_map('departementToRow',$departements));
    return "<table><tbody>$rows</tbody></table>";
    }

function regionsToOptions(array $regions): string {
    $options = '';
    foreach ($regions as $region) {
        $options .= "<option value=\"{$region['reg']}\">{$region['libelle']}</option>";
    }
    return $options;
    }

?>
