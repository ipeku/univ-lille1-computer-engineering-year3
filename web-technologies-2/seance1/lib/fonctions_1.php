<?php

function afficheVar($n, $s) {
    return "\$n vaut $n et \$s vaut $s";
}


function n_parag($texte, $n) {
    $resultat = '';
    for ($i = 0; $i < $n; $i++) {
        $resultat .= "<p>$texte</p>";
    }
    return $resultat;
}


function paragrapheTronque($texte, $i) {
    $texteTronque = substr($texte, 0, $i);
    return "<p>$texteTronque</p>";
}

function diminue($texte) {
    $resultat = '';
    for ($i = 0; $i <= strlen($texte); $i++) {
        $resultat .= "<p>" . substr($texte, 0, strlen($texte) - $i) . "</p>";
    }
    return $resultat;
}


function diminueListe($texte) {
    $resultat = '<ul>';
    $length = strlen($texte);
    for ($i = 0; $i < $length; $i++) {
        $resultat .= "<li>" . substr($texte, 0, $length - $i) . "</li>";
    }
    $resultat .= '</ul>';
    return $resultat;
}

function multiplication($a, $b) {
    return "<li>$a * $b = " . ($a * $b) . "</li>";
}

function tableMultiplication($n) {
    $resultat = '<ul>';
    for ($i = 1; $i <= 9; $i++) {
        $resultat .= multiplication($n, $i);
    }
    $resultat .= '</ul>';
    return $resultat;
}


function tablesMultiplications() {
    $res = '<ul>';
    for ($i=1; $i < 10; $i++) { 
        $res .= '<li>';
        $res .= tableMultiplication($i);
        $res .= '</li>';
    }
    return $res . '</ul>';
}




function tableauMult() {
    $resultat = '<table id="multiplications"><tr>' . ligneEntete() . '</tr>';
    for ($i = 1; $i <= 9; $i++) {
        $resultat .= '<tr>' . ligneTable($i) . '</tr>';
    }
    $resultat .= '</table>';
    return $resultat;
}

function ligneEntete() {
    $resultat = '<th></th>';
    for ($i = 1; $i <= 9; $i++) {
        $resultat .= "<th>$i</th>";
    }
    return $resultat;
}

function ligneTable($i) {
    $resultat = "<th>$i</th>";
    for ($j = 1; $j <= 9; $j++) {
        $resultat .= "<td>" . ($i * $j) . "</td>";
    }
    return $resultat;
}

function enParagraphes($chaine) {
    $parties = explode('+', $chaine);
    $paragraphes = array_map('trim', $parties);
    $resultat = '';
    foreach ($paragraphes as $paragraphe) {
        $resultat .= "<p>$paragraphe</p>";
    }
    return $resultat;
}

function enSpan($s) {
    $parties = explode(' - ', $s);
    $spans = array_map('trim', $parties);
    $resultat = '';
    foreach ($spans as $span) {
        $resultat .= "<span>$span</span>";
    }
    return $resultat;
}

?>
