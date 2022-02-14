<?php
require 'class/Form.php';
require 'models/Database.php';
require 'models/Patients.php';

// $firstnameArray = ['filter' => 'name', 'name' => 'firstname', 'realName' => 'un prénom'];
// $lastnameArray = ['filter' => 'name', 'name' => 'lastname', 'realName' => 'un nom de famille'];
// $birthdateArray = ['filter' => 'date', 'name' => 'birthdate', 'realName' => 'une date de naissance'];
// $inputArray = [ $lastnameArray,$firstnameArray, $birthdateArray];

$inputArray = [
    ['filter' => 'name', 'name' => 'lastname', 'realName' => 'un nom de famille', 'placeholder' => '', 'label' => 'Nom de famille', 'type' => 'text'],
    ['filter' => 'name', 'name' => 'firstname', 'realName' => 'un prénom', 'placeholder' => '', 'label' => 'Prénom', 'type' => 'text'],
    ['filter' => 'date', 'name' => 'birthdate', 'realName' => 'une date de naissance', 'placeholder' => '', 'label' => 'Date de naissance', 'type' => 'date'],
    ['filter' => 'phone', 'name' => 'phone', 'realName' => 'un numéro de téléphone', 'placeholder' => '', 'label' => 'Téléphone', 'type' => 'text'],
    ['filter' => 'email', 'name' => 'mail', 'realName' => 'une adresse de couriel', 'placeholder' => '', 'label' => 'Adresse de courriel', 'type' => 'email'],
];
//Quand l'utilisateur a appuyé sur le bouton
if (isset($_POST['addPatient'])) {
    $errorList = [];
    $formVerif = new Form;

    $valueArray = [];
    foreach ($inputArray as $input) {
        if ($formVerif->checkPost($input)) {
            $valueArray[$input['name']] = $_POST[$input['name']];
        } else {
            $errorList[$input['name']] = $formVerif->getErrorMessage();
        }
    }

    if (count($errorList) == 0) {
        $patient = new Patients;
        $patient->setLastname(htmlspecialchars($valueArray['lastname']));
        $patient->setFirstname(htmlspecialchars($valueArray['firstname']));
        $patient->setBirthdate(htmlspecialchars($valueArray['birthdate']));
        $patient->setPhone(htmlspecialchars($valueArray['phone']));
        $patient->setMail(htmlspecialchars($valueArray['mail']));
        if (!$patient->checkPatientIfExists()) {
            $patient->addPatient();
            header('location: index.php');
            exit;
        } else {
            $errorList['addPatient'] = 'Ce patient existe déjà dans la base de donnée. Si vous souhaitez modifier ses informations, allez directement sur la page du patient concerné.';
        }
    }
}
