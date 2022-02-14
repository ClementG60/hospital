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
        <?php if ($isPatientFound) {  ?>
            <div class="containerProfilPatient">
                <div name="infoPatient" id="infoPatient">
                    <div class="buttonEdit">
                        <i class="fas fa-edit" id="edit" name="edit" onclick="updateInfo()"></i>
                    </div>
                    <ul>
                        <li>Nom : <?= $patient->getLastname() ?></li>
                        <li>Prénom : <?= $patient->getFirstname() ?></li>
                        <li>Date de naissance : <?= $patient->getBirthdate() ?></li>
                        <li>Mail : <?= $patient->getMail()  ?></li>
                        <li>Numéro de téléphone : <?= $patient->getPhone()  ?></li>
                    </ul>
                </div>
                <div class="containerFormUpdate hide" name="updateInfoPatient" id="updateInfoPatient">
                    <div class="buttonClose">
                        <i class="fas fa-times" id="close" name="close" onclick="closeUpdateInfo()"></i>
                    </div>
                    <form class="formUpdatePatient" action="" method="POST">
                        <?php foreach ($inputArray as $input) { ?>
                            <label for="<?= $input['name'] ?>"><?= $input['label'] ?></label>
                            <input type="<?= $input['type'] ?>" id="<?= $input['name'] ?>" name="<?= $input['name'] ?>" value="<?= $input['value']  ?>">
                            <p><?= isset($errorList[$input['name']]) ? $errorList[$input['name']] : '' ?></p>
                        <?php } ?>
                        <input type="submit" name="modifyInfo" value="Modifier les informations">
                    </form>
                </div>
            </div>
        <?php } else { ?>
            <p>Merci de contacter le service technique si le problème persiste.</p>
        <?php } ?>
        <h2>Vos rendez-vous</h2>
        <div class="containerProfilPatient">
            <div class="infoAppointment" name="infoAppointment">
                <?php foreach ($appointmentPerPatient as $appointment) { ?>
                    <p><?= $appointment->dateHour ?></p>
                <?php } ?>
            </div>
        </div>
    </main>

</body>
<script src="assets/script/script.js"></script>

</html>