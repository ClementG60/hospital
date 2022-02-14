<?php
include('controllers/controllerAjoutPatient.php');
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
        <p class="error"><?= isset($errorList['addPatient']) ? $errorList['addPatient'] : '' ?></p>
        <div class="containerForm">
            <form action="" method="POST">
                <?php
                foreach ($inputArray as $input) { ?>
                    <label for="<?= $input['name'] ?>"><?= $input['label'] ?></label>
                    <input type="<?= $input['type'] ?>" id="<?= $input['name'] ?>" name="<?= $input['name'] ?>" placeholder="<?= $input['placeholder'] ?>">
                    <p><?= isset($errorList[$input['name']]) ? $errorList[$input['name']] : '' ?></p>
                <?php } ?>
                <input type="submit" name="addPatient" value="Ajout du patient">
            </form>
        </div>
    </main>
</body>

</html>