<?php
class Database {
    public static function connect() {
        $host = DB_HOST;
        $user = DB_USER;
        $pass = DB_PASS;
        $name = DB_NAME;

        $conn = new mysqli($host, $user, $pass, $name);

        if ($conn->connect_error) {
            die('Database Connection Failed: ' . $conn->connect_error);
        }

        return $conn;
    }
}