<?php

class User extends Model {
    public function login($username, $password) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_assoc();
        if ($res && password_verify($password, $res['password'])) {
            return $res;
        }
        return false;
    }

    public function register($nama_lengkap, $username, $password, $level) {
        // Check if username already exists
        $checkStmt = $this->db->prepare("SELECT user_id FROM users WHERE username = ?");
        $checkStmt->bind_param("s", $username);
        $checkStmt->execute();
        $checkStmt->store_result();
        if ($checkStmt->num_rows > 0) {
            $checkStmt->close();
            return false; // Username already exists
        }
        $checkStmt->close();

        $stmt = $this->db->prepare("INSERT INTO users (nama_lengkap, username, password, level) VALUES (?, ?, ?, ?)");
        if (!$stmt) {
            die("Prepare failed: " . $this->db->error);
        }
        $stmt->bind_param("ssss", $nama_lengkap, $username, $password, $level);
        $result = $stmt->execute();
        if (!$result) {
            die("Execute failed: " . $stmt->error);
        }
        $stmt->close();
        return $result;
    }

    public function getAll() {
        return $this->query("SELECT * FROM users");
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE user_id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function add($data) {
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO users (nama_lengkap, username, password, level) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $data['nama_lengkap'], $data['username'], $password, $data['level']);
        return $stmt->execute();
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE users SET nama_lengkap=?, username=?, level=? WHERE user_id=?");
        $stmt->bind_param("sssi", $data['nama_lengkap'], $data['username'], $data['level'], $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM users WHERE user_id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}