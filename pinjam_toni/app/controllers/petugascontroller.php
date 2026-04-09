<?php
class PetugasController extends Controller
{
    public function peminjaman()
    {
        $peminjamanModel = $this->model('Peminjaman');
        // Handler status
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
        $this->view('petugas/peminjaman', $data);
    }

    public function laporan()
    {
        $peminjamanModel = $this->model('Peminjaman');
        $data['peminjaman'] = $peminjamanModel->getAll("status = 'Dipinjam'");
        $this->view('petugas/laporan', $data);
    }

    public function pemantauan()
    {
        $peminjamanModel = $this->model('Peminjaman');
        $data['peminjaman'] = $peminjamanModel->getAll("status = 'Dipinjam'");
        $this->view('petugas/pemantauan', $data);
    }
}