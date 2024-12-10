<?php
require_once '../config/database.php';
require_once '../app/models/Laundry.php';

class LaundryController {
    private $laundryModel;

    public function __construct($pdo) {
        $this->laundryModel = new Laundry($pdo);
    }

    public function index() {
        require '../app/views/index.php';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = $_POST['nama'];
            $nomor_hp = '62' . substr($_POST['nomor_hp'], 1);
            $alamat = $_POST['alamat'];
            $layanan = $_POST['layanan'];
            $rincian_pesanan = $_POST['rincian_pesanan'];
            $payment_method = $_POST['metode_pembayaran'];
            $pengantaran = $_POST['pengantaran']; 
            $this->laundryModel->addLaundry($nama, $nomor_hp, $alamat, $layanan, $rincian_pesanan, $payment_method, $pengantaran);
            header("Location: /laundry-app/list");
            exit();
        }
        require '../app/views/add.php';
    }

    public function list() {
        $searchId = isset($_GET['search_id']) ? $_GET['search_id'] : '';

        $limit = 20;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($page -1) * $limit;

        $totalLaundry = $this->laundryModel->getTotalLaundry();
        $totalPages = ceil($totalLaundry / $limit);

        if ($searchId) {
            $laundries = $this->laundryModel->getLaundryById($searchId);
        } else {
            $laundries = $this->laundryModel->getAllLaundry($limit, $offset);
        }

        require '../app/views/list.php';
    }
}
?>