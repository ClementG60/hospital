<?php
require 'models/Database.php';
require 'models/RendezVous.php';

$appointments = new Appointments;

$appointmentList = $appointments->getListAppointment();

if (isset($_POST['deleteAppointment'])) {
    $appointments->setId($_POST['valueId']);
    $appointments->deleteAppointment();
    header('location: listeRendezVous.php');
}
?>