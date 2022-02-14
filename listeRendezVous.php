<?php
include 'controllers/controllerListAppointment.php';
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
        <h2>Liste des rendez-vous</h2>
        <div class="containerInfo">
            <?php foreach ($appointmentList as $appointment) { ?>
                <div>
                    <ul>
                        <li><?= $appointment->lastname ?></li>
                        <li><?= $appointment->firstname ?></li>
                        <li><?= $appointment->dateHour ?></li>
                        <li><a href="rendezVous.php?idAppointment=<?= $appointment->idAppointment ?>">Modifier le rendez-vous</a></li>
                        <li>
                            <form action="" method="POST">
                                <input type="hidden" name="valueId" value="<?= $appointment->idAppointment ?>">
                                <input type="submit" name="deleteAppointment" value="Supprimez le rendez-vous">
                            </form>
                        </li>
                    </ul>
                </div>
            <?php  } ?>
        </div>
    </main>
</body>

</html>