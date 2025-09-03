<?php
  /*
    Utilise la variable globale $user qui doit être instance de Identite
  */
  
  $avatarURL = "images/avatar_def.png";
  //$avatarURL = "getAvatar.php?login={$user->login}";
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
    <meta charset="UTF-8"/>
    <title>Page à accès contrôlé</title>
    <link rel="stylesheet" type="text/css" href="style_authent.css" />
  </head>
<body>
<header>
<h1>

<?php
echo "<img class=\"avatar\" src=\"$avatarURL\" />";
echo "{$user->prenom} {$user->nom}";
?>
</h1>
</header>
<div id="content">
  Cette page est un peu vide, non ?
</div>
<footer><a href="logout.php">Se déconnecter</a>
<!-- <a href="formUpload.php">Changer d'avatar</a>-->
</footer>
</body>
</html>
