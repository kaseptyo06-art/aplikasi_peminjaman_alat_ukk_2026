<?php

class Alat extends Model {
    public function getAll() {
        return $this->query("SELECT alat.*, kategori.nama_kategori FROM alat LEFT JOIN kategori ON alat.kategori_id = kategori.kategori_id");
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM alat WHERE alat_id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function add($data) {
        $gambar = $data['gambar'] ?? '';
        $stmt = $this->db->prepare("INSERT INTO alat(nama_alat, stok, kategori_id, gambar) VALUES (?,?,?,?)");
        $stmt->bind_param("siis", $data['nama_alat'], $data['stok'], $data['id_kategori'], $gambar);
        return $stmt->execute();
    }

    public function update($id, $data) {
        if (!empty($data['gambar'])) {
            $stmt = $this->db->prepare("UPDATE alat SET nama_alat=?, stok=?, kategori_id=?, gambar=? WHERE alat_id=?");
            $stmt->bind_param("siisi", $data['nama_alat'], $data['stok'], $data['id_kategori'], $data['gambar'], $id);
        } else {
            $stmt = $this->db->prepare("UPDATE alat SET nama_alat=?, stok=?, kategori_id=? WHERE alat_id=?");
            $stmt->bind_param("siii", $data['nama_alat'], $data['stok'], $data['id_kategori'], $id);
        }
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM alat WHERE alat_id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}