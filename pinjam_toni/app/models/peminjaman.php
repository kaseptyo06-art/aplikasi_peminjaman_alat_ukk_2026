<?php

class Peminjaman extends Model {
    public function getAll($filter = '') {
        $query = "SELECT peminjaman.id_peminjaman AS id, peminjaman.*, users.nama_lengkap, pa.nama_alat, peminjaman.tgl_kembali_seharusnya AS tgl_kembali
            FROM peminjaman
            LEFT JOIN users ON peminjaman.user_id = users.user_id
            LEFT JOIN peminjaman_alat AS pa ON peminjaman.peminjaman_alat_id = pa.id_peminjaman";
        if ($filter) {
            $query .= " WHERE $filter";
        }
        return $this->query($query);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM peminjaman WHERE id_peminjaman=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    private function createAlatSnapshot($alatId) {
        $stmt = $this->db->prepare("SELECT alat_id, kategori_id, nama_alat, stok, gambar, denda_per_hari FROM alat WHERE alat_id = ?");
        $stmt->bind_param("i", $alatId);
        $stmt->execute();
        $alat = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        if (!$alat) {
            return false;
        }

        $insert = $this->db->prepare("INSERT INTO peminjaman_alat (alat_id, kategori_id, nama_alat, stok, gambar, denda_per_hari) VALUES (?, ?, ?, ?, ?, ?)");
        $insert->bind_param("iisisi", $alat['alat_id'], $alat['kategori_id'], $alat['nama_alat'], $alat['stok'], $alat['gambar'], $alat['denda_per_hari']);
        $success = $insert->execute();
        if (!$success) {
            $insert->close();
            return false;
        }
        $snapshotId = $this->db->insert_id;
        $insert->close();
        return $snapshotId;
    }

    private function getDefaultPetugasId() {
        $stmt = $this->db->prepare("SELECT user_id FROM users WHERE level = 'Petugas' LIMIT 1");
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        if ($result) {
            return $result['user_id'];
        }
        $stmt = $this->db->prepare("SELECT user_id FROM users WHERE level = 'Admin' LIMIT 1");
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result ? $result['user_id'] : 1;
    }

    public function add($data) {
        $snapshotId = $this->createAlatSnapshot($data['alat_id']);
        if (!$snapshotId) {
            return false;
        }

        $petugasId = $this->getDefaultPetugasId();
        $stmt = $this->db->prepare("INSERT INTO peminjaman (peminjaman_alat_id, user_id, tgl_pinjam, tgl_kembali_seharusnya, status, petugas_id, denda, total_denda) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iisssidd", $snapshotId, $data['user_id'], $data['tgl_pinjam'], $data['tgl_kembali'], $data['status'], $petugasId, $data['denda'], $data['total_denda']);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function getByUser($userId, $filter = '') {
        $query = "SELECT peminjaman.id_peminjaman AS id, peminjaman.*, pa.nama_alat, peminjaman.tgl_kembali_seharusnya AS tgl_kembali FROM peminjaman LEFT JOIN peminjaman_alat AS pa ON peminjaman.peminjaman_alat_id = pa.id_peminjaman WHERE peminjaman.user_id = ?";
        if ($filter) {
            $query .= " AND ($filter)";
        }
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    private function getAlatIdForPeminjaman($id) {
        $stmt = $this->db->prepare("SELECT pa.alat_id FROM peminjaman JOIN peminjaman_alat AS pa ON peminjaman.peminjaman_alat_id = pa.id_peminjaman WHERE peminjaman.id_peminjaman = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result ? $result['alat_id'] : false;
    }

    private function decrementStock($alatId) {
        $stmt = $this->db->prepare("UPDATE alat SET stok = stok - 1 WHERE alat_id = ? AND stok > 0");
        $stmt->bind_param("i", $alatId);
        $stmt->execute();
        $success = $stmt->affected_rows > 0;
        $stmt->close();
        return $success;
    }

    private function incrementStock($alatId) {
        $stmt = $this->db->prepare("UPDATE alat SET stok = stok + 1 WHERE alat_id = ?");
        $stmt->bind_param("i", $alatId);
        $stmt->execute();
        $stmt->close();
        return true;
    }

    public function setStatus($id, $status) {
        $current = $this->getById($id);
        if (!$current) {
            return false;
        }
        $oldStatus = strtolower($current['status']);
        $newStatus = strtolower($status);

        if ($newStatus === 'dipinjam' && $oldStatus !== 'dipinjam') {
            $alatId = $this->getAlatIdForPeminjaman($id);
            if (!$alatId || !$this->decrementStock($alatId)) {
                return false;
            }
        }

        if ($newStatus === 'kembali' && $oldStatus === 'dipinjam') {
            $alatId = $this->getAlatIdForPeminjaman($id);
            if ($alatId) {
                $this->incrementStock($alatId);
            }
        }

        $stmt = $this->db->prepare("UPDATE peminjaman SET status=? WHERE id_peminjaman=?");
        $stmt->bind_param("si", $status, $id);
        $stmt->execute();
        return $stmt->affected_rows >= 0;
    }
}