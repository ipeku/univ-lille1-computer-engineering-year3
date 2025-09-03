<?php
 class AuthentException extends Exception{
    /**
     * @param $code : 1 pour fail
     */
    public function __construct($code = 0) {
        if ($code == 0)
            parent::__construct(message: "login or password is missing", code : $code);
        else if ($code == 1)
            parent::__construct(message: "Wrong login / password", code : $code);
    }
 } 

 /**
  * Vérification des paramètres 'login' et 'password' reçus en POST
  * @param $authent_function fonction de vérification des login et password. Signature (string,string) : ?Identite
  * @return Identté en cas de succès
  * @throws AuthentException en cas d'échec (avec code 1 login/password incorrect, code 0 si absence de login ou pasword)
  */
 function check_login_post(callable $authent_function) : Identite {
 
    if ( ! isset($_POST['login'])|| ! isset($_POST['password'])) 
        throw new AuthentException(code:0);

    $user = $authent_function($_POST['login'],$_POST['password']);

    if (! $user )
        throw new AuthentException(code:1);

    return $user;        
 }

 /**
  * Vérification de l'authentification en tenant compte et/ou positionnant $_SESSION['ident']
  * @param $authent_function fonction de vérification des login et password. Signature (string,string) : ?Identite
  * @return Identté en cas de succès
  * @throws AuthentException en cas d'échec (avec code 1 login/password incorrect, code 0 si absence de login ou pasword)
  * See check_login_post&É
  */
  function check_login_with_session(callable $authent_function, ?string $session_name = NULL) : ?Identite {
   
    if ($session_name === null) {
        $session_name = 'ident';
    }
    
    if (isset($_SESSION[$session_name])) {
        return $_SESSION[$session_name];
    }
    
    try {
        $identity = check_login_post($authent_function);
        $_SESSION[$session_name] = $identity;
        return $identity;
    } catch (AuthentException $e) {
         /* à compléter, question 2 */
        if ($e->getCode() == 0) {
            throw new AuthentException(0);
        } else if ($e->getCode() == 1) {
            throw new AuthentException(1);
        }
    }
}
    
 

?>