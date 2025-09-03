<?php


  /**
  *  prend en compte le paramètre $name passé en mode GET
  *   qui doit représenter un entier sans signe
  *  @return : valeur retenue, convertie en int.
  *   - si le paramètre est absent ou vide, renvoie  $defaultValue
  *   - si le paramètre est incorrect, déclenche une exception ParmsException
  *   @param (int|null) $defaultValue valeur par défaut
  *   @param (bool) $mandatory indique si le paramètre est obligatoire
  *
  */
 function checkUnsignedInt(string $name, ?int $defaultValue=NULL, bool $mandatory = TRUE) : ?int {
     if ( ! isset($_GET[$name]) || $_GET[$name]=="" ){
      if ($mandatory)
        throw new ParmsException("$name absent");
      else
        return $defaultValue;
     }
     $val = $_GET[$name];
     if (! ctype_digit($val))
       throw new ParmsException("$name incorrect");
     return (int) $val;
  }

  /**
  *  prend en compte le paramètre $name passé en mode GET
  *   qui doit représenter une chaîne
  *  @return : valeur retenue
  *   - si le paramètre est absent ou vide, renvoie  $defaultValue
  *   - si le paramètre est incorrect, déclenche une exception ParmsException
  *
  */
 function checkString(string $name, ?string $defaultValue=NULL, bool $mandatory = TRUE) : ?string {
    if ( ! isset($_GET[$name]) || $_GET[$name]=="" ){
      if ($mandatory)
        throw new ParmsException("$name absent");
      else
        return $defaultValue;
    }
    $val = $_GET[$name];
    return $val;
  }

 ?>
