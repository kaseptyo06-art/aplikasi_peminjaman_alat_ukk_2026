<?php

class Kategori extends Model {
    public function getAll() {
        return $this->query("SELECT * FROM kategori");
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM kategori WHERE kategori_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function add($data) {
        $stmt = $this->db->prepare("INSERT INTO kategori(nama_kategori, deskripsi) VALUES (?, ?)");
        $stmt->bind_param("ss", $data['nama_kategori'], $data['deskripsi']);
        return $stmt->execute();
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE kategori SET nama_kategori = ?, deskripsi = ? WHERE kategori_id = ?");
        $stmt->bind_param("ssi", $data['nama_kategori'], $data['deskripsi'], $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM kategori WHERE kategori_id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}