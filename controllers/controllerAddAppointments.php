<?php
require 'models/Database.php';
require 'models/RendezVous.php';
require 'models/Patients.php';
$regexDateHour = '/^(202[2-9])-((0[1-9])|(1[0-2]))-((0[1-9])|([1-2][0-9])|(3[0-1]))T((0[1-9])|(1[0-9])|(2[0-3])):([0-5][0-9])$/';
$errorList = [];

$appointments = new Appointments;
$patient = new Patients;
$patientList = $patient->getPatientList();

if (isset($_POST['addAppointment'])) {
    if (!empty($_POST['datetimeAppointment'])) {
        if (preg_match($regexDateHour, $_POST['datetimeAppointment'])) {
            $appointments->setDateHour(htmlspecialchars($_POST['datetimeAppointment']));
        } else {
            $errorList['dateHour'] = 'Veuillez entrer une date et une heure valide.';
        }
    } else {
        $errorList['dateHour'] = 'Veuillez entrer une date et une heure.';
    }

    if (!empty($_POST['idPatient'])) {
        if (is_numeric($_POST['idPatient'])) {
            $appointments->setIdPatients(htmlspecialchars(intval($_POST['idPatient'])));
        } else {
            $errorList['idPatient'] = 'Veuillez entrer un patient valide.';
        }
    } else {
        $errorList['idPatient'] = 'Veuillez entrer un patient.';
    }

    if (count($errorList) == 0) {
        if (!$appointments->checkAppointmentIfExist()) {
            $appointments->addAppointment();
            header('location: ajoutRendezVous.php');
            exit;
        } else {
            $errorList['addAppointments'] = 'Un rendez-vous a déjà été pris à cette date et cette heure-là.';
        }
    }
}
