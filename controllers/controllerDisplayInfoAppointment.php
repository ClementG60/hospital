<?php
require 'models/Database.php';
require 'models/RendezVous.php';
require 'models/Patients.php';
$regexDateHour = '/^(2022)-((0[1-9])|(1[0-2]))-((0[1-9])|([1-2][0-9])|(3[0-1]))[T]((0[1-9])|(1[0-9])|(2[0-4])):([0-5][0-9])$/';

$appointments = new Appointments;

$appointmentList = $appointments->getListAppointment();
if (isset($_GET['idAppointment'])) {
    $appointments->setId(htmlspecialchars($_GET['idAppointment']));
    $appointmentInfo = $appointments->getAppointmentInfo();
}

if (isset($_POST['modifyAppointment'])) {
    $errorList = [];
    if (!empty($_POST['datetimeAppointment'])) {
        if (preg_match($regexDateHour, $_POST['datetimeAppointment'])) {
            $appointments->setDateHour(htmlspecialchars($_POST['datetimeAppointment']));
        } else {
            $errorList['dateHour'] = 'Veuillez entrer une date et une heure valide.';
        }
    } else {
        $errorList['dateHour'] = 'Veuillez entrer une date et une heure.';
    }
    if (count($errorList) == 0) {
        var_dump($_POST['datetimeAppointment']);
        $appointments->setDateHour(htmlspecialchars($_POST['datetimeAppointment']));
        $appointments->updateAppointment();
        header('location: listeRendezVous.php');
    }
}
?>