<?php


function elementBuilder(string $elementType, string $content, string $elementClass = ""): string {
    $classAttribute = $elementClass ? " class=\"$elementClass\"" : "";
    return "<$elementType$classAttribute>$content</$elementType>";
}

function authorsToHTML(string $authors): string {
    $authorsArray = explode(' - ', $authors);
    $authorsHTML = array_map(fn($author) => "<span>$author</span>", $authorsArray);
    return implode(' ', $authorsHTML);
}


function coverToHTML(string $fileName): string {
    return "<img src=\"couvertures/$fileName\" alt=\"image de couverture\" />";
}

function propertyToHTML(string $propName, string $propValue): string {
    switch ($propName) {
        case 'titre':
            return elementBuilder('h2', $propValue, 'titre');
        
        case 'couverture':
            return elementBuilder('div', coverToHTML($propValue), 'couverture');
        
        case 'auteurs':
            return elementBuilder('div', authorsToHTML($propValue), 'auteurs');
        
        case 'annee':
            return elementBuilder('time', $propValue, 'annee');
        
        default:
            return elementBuilder('div', $propValue, $propName);
    }
}

function bookToHTML(array $book): string {
    $coverHTML = propertyToHTML('couverture', $book['couverture']);
    $descriptionHTML = "<div class=\"description\">";
    
    foreach ($book as $propName => $propValue) {
        if ($propName !== 'couverture') {
            $descriptionHTML .= propertyToHTML($propName, $propValue);
        }
    }
    $descriptionHTML .= "</div>";
    return "<article class=\"livre\">$coverHTML$descriptionHTML</article>";
}


// exercice 2

function libraryToHTML(BookReader $reader): string {
    $html = "<div class='library'>\n";

    while ($book = $reader->readBook()) {
        $html .= bookToHTML($book); 
    }

    $html .= "</div>\n";

    return $html;
}
?>
