<?php
session_start();

require_once __DIR__ . "/../app/core/controller.php";
require_once __DIR__ . "/../app/core/model.php";

$page = $_GET['page'] ?? 'login';

// Prevent caching for protected pages
if ($page !== 'login' && $page !== 'register') {
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');
}

switch($page) {
    case 'login':
        require_once "../app/controllers/AuthController.php";
        $auth = new AuthController();
        $auth->login();
        break;
    case 'logout':
        require_once "../app/controllers/AuthController.php";
        $auth = new AuthController();
        $auth->logout();
        break;
    case 'register':
        require_once "../app/controllers/AuthController.php";
        $auth = new AuthController();
        $auth->register();
        break;
    case 'users':
        if (isset($_SESSION['user']) && $_SESSION['user']['level'] === 'Admin') {
            require_once "../app/controllers/AdminController.php";
            $admin = new AdminController();
            $admin->users();
        } else {
            header('Location: index.php?page=login');
            exit;
        }
        break;
    case 'alat':
        if (isset($_SESSION['user']) && $_SESSION['user']['level'] === 'Admin') {
            require_once "../app/controllers/AdminController.php";
            $admin = new AdminController();
            $admin->alat();
        } else {
            header('Location: index.php?page=login');
            exit;
        }
        break;
    case 'kategori':
        if (isset($_SESSION['user']) && $_SESSION['user']['level'] === 'Admin') {
            require_once "../app/controllers/AdminController.php";
            $admin = new AdminController();
            $admin->kategori();
        } else {
            header('Location: index.php?page=login');
            exit;
        }
        break;
    case 'peminjaman':
        // Untuk admin atau petugas atau peminjam
        if (isset($_SESSION['user'])) {
            switch (strtolower($_SESSION['user']['level'])) {
                case 'admin':
                    require_once "../app/controllers/PeminjamanController.php";
                    $peminjaman = new PeminjamanController();
                    $peminjaman->index();
                    break;
                case 'petugas':
                    require_once "../app/controllers/PetugasController.php";
                    $petugas = new PetugasController();
                    $petugas->peminjaman();
                    break;
                case 'peminjam':
                    require_once "../app/controllers/PeminjamController.php";
                    $peminjam = new PeminjamController();
                    $peminjam->peminjaman();
                    break;
                default:
                    echo "Unauthorized";
                    break;
            }
        } else {
            header('Location: index.php?page=login');
            exit;
        }
        break;
    case 'ajukan':
        if (isset($_SESSION['user']) && $_SESSION['user']['level'] === 'Peminjam') {
            require_once "../app/controllers/PeminjamController.php";
            $peminjam = new PeminjamController();
            $peminjam->ajukan();
        } else {
            header('Location: index.php?page=login');
            exit;
        }
        break;
    case 'status':
        if (isset($_SESSION['user']) && $_SESSION['user']['level'] === 'Peminjam') {
            require_once "../app/controllers/PeminjamController.php";
            $peminjam = new PeminjamController();
            $peminjam->status();
        } else {
            header('Location: index.php?page=login');
            exit;
        }
        break;
    case 'riwayat':
        if (isset($_SESSION['user']) && $_SESSION['user']['level'] === 'Peminjam') {
            require_once "../app/controllers/PeminjamController.php";
            $peminjam = new PeminjamController();
            $peminjam->riwayat();
        } else {
            header('Location: index.php?page=login');
            exit;
        }
        break;
    case 'laporan':
        if (isset($_SESSION['user']) && $_SESSION['user']['level'] === 'Petugas') {
            require_once "../app/controllers/PetugasController.php";
            $petugas = new PetugasController();
            $petugas->laporan();
        } else {
            header('Location: index.php?page=login');
            exit;
        }
        break;
    case 'pemantauan':
        if (isset($_SESSION['user']) && $_SESSION['user']['level'] === 'Petugas') {
            require_once "../app/controllers/PetugasController.php";
            $petugas = new PetugasController();
            $petugas->pemantauan();
        } else {
            header('Location: index.php?page=login');
            exit;
        }
        break;
    // Tambahkan routing ke Controller lainnya sesuai kebutuhan seperti admin/peminjaman user, dst
    default:
        echo "404 Not Found";
}