<?php
include('controllers/controllerAddAppointments.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style/style.css">
    <title>Partie 2</title>
</head>

<body>
    <?php include('header.php'); ?>
    <main>
        <h2>Bienvenue sur La Manu Rendez-Vous</h2>
        <p class="error"><?= isset($errorList['addAppointments']) ? $errorList['addAppointments'] : '' ?></p>
        <div class="containerForm">
            <form action="" method="POST">
                <label for="">Date du rendez-vous</label>
                <input type="datetime-local" name="datetimeAppointment" id="datetimeAppointment">
                <p><?= isset($errorList['dateHour']) ? $errorList['dateHour'] : '' ?></p>
                <label for="">Patient</label>
                <select name="idPatient" id="idPatient">
                    <option value="" disabled selected></option>
                <?php foreach($patientList as $patient) {?>
                    <option value="<?= $patient->id ?>"><?= $patient->lastname ?>  <?= $patient->firstname ?></option>
                <?php } ?>
                </select>
                <p><?= isset($errorList['idPatient']) ? $errorList['idPatient'] : '' ?></p>
                <input type="submit" name="addAppointment" value="Ajout d'un rendez-vous">
            </form>
        </div>
    </main>
</body>

</html>