<?php /*
   Licence Informatique Université de Lille

   Assert : Une variable globale nommée $table_regions contient le code d'une table HTML
*/?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Départements - formulaire</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="styles/regions.css" />
    </head>
    <body>
        <header>
            <h1>Chercher des départements</h1>
        </header>
        <form action="departements.php" method="get">
            <select name="reg" id="reg">
                <option value="">Toutes</option>
                <?php 
                    foreach ($regions as $region) {
                        echo '<option value="' . htmlspecialchars($region['reg']) . '">' . htmlspecialchars($region['libelle']) . '</option>';
                }
                ?>
            </select>
            <button type="submit">Envoyer</button>
        </form>
        


    </body>
</html>
