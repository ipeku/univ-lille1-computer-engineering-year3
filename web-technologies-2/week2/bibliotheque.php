<?php

require("lib/BookReader.class.php");
require("lib/FileBookReader.class.php");
require("lib/fonctionsLivre.php");

$reader = new FileBookReader('data/livres.txt');
$booksHTML = "";

while ($book = $reader->readBook()) {
    $booksHTML .= bookToHTML($book);
}

require('views/pageBibliotheque.php');
