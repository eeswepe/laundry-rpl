<?php
class Laundry {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function addLaundry($nama, $owner, $alamat, $layanan, $rincian_pesanan, $payment_method, $pengantaran) {
        $stmt = $this->pdo->prepare("INSERT INTO orders (nama, nomor_hp, alamat, jenis, paket, layanan, rincian_pesanan, pengantaran, metode_pembayaran, status, is_paid, biaya) VALUES (:nama, :nomor_hp, :alamat, :jenis, :paket, :layanan, :rincian_pesanan, :pengantaran, :payment_method, 'Belum Diproses', 0, 0)");
        $stmt->execute([
            ':nama' => $nama,
            ':nomor_hp' => $owner,
            ':alamat' => $alamat,
            ':jenis' => $_POST['jenis'],
            ':paket' => $_POST['paket'],
            ':layanan' => $layanan,
            ':rincian_pesanan' => $rincian_pesanan,
            ':pengantaran' => $pengantaran,
            ':payment_method' => $payment_method
        ]);
    }

    public function getAllLaundry($limit, $offset) {
        $stmt = $this->pdo->prepare("SELECT * FROM orders ORDER BY order_date DESC LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLaundryById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM orders WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? [$result] : [];
    }

    public function getTotalLaundry() {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM orders");
        return $stmt->fetchColumn();
    }

    public function deleteLaundry($id) {
        $stmt = $this->pdo->prepare("DELETE FROM orders WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $filePath = 'qrcodes/qris_' . $id . '.png';
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    public function updateLaundryStatus($id, $status) {
        $stmt = $this->pdo->prepare("UPDATE orders SET status = :status WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function updateLaundryIsPaid($id) {
        $stmt = $this->pdo->prepare("UPDATE orders SET is_paid = 1 WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function updateBiayaLaundry($id, $biaya) {
        $stmt = $this->pdo->prepare("UPDATE orders SET biaya = :biaya WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':biaya', $biaya, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function getNotProcessedLaundryCount(){
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM orders WHERE status = 'Belum Diproses'");
        return $stmt->fetchColumn();
    }

    public function getInProgressLaundryCount(){
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM orders WHERE status = 'Sedang Diproses'");
        return $stmt->fetchColumn();
    }

    public function getFinishedLaundryCount(){
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM orders WHERE status = 'Selesai'");
        return $stmt->fetchColumn();
    }

    public function getUnpaidLaundryCount(){
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM orders WHERE is_paid = 0");
        return $stmt->fetchColumn();
    }

    public function getLaundryByStatus($status) {
        $stmt = $this->pdo->prepare("SELECT * FROM orders WHERE status = :status");
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>