<?php
require_once '../app/utils/qris.php';

class QRISHandler {
    public function generateQRCode($qris, $qty, $yn, $id, $fee = null, $tax = null) {
        $result = convertQris($qris, $qty, $yn, $fee, $tax);

        
        require_once '../app/utils/qrcode.php';
        $qr = QRCode::getMinimumQRCode($result, QR_ERROR_CORRECT_LEVEL_L);
        $image = $qr->createImage();

        $folderPath = 'qrcodes/';
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        $imagePath = $folderPath . 'qris_' . $id . '.png';
        imagepng($image, $imagePath);
        imagedestroy($image);

        return $imagePath;
    }
}