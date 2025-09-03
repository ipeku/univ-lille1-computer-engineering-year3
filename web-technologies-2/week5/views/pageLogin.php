<?php
/*
  Si $authentException est définie, avec un code de 1 (fail), un message d'erreur est affiché
  dans un paragraphe de classe 'message'
*/
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
    <meta charset="UTF-8"/>
    <title>Authentifiez-vous</title>
</head>
<body>


<h2>Authentifiez-vous</h2>

<?php
 if ($authentException && $authentException->getCode()==1)
   echo "<p class='message'>Erreur : login/ password erroné</p>";
?>

<form method="POST" action="<?=$_SERVER["REQUEST_URI"]?>">
 <fieldset>
  <label for="login">Login :</label>
  <input type="text" name="login" id="login" required="required" autofocus/>
  <label for="password">Mot de passe :</label>
  <input type="password" name="password" id="password" required="required" />
  <button type="submit" name="valid">OK</button>
 </fieldset>
</form>
<p>Pas encore inscrit ? <a href="create_user.php">créez un compte.</a></p>
</body>
</html>

<?php
?>
