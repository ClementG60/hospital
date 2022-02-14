<?php
class Database {
    protected PDO $db;
    protected string $table = '';

    public function __construct()
    {
        try {
            $this->db = new PDO('mysql:host=localhost;port=3307;dbname=hospitalE2N;charset=utf8', 'root');
        } catch (Exception $error) {
            die($error->getMessage());
        }
    }
}

?>