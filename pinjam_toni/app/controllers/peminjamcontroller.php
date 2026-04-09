<?php
class PeminjamController extends Controller
{
    public function peminjaman()
    {
        $peminjamanModel = $this->model('Peminjaman');
        $alatModel = $this->model('Alat');

        // Pengajuan peminjaman
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['aksi'] === 'ajukan') {
            $data = [
                'alat_id' => $_POST['id_alat'],
                'user_id' => $_SESSION['user']['user_id'],
                'tgl_pinjam' => $_POST['tgl_pinjam'],
                'tgl_kembali' => $_POST['tgl_kembali'],
                'status' => 'Menunggu',
                'petugas_id' => 0,
                'denda' => 0,
                'total_denda' => 0,
            ];
            $peminjamanModel->add($data);
            header("Location: ?page=peminjaman");
            exit;
        }
        // Pengembalian (peminjam sendiri)
        if (isset($_GET['kembalikan'])) {
            $p = $peminjamanModel->getById($_GET['kembalikan']);
            if ($p && $p['user_id']==$_SESSION['user']['user_id'] && $p['status']=='Dipinjam') {
                $peminjamanModel->setStatus($_GET['kembalikan'], 'Kembali');
            }
            header("Location: ?page=peminjaman");
            exit;
        }
        // Data untuk form dropdown+riwayat
        $data['alat'] = $alatModel->getAll();
        $data['riwayat'] = $peminjamanModel->getByUser($_SESSION['user']['user_id']);
        $data['selectedAlat'] = $_GET['alat'] ?? null;
        $this->view('peminjam/peminjaman', $data);
    }

    public function status()
    {
        $peminjamanModel = $this->model('Peminjaman');
        // Pengembalian (peminjam sendiri)
        if (isset($_GET['kembalikan'])) {
            $p = $peminjamanModel->getById($_GET['kembalikan']);
            if ($p && $p['user_id']==$_SESSION['user']['user_id'] && $p['status']=='Dipinjam') {
                $peminjamanModel->setStatus($_GET['kembalikan'], 'Kembali');
            }
            header("Location: ?page=status");
            exit;
        }
        // Data status peminjaman aktif (belum kembali)
        $data['status'] = $peminjamanModel->getByUser($_SESSION['user']['user_id'], "status != 'Kembali' AND status != 'Ditolak'");
        $this->view('peminjam/status', $data);
    }

    public function riwayat()
    {
        $peminjamanModel = $this->model('Peminjaman');
        // Data riwayat lengkap
        $data['riwayat'] = $peminjamanModel->getByUser($_SESSION['user']['user_id']);
        $this->view('peminjam/riwayat', $data);
    }

    public function ajukan()
    {
        $peminjamanModel = $this->model('Peminjaman');
        $alatModel = $this->model('Alat');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'alat_id' => $_POST['id_alat'],
                'user_id' => $_SESSION['user']['user_id'],
                'tgl_pinjam' => $_POST['tgl_pinjam'],
                'tgl_kembali' => $_POST['tgl_kembali'],
                'status' => 'Menunggu',
                'petugas_id' => 0,
                'denda' => 0,
                'total_denda' => 0,
            ];
            $peminjamanModel->add($data);
            header("Location: ?page=peminjaman");
            exit;
        }

        $data['alat'] = $alatModel->getAll();
        $this->view('peminjam/ajukan', $data);
    }
}