<?php
class DataLayer {
	// private ?PDO $connexion = NULL; // le typage des attributs est valide uniquement pour PHP>=7.4

	private  $connexion = NULL; // connexion de type PDO   compat PHP<=7.3

	/**
	 * @param $DSNFileName : file containing DSN
	 */
	function __construct(string $dsn, ?array $options = null){
		$this->connexion = new PDO($dsn, options:$options);
		// paramètres de fonctionnement de PDO :
		$this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // déclenchement d'exception en cas d'erreur
		$this->connexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC); // fetch renvoie une table associative
		// réglage d'un schéma par défaut :
		$this->connexion->query('set search_path=authent');
	}

    function authentification(string $login, string $password) : ?Identite {
        $sql = <<<EOD
        SELECT login, nom, prenom, password FROM users WHERE login = :login
        EOD;
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindValue(':login', $login);
        $stmt->execute();
        
        $user = $stmt->fetch();
    
        if ($user && crypt($password, $user['password']) == $user['password']) {
            return new Identite($user['login'], $user['nom'], $user['prenom']);
        }
        return null;
    }

    /**
    * @return bool indiquant si l'ajout a été réalisé
    */
    function createUser(string $login, string $password, string $nom, string $prenom) : bool	 {
        $hashedPassword = password_hash($password, CRYPT_BLOWFISH);
        $sql = <<<EOD
        INSERT INTO users (login, password, nom, prenom) 
        VALUES (:login, :password, :nom, :prenom)
EOD;
        $stmt = $this->connexion->prepare($sql);

         // à compléter 

        $stmt->bindValue(':login', $login);
        $stmt->bindValue(':password', $hashedPassword);
        $stmt->bindValue(':nom', $nom);
        $stmt->bindValue(':prenom', $prenom);

        try {
            $stmt->execute(); // pour un CREATE
            return $stmt->rowCount() == 1; // vérification modif effectuée
        } catch (PDOException $e) {
          return false;
        }

    }


}
?>

