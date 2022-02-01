<?php
require 'models/Patients.php';
$patient = new Patients;
$idPatient = htmlspecialchars($_GET['id']);
$patientInfo = $patient->getPatientInfo($idPatient);
?>