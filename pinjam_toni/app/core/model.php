<?php
require_once __DIR__ . "/../config/config.php";

class Model {
    protected $db;
    public function __construct() {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if($this->db->connect_errno){
            die("Database error: ".$this->db->connect_error);
        }
    }
    // Helper: run query & return associative array
    public function query($sql, $params = [], $single = false) {
        $stmt = $this->db->prepare($sql);
        if (!empty($params)) {
            // Contoh: jika ada param, asumsikan semua string
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        if ($single) {
            return $result->fetch_assoc();
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}