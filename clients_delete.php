<?php
require_once 'dbconnect.php';
require_once 'auth.php';
requireAuth();

$id = $_GET['id'] ?? 0;

$stmt = $pdo->prepare("SELECT COUNT(*) FROM wallet WHERE id_client = ?");
$stmt->execute([$id]);
if ($stmt->fetchColumn() > 0) {
    $_SESSION['message'] = 'Невозможно удалить клиента: у него есть счета';
    $_SESSION['message_type'] = 'danger';
    header('Location: clients.php');
    exit;
}

$pdo->prepare("DELETE FROM сlients WHERE id = ?")->execute([$id]);
$_SESSION['message'] = 'Клиент удален';
$_SESSION['message_type'] = 'success';
header('Location: clients.php');
exit;
?>