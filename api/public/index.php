<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/controllers/LaundryController.php';
require_once __DIR__ . '/../app/controllers/AdminController.php';

$laundryController = new LaundryController($pdo);
$adminController = new AdminController($pdo);

// Ambil URL dari parameter
$url = isset($_GET['url']) ? $_GET['url'] : '';

// Routing sederhana
switch ($url) {
// admin 
    case 'admin/login':
        $adminController->login();
        break;
    case 'admin/authenticate':
        $adminController->authenticate();
        break;
    case 'admin':
    case 'admin/dashboard':
        $adminController->dashboard();
        break;
    case 'admin/logout':
        $adminController->logout();
        break;
    case 'admin/delete':
        $adminController->deleteLaundry();
        break;
    case 'admin/mark-in-progress':
        $adminController->markInProgress();
        break;
    case 'admin/mark-finished':
        $adminController->markFinished();
        break;
    case 'admin/mark-paid':
        $adminController->markPaid();
        break;
    case 'admin/update-biaya':
        $adminController->updateBiaya();
        break;
// user
    case '':
        $laundryController->index();
        break;
    case 'add':
        $laundryController->add();
        break;
    case 'list':
        $laundryController->list();
        break;
    default:
         $laundryController->index();
        break;
}
?>