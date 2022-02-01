<?php
include 'controllers/controllerListPatient.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style/style.css">
    <title>Hopital de la Porte Verte</title>
</head>

<body>
    <?php include('header.php'); ?>
    <main>
        <h2>Liste des patients</h2>
        <div class="containerInfoPatient">
            <?php foreach ($patientList as $patient) { ?>
                <div>
                    <ul>
                        <li><?= $patient->firstname ?></li>
                        <li><?= $patient->lastname ?></li>
                        <li><?= $patient->birthdate ?></li>
                        <li><a href="profilPatients.php?id=<?= $patient->id ?>">Afficher le profil complet du patient</a></li>
                    </ul>
                </div>
            <?php  } ?>
        </div>
        <p class="link">Pour ajouter un nouveau patient, veuillez cliquer <a href=""> ici</a>.</p>
    </main>

</body>

</html>