<?php
    /** 
    * forme 'équivalente' ASCII, sans accents, diacritiques ni ligatures
    */
    function unaccent(string $text) : string {
        return iconv('utf8', 'ascii//TRANSLIT', $text);
    }

 ?>