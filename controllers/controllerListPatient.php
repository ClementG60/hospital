<?php
require 'models/Patients.php';
$patients = new Patients;
$patientList = $patients->getPatientList();
?>
