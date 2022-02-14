<?php
include 'controllers/controllerListPatient.php';
var_dump($currentPage);
var_dump($pages);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/style/style.css">
    <title>Hopital de la Porte Verte</title>
</head>

<body>
    <?php include('header.php'); ?>
    <main>
        <h2>Liste des patients</h2>
        <div class="searchBar">
            <form action="" method="POST">
                <input type="search" name="search" id="search" placeholder="Saisissez votre recherche">
            </form>
        </div>
        <div class="containerInfo" id="patientList">
            <?php foreach ($patientList as $patient) { ?>
                <div>
                    <ul>
                        <li><?= $patient->name ?></li>
                        <li><a href="profilPatients.php?id=<?= $patient->value ?>">Afficher le profil complet du patient</a></li>
                        <li>
                            <form action="" method="POST">
                                <input type="hidden" name="patientId" value="<?= $patient->value ?>">
                                <input type="submit" name="deletePatient" value="Supprimer le client">
                            </form>
                        </li>
                    </ul>
                </div>
            <?php  } ?>
        </div>
        <p class="link">Pour ajouter un nouveau patient, veuillez cliquer <a href=""> ici</a>.</p>
        <nav>
            <ul>
                <li class="<?= $currentPage == 1 ? 'disabled' : '' ?>">
                    <a href="listePatient.php?page=<?= $currentPage - 1 ?>"><i class="bi bi-arrow-left"></i></a>
                </li>

                <?php for ($page = 1; $page < $pages; $page++) { ?>
                    <li <?= $currentPage == $page ? 'active' : '' ?>>
                        <a href="listePatient.php?page=<?= $currentPage ?>"><?= $currentPage ?></a>
                    </li>
                <?php } ?>
                <li class="<?= ($currentPage == $pages) ? 'disabled' : '' ?>">
                    <a href="listePatient.php?page=<?= $currentPage + 1 ?>"><i class="bi bi-arrow-right"></i></a>
                </li>
            </ul>
        </nav>
    </main>
    <script src="assets/script/filterPatients.js"></script>
</body>

</html>