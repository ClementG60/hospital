<?php
require 'models/Database.php';
require 'models/Patients.php';
require 'class/Form.php';

$isPatientFound = false;
if (isset($_GET['id'])) {
    $patient = new Patients;
    $patient->setId(htmlspecialchars($_GET['id']));
    $isPatientFound = $patient->getPatientInfo();
    $appointmentPerPatient = $patient->getPatientAppointment();
    }

    $inputArray = [
        ['filter' => 'name', 'name' => 'lastname', 'realName' => 'un nom', 'placeholder' => '', 'label' => 'Nom', 'type' => 'text', 'value' => $patient->getLastname()],
        ['filter' => 'name', 'name' => 'firstname', 'realName' => 'un prénom', 'placeholder' => '', 'label' => 'Prénom', 'type' => 'text', 'value' => $patient->getFirstname()],
        ['filter' => 'date', 'name' => 'birthdate', 'realName' => 'une date de naissance', 'placeholder' => '', 'label' => 'Date de naissance', 'type' => 'date', 'value' => $patient->getBirthdateView()],
        ['filter' => 'phone', 'name' => 'phone', 'realName' => 'un numéro de téléphone', 'placeholder' => '', 'label' => 'Téléphone', 'type' => 'text', 'value' => $patient->getPhone()],
        ['filter' => 'email', 'name' => 'mail', 'realName' => 'une adresse de couriel', 'placeholder' => '', 'label' => 'Adresse de courriel', 'type' => 'email', 'value' => $patient->getMail()],
    ];
//Quand l'utilisateur a appuyé sur le bouton
if (isset($_POST['modifyInfo'])) {
    $errorList = [];
    $formVerif = new Form;

    $valueArray = [];
    foreach ($inputArray  as $input) {
        if ($formVerif->checkPost($input)) {
            $valueArray[$input['name']] = $_POST[$input['name']];
        } else {
            $errorList[$input['name']] = $formVerif->getErrorMessage();
        }
    }

    if (count($errorList) == 0) {
        $patient->setLastname(htmlspecialchars($valueArray['lastname']));
        $patient->setFirstname(htmlspecialchars($valueArray['firstname']));
        $patient->setBirthdate(htmlspecialchars($valueArray['birthdate']));
        $patient->setPhone(htmlspecialchars($valueArray['phone']));
        $patient->setMail(htmlspecialchars($valueArray['mail']));
        $patient->updatePatientInfo();
        header('location: listePatient.php');
    }
}
?>