<?php

/**
 * 
 */
function checkString(string $name, ?string $defaultValue = NULL, bool $mandatory = TRUE) : ?string {
    if (!isset($_POST[$name]) || $_POST[$name]==""){
        if ($mandatory)
            throw new ParmsException();
        else
            return $defaultValue;
    }
    $val=$_POST[$name];

    return $val;
}

?>