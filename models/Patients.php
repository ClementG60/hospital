<?php
class Patients extends Database
{
    protected int $id;
    protected string $lastname;
    protected string $firstname;
    protected string $birthdate;
    protected string $birthdateView;
    protected string $phone;
    protected string $mail;
    protected int $patientPerPage;
    protected int $numberPage;
    protected int $firstPatient;
    protected string $table = '`patients`';

    public function addPatient(): bool
    {
        $query = 'INSERT INTO ' . $this->table
            . ' (`lastname`,`firstname`,`birthdate`,`phone`,`mail`) '
            . 'VALUES (:lastname, :firstname, :birthdate, :phone, :mail)';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $queryStatement->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $queryStatement->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $queryStatement->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $queryStatement->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        return $queryStatement->execute();
    }
    /**
     * Permet de savoir si un patient est unique
     *
     * @return boolean
     */
    public function checkPatientIfExists(): bool
    {
        $check = false;
        $query = 'SELECT COUNT(`id`) AS `number` FROM ' . $this->table
            . ' WHERE `lastname` = :lastname AND `firstname` = :firstname AND `birthdate` = :birthdate';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $queryStatement->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $queryStatement->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $queryStatement->execute();
        // $number = $queryStatement->fetch(PDO::FETCH_OBJ)->number;
        $toto = $queryStatement->fetch(PDO::FETCH_OBJ);
        // number = 0 si il n'y a pas de patient identique
        // number = 1 si il y a un patient identique
        $number = $toto->number;
        if ($number) {
            $check = true;
        }
        return $check;
    }

    public function getPatientListSearch(?string $search = null): array
    {
        $query = 'SELECT `id` AS `value` , CONCAT(`lastname`, \' \', `firstname`,\' \', DATE_FORMAT(`birthdate`, \'%d/%m/%Y\')) AS `name` FROM ' . $this->table;
        if (!is_null($search)) {
            $query .= 'WHERE `lastname` LIKE :search OR `firstname` LIKE :search OR DATE_FORMAT(`birthdate`,\'%d/%m/%Y\') LIKE :search';
            $queryStatement = $this->db->prepare($query);
            $queryStatement->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
            $queryStatement->execute();
        } else {
            $queryStatement = $this->db->query($query);
        }
        return $queryStatement->fetchAll(PDO::FETCH_OBJ);
    }

    public function getPatientInfo(): bool
    {
        $querySQLPatient = 'SELECT `id`, `lastname`, `firstname`, DATE_FORMAT(`birthdate`, \'%d/%m/%Y\') AS `birthdate`, `birthdate` AS `birthdateView`, `mail`, `phone` FROM ' . $this->table . ' WHERE `id` = :id';
        $patients = $this->db->prepare($querySQLPatient);
        $patients->bindValue(':id', $this->id, PDO::PARAM_INT);
        $patients->execute();
        $result = $patients->fetch(PDO::FETCH_OBJ);
        if (is_object($result)) {
            $this->lastname = $result->lastname;
            $this->firstname = $result->firstname;
            $this->birthdate = $result->birthdate;
            $this->birthdateView = $result->birthdateView;
            $this->phone = $result->phone;
            $this->mail = $result->mail;
            return true;
        }
        return false;
    }

    public function updatePatientInfo(): bool
    {
        $querySQLPatient = 'UPDATE ' . $this->table . ' SET `lastname` = :lastname, `firstname`= :firstname, `birthdate` = :birthdate, `mail` = :mail, `phone` = :phone WHERE `id` = :id';
        $queryStatement = $this->db->prepare($querySQLPatient);
        $queryStatement->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $queryStatement->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $queryStatement->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $queryStatement->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $queryStatement->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $queryStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryStatement->execute();
    }

    public function getPatientAppointment()
    {
        $query =
        'SELECT DATE_FORMAT(`appointments`.`dateHour`, \'%d/%m/%Y à %H:%i\' ) AS `dateHour`
        FROM `appointments`
            INNER JOIN `patients` ON `appointments`.`idPatients` = `patients`.`id` WHERE `appointments`.`idPatients` = :id ORDER BY `dateHour` ASC';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryStatement->execute();
        return $queryStatement->fetchAll(PDO::FETCH_OBJ);
    }

    public function deletePatient(): bool
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE `id` = :id';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryStatement->execute();
    }

    public function countPatient():object
    {
        $query = 'SELECT COUNT(`id`) AS `numberPatient` FROM ' . $this->table;
        $queryStatement = $this->db->query($query);
        return $queryStatement->fetch(PDO::FETCH_OBJ);
    }

    public function pagination():array
    {
        $query = 'SELECT `id` AS `value` , CONCAT(`lastname`, \' \', `firstname`,\' \', DATE_FORMAT(`birthdate`, \'%d/%m/%Y\')) AS `name` FROM ' . $this->table . ' ORDER BY `lastname`, `firstname` ASC LIMIT :firstPatient, :patientPerPage';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':firstPatient', $this->firstPatient, PDO::PARAM_INT);
        $queryStatement->bindValue(':patientPerPage', $this->patientPerPage, PDO::PARAM_INT);
        $queryStatement->execute();
        return $queryStatement->fetchAll(PDO::FETCH_OBJ);
    }

    public function setId(int $value): void
    {
        $this->id = $value;
    }

    public function setLastname(string $value): void
    {
        $this->lastname = strtoupper($value);
    }

    public function setFirstname(string $value): void
    {
        $this->firstname = $value;
    }

    public function setBirthdate(string $value): void
    {
        $this->birthdate = $value;
    }

    public function setBirthdateView(string $value): void
    {
        $this->birthdateView = $value;
    }

    public function setPhone(string $value): void
    {
        $value = str_replace([' ', '.', '-'], '', $value);
        $this->phone = $value;
    }

    public function setMail(string $value): void
    {
        $this->mail = $value;
    }

    public function setPatientPerPage(int $value):void
    {
        $this->patientPerPage = $value;
    }

    public function setNumberPage(int $value):void
    {
        $this->numberPage = $value;
    }

    public function setFirstPatient(int $value):void
    {
        $this->firstPatient = $value;
    }
    /***
     * GETTER
     */
    public function getId(): int
    {
        return $this->id;
    }
    public function getBirthdateView(): string
    {
        return $this->birthdateView;
    }
    public function getLastname(): string
    {
        return $this->lastname;
    }
    public function getFirstname(): string
    {
        return $this->firstname;
    }
    public function getBirthdate(): string
    {
        return $this->birthdate;
    }
    public function getPhone(): string
    {
        return $this->phone;
    }
    public function getMail(): string
    {
        return $this->mail;
    }
}
