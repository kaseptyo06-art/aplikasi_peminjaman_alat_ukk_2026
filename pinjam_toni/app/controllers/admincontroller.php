<?php
class AdminController extends Controller
{
    public function users()
    {
        $model = $this->model('User');

        // Handler aksi CRUD
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['aksi'] == 'tambah') {
                $model->add($_POST);
            } elseif ($_POST['aksi'] == 'edit') {
                $model->update($_POST['id'], $_POST);
            }
            header("Location: ?page=users");
            exit;
        }
        if (isset($_GET['delete'])) {
            $model->delete($_GET['delete']);
            header("Location: ?page=users");
            exit;
        }

        // Untuk edit
        $data = ['users' => $model->getAll()];
        if (isset($_GET['edit'])) {
            $data['edit'] = $model->getById($_GET['edit']);
        }
        $this->view('admin/user', $data);
    }

    public function alat()
    {
        $alatModel = $this->model('Alat');
        $kategoriModel = $this->model('Kategori');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $gambarName = '';
            if (!empty($_FILES['gambar']['name'])) {
                $uploadDir = __DIR__ . '/../../public/assets/uploads/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                $ext = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));
                $allowed = ['jpg', 'jpeg', 'png', 'gif'];
                if (in_array($ext, $allowed)) {
                    $gambarName = uniqid('alat_', true) . '.' . $ext;
                    move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadDir . $gambarName);
                }
            }
            if ($_POST['aksi'] == 'tambah') {
                $postData = $_POST;
                $postData['gambar'] = $gambarName;
                $alatModel->add($postData);
            } elseif ($_POST['aksi'] == 'edit') {
                $postData = $_POST;
                if ($gambarName) {
                    $postData['gambar'] = $gambarName;
                } else {
                    $existing = $alatModel->getById($_POST['id']);
                    $postData['gambar'] = $existing['gambar'] ?? '';
                }
                $alatModel->update($_POST['id'], $postData);
            }
            header("Location: ?page=alat");
            exit;
        }
        if (isset($_GET['delete'])) {
            $alatModel->delete($_GET['delete']);
            header("Location: ?page=alat");
            exit;
        }
        $data['alat'] = $alatModel->getAll();
        $data['kategori'] = $kategoriModel->getAll();
        if (isset($_GET['edit'])) {
            $data['edit'] = $alatModel->getById($_GET['edit']);
        }
        $this->view('admin/alat', $data);
    }

    public function kategori()
    {
        $kategoriModel = $this->model('Kategori');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['aksi'] == 'tambah') {
                $kategoriModel->add($_POST);
            } elseif ($_POST['aksi'] == 'edit') {
                $kategoriModel->update($_POST['id'], $_POST);
            }
            header("Location: ?page=kategori");
            exit;
        }
        if (isset($_GET['delete'])) {
            $kategoriModel->delete($_GET['delete']);
            header("Location: ?page=kategori");
            exit;
        }
        $data['kategori'] = $kategoriModel->getAll();
        if (isset($_GET['edit'])) {
            $data['edit'] = $kategoriModel->getById($_GET['edit']);
        }
        $this->view('admin/kategori', $data);
    }
}