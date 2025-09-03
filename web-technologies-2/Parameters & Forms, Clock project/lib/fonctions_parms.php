<?php
 require(__DIR__."/color_defs.php"); // definit la constante COLOR_KEYWORDS

 /**
  *  prend en compte le paramètre $name passé en mode GET
  *   qui doit représenter une couleur CSS
  *  @return : valeur retenue
  *   - si le paramètre est absent ou vide, renvoie  $defaultValue
  *   - si le paramètre est incorrect, déclenche une exception ParmsException
  *
  */
  function checkColor(string $name, string $defaultValue) : string { 

   if (!isset($_GET[$name]) || $_GET[$name] === '') {
       return $defaultValue; 
   }

   $value = $_GET[$name];


   if (!isset(COLOR_KEYWORDS[$value]) && !preg_match(COLOR_REGEXP, $value)&&$value !== 'transparent') {
    throw new ParmsException("Le paramètre '$name' doit être un nom de couleur CSS valide ou une couleur en format HEX valide.");
}

   return $value; 


}
  
 /**
  *  prend en compte le paramètre $name passé en mode GET
  *   qui doit représenter un entier sans signe
  *  @return : valeur retenue, convertie en int.
  *   - si le paramètre est absent ou vide, renvoie  $defaultValue
  *   - si le paramètre est incorrect, déclenche une exception ParmsException
  *
  */
 function checkUnsignedInt(string $name, int $defaultValue) : int {
       if (!isset($_GET[$name]) || $_GET[$name]===''){
          return $defaultValue;
       }
       $value=$_GET[$name];

       if (!ctype_digit($value)) {
          throw new ParmsException("Le paramètre '$name' doit être un entier sans signe.");
          }
          
          return (int)$value;
     
     }

  
     
 ?>