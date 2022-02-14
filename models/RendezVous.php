<?php 
class Appointments extends Database {

    protected int $id;
    protected string $table = '`appointments`';

    public function addAppointment():bool
    {
        $query = 'INSERT INTO ' .$this->table. '(`dateHour`, `idPatients`) VALUES (:dateHour, :idPatients)';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $queryStatement->bindValue(':idPatients', $this->idPatients, PDO::PARAM_INT);
        return $queryStatement->execute();
    }

    public function checkAppointmentIfExist():bool
    {
        $check = false;
        $query = 'SELECT COUNT(`id`) AS `number` FROM ' . $this->table . ' WHERE `dateHour` = :dateHour';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $queryStatement->execute();
        $verifAppointment = $queryStatement->fetch(PDO::FETCH_OBJ);
        $number = $verifAppointment->number;
        if ($number) {
            $check = true;
        }
        return $check;
    }

    public function getListAppointment():array
    {
        $query = 
                'SELECT `patients`.`id` AS `idPatient`, `appointments`.`id` AS `idAppointment`, `lastname`, `firstname`, DATE_FORMAT('. $this->table .'.`dateHour`, \'%d/%m/%Y à %Hh%i\') AS `dateHour` 
                FROM `appointments`
                    INNER JOIN `patients` ON `patients`.`id` = `idPatients`';
        $queryStatement = $this->db->query($query);
        return $queryStatement->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAppointmentInfo():object
    {
        $query = 
                'SELECT `patients`.`id`, `lastname`, `firstname`, DATE_FORMAT(`appointments`.`dateHour`, \'%Y-%m-%dT%H:%i\' ) AS `dateHour`
                FROM `appointments`
                    INNER JOIN `patients` ON `patients`.`id` = `idPatients` WHERE `appointments`.`id` = :id';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryStatement->execute();
        return $queryStatement->fetch(PDO::FETCH_OBJ);
    }

    public function updateAppointment(): bool
    {
        $query = 'UPDATE ' . $this->table . ' SET `dateHour` = :dateHour WHERE `id` = :id';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $queryStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryStatement->execute();
    }

    public function deleteAppointment(): bool
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE `id` = :id';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryStatement->execute();
    }

    public function setDateHour(string $value): void
    {
        $this->dateHour = $value;
    }

    public function setIdPatients(int $value): void
    {
        $this->idPatients = $value;
    }

    public function setId(int $value): void{
        $this->id = $value;
    }

}