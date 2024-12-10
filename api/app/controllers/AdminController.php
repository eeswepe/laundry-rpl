<?php
session_start();

require_once dirname(__DIR__, 2) . '/app/models/Laundry.php';
require_once dirname(__DIR__, 2) . '/app/utils/QRIS_handler.php';

class AdminController {
    private $laundryModel;

    public function __construct($pdo) {
        $this->laundryModel = new Laundry($pdo);
    }

    public function login() {
        require dirname(__DIR__, 2) . '/app/views/admin/login.php';
    }

    public function authenticate() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            // Ganti dengan username dan password yang sesuai
            if ($username === 'alivia' && $password === 'alivia') {
                $_SESSION['admin_logged_in'] = true;
                header('Location: /laundry-app/admin/dashboard');
                exit();
            } else {
                $error = "Username atau password salah!";
                require dirname(__DIR__, 2) . '/app/views/admin/login.php';
            }
        }
    }

    public function dashboard() {
        require dirname(__DIR__, 2) . '/app/views/admin/dashboard.php';
        if (!isset($_SESSION['admin_logged_in'])) {
            header('Location: /laundry-app/admin/login');
            exit();
        }

        $notProcessedLaundryCount = $this->laundryModel->getNotProcessedLaundryCount();
        $inProgressLaundryCount = $this->laundryModel->getInProgressLaundryCount();
        $finishedLaundryCount = $this->laundryModel->getFinishedLaundryCount();
        $unpaidLaundryCount = $this->laundryModel->getUnpaidLaundryCount();

        $statusFilter = isset($_GET['status']) ? $_GET['status'] : '';
        
        $searchId = isset($_GET['search_id']) ? $_GET['search_id'] : '';

        $limit = 10;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($page -1) * $limit;
        $totalLaundry = $this->laundryModel->getTotalLaundry();
        $totalPages = ceil($totalLaundry / $limit);

        if ($searchId) {
            $laundries = $this->laundryModel->getLaundryById($searchId);
        } else if ($statusFilter) {
            $laundries = $this->laundryModel->getLaundryByStatus($statusFilter, $limit, $offset);
        } else {
            $laundries = $this->laundryModel->getAllLaundry($limit, $offset);
        }

        require dirname(__DIR__, 2) . '/app/views/admin/dashboard.php';
    }

    public function logout() {
        session_destroy();
        header('Location: /laundry-app/admin/login');
        exit();
    }

    public function deleteLaundry(){
        if(!isset($_SESSION['admin_logged_in'])) {
            header('Location: /laundry-app/admin/login');
            exit();
        }
        if(isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            $this->laundryModel->deleteLaundry($id);
        }
        header('Location: /laundry-app/admin/dashboard');
        exit();
    }

    public function markInProgress(){
        if(!isset($_SESSION['admin_logged_in'])) {
            header('Location: /laundry-app/admin/login');
            exit();
        }
        if(isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            $this->laundryModel->updateLaundryStatus($id, 'Sedang Diproses');
        }
        header('Location: /laundry-app/admin/dashboard');
        exit();
    }   

    public function markFinished(){
        if(!isset($_SESSION['admin_logged_in'])) {
            header('Location: /laundry-app/admin/login');
            exit();
        }
        if(isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            $this->laundryModel->updateLaundryStatus($id, 'Selesai');
        }
        header('Location: /laundry-app/admin/dashboard');
        exit();
    }

    public function markPaid(){
        if(!isset($_SESSION['admin_logged_in'])) {
            header('Location: /laundry-app/admin/login');
            exit();
        }
        if(isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            $this->laundryModel->updateLaundryIsPaid($id);
        }
        header('Location: /laundry-app/admin/dashboard');
        exit();
    }

    public function updateBiaya(){
        if(!isset($_SESSION['admin_logged_in'])) {
            header('Location: /laundry-app/admin/login');
            exit();
        }
        if(isset($_GET['id']) && isset($_GET['biaya'])) {
            $id = (int)$_GET['id'];
            $biaya = (int)$_GET['biaya'];
            $qris = "00020101021126580013ID.CO.BRI.WWW01189360000200403006940208403006940303UMI51440014ID.CO.QRIS.WWW0215ID10232565053150303UMI5204549953033605802ID5913ALIVA LAUNDRY6006MALANG61056514262070703A01630423D5";
            $nominal = $biaya;
            $admin = 'n';

            
            $qrisHandler = new QRISHandler();
            $imagePath = $qrisHandler->generateQRCode($qris, $nominal, $admin, $id);
            $this->laundryModel->updateBiayaLaundry($id, $biaya);
        }
        header('Location: /laundry-app/admin/dashboard');
        exit();
    }

}

