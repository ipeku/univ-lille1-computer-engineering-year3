<?php
$num_quest = 0;
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Premier exercice PHP</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="iniPHP.css" />
    <script src="terrain.js"></script>
</head>
<body>
    <header>
        <h1>Premier exercice PHP</h1>
        <h2>Réalisé par <span class="nom">Ipek Unluakin</span></h2>
    </header>

    <section>
        <h2>Question <?= $num_quest++ ?></h2>
        <p>Nous sommes le <?= date('d / m / Y') ?></p>
    </section>

    <?php
    include_once 'lib/fonctions_1.php';
    ?>

    <!-- Q1 -->
    <section>
        <h2>Question <?= $num_quest++ ?></h2>
        <p><?= afficheVar(16, "bonjour") ?></p>
    </section>

    <!-- Q2 -->
    <section>
        <h2>Question <?= $num_quest++ ?></h2>
        <p><?= n_parag("bonjour_le_monde", 3) ?></p>
    </section>

    <!-- Q3 -->
    <section>
        <h2>Question <?= $num_quest++ ?></h2>
        <p><?= diminue("bonjour_le_monde") ?></p>
    </section>

    <!-- Q4 -->
    <section>
        <h2>Question <?= $num_quest++ ?></h2>
        <?= diminueListe("bonjour_le_monde") ?>
    </section>

    <!-- Q5 -->
    <section>
        <h2>Question <?= $num_quest++ ?></h2>
        <?= tableMultiplication(2) ?>
    </section>

    <!-- Q6 -->
    <section>
        <h2>Question <?= $num_quest++ ?></h2>
        <?= tablesMultiplications() ?>
    </section>

    <!-- Q7 -->
    <section>
        <h2>Question <?= $num_quest++ ?></h2>
        <?= tableauMult() ?>
    </section>

    <!-- Q8 -->
    <section>
        <h2>Question <?= $num_quest++ ?></h2>
        <?= enParagraphes("Et qu'on sorte+ Vistement : +Car Clément + Le vous mande.") ?>
    </section>

    <!-- Q9 -->
    <section>
        <h2>Question <?= $num_quest++ ?></h2>
        <?= enSpan("Dupont - Durand") ?>
    </section>

  

</body>
</html>
