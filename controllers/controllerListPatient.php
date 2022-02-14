<?php
if (isset($_GET['page'])) {
    $currentPage = (int) $_GET['page'];
} else {
    $currentPage = 1;
}
if (isset($_POST['search'])) {
    include '../models/Database.php';
    include '../models/Patients.php';
    $patient = new Patients;
    echo json_encode($patient->getPatientListSearch($_POST['search']));
} else {
    include 'models/Database.php';
    include 'models/Patients.php';
    $patient = new Patients;
    $patientCount = (int) $patient->countPatient()->numberPatient;
    $patientPerPage = 2;
    $pages = (int) ceil($patientCount / $patientPerPage);
    $premier = ($currentPage * $patientPerPage) - $patientPerPage;
    $patient->setPatientPerPage($patientPerPage);
    $patient->setFirstPatient($premier);

    $patientList = $patient->pagination();
}

if (isset($_POST['deletePatient'])) {
    $patient->setId($_POST['patientId']);
    $patient->deletePatient();
    header('location: listePatient.php');
}
