<?php
include 'controllers/controllerDisplayInfoAppointment.php';
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
        <h2>Modification de l'horaire du rendez-vous</h2>
        <div class="containerForm">
            <form action="" method="POST">
                <label for="">Horaire du rendez-vous</label>
                <input type="datetime-local" name="datetimeAppointment" id="datetimeAppointment" value="<?= $appointmentInfo->dateHour ?>">
                <p><?= isset($errorList['dateHour']) ? $errorList['dateHour'] : '' ?></p>
                <label for="">Patient</label>
                <input disabled type="text" value="<?= $appointmentInfo->lastname ?> <?= $appointmentInfo->firstname ?>">
                </select>
                <p><?= isset($errorList['idPatient']) ? $errorList['idPatient'] : '' ?></p>
                <input type="submit" name="modifyAppointment" value="Modifier l'horaire">
            </form>
        </div>
    </main>
</body>
</html>