<?php
include 'controllers/controllerDisplayInfoPatient.php';
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
        <h2>Informations du patient</h2>
        <div class="containerProfilPatient">
           <ul>
               <li>Nom : <?= $patientInfo->lastname ?></li>
               <li>Prénom : <?= $patientInfo->firstname ?></li>
               <li>Date de naissance : <?= $patientInfo->birthdate ?></li>
               <li>Mail : <?= $patientInfo->mail ?></li>
               <li>Numéro de téléphone : <?= $patientInfo->phone ?></li>
           </ul>
        </div>
    </main>

</body>

</html>