<?php
class AuthController extends Controller {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $user = $this->model('User')->login($username, $password);
            if ($user) {
                $user['level'] = ucfirst(strtolower(trim($user['level'])));
                $_SESSION['user'] = $user;
                // Redirect ke halaman dashboard sesuai level
                switch (strtolower($user['level'])) {
                    case 'admin':
                        header('Location: ' . BASEURL . '/index.php?page=users');
                        break;
                    case 'petugas':
                    case 'peminjam':
                        header('Location: ' . BASEURL . '/index.php?page=peminjaman');
                        break;
                    default:
                        header('Location: ' . BASEURL . '/index.php?page=login');
                        break;
                }
                exit;
            } else {
                $error = "Username/Password salah!";
                $this->view('auth/login', ['error' => $error]);
            }
        } else {
            $this->view('auth/login');
        }
    }

    public function logout() {
        unset($_SESSION['user']);
        session_destroy();
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');
        header('Location: ' . BASEURL . '/index.php?page=login');
        exit;
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama_lengkap = $_POST['nama_lengkap'];
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $level = $_POST['level'];

            $userModel = $this->model('User');
            if ($userModel->register($nama_lengkap, $username, $password, $level)) {
                header('Location: ' . BASEURL . '/index.php?page=login');
                exit;
            } else {
                $error = "Gagal mendaftar, username mungkin sudah ada!";
                $this->view('auth/register', ['error' => $error]);
            }
        } else {
            $this->view('auth/register');
        }
    }
}