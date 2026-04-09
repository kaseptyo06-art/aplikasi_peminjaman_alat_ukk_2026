<?php
class PeminjamanController extends Controller {

    public function index() {
        $peminjamanModel = $this->model('Peminjaman');

        if (isset($_GET['setujui'])) {
            $peminjamanModel->setStatus($_GET['setujui'], 'Dipinjam');
            header("Location: ?page=peminjaman");
            exit;
        }

        if (isset($_GET['tolak'])) {
            $peminjamanModel->setStatus($_GET['tolak'], 'Ditolak');
            header("Location: ?page=peminjaman");
            exit;
        }

        if (isset($_GET['kembalikan'])) {
            $peminjamanModel->setStatus($_GET['kembalikan'], 'Kembali');
            header("Location: ?page=peminjaman");
            exit;
        }

        $data['peminjaman'] = $peminjamanModel->getAll();
        $this->view('admin/peminjaman', $data);
    }

    public function ajukan() {
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
            $this->model('Peminjaman')->add($data);
            header('Location: ?page=peminjaman');
            exit;
        } else {
            $data['alat'] = $this->model('Alat')->getAll();
            $this->view('peminjam/ajukan', $data);
        }
    }

    public function setujui($id) {
        $this->model('Peminjaman')->setStatus($id, 'Dipinjam');
        header('Location: ?page=peminjaman');
        exit;
    }

    public function kembalikan($id) {
        $this->model('Peminjaman')->setStatus($id, 'Kembali');
        header('Location: ?page=peminjaman');
        exit;
    }
}