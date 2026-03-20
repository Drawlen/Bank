<?php
require_once 'dbconnect.php';
require_once 'auth.php';
requireAuth();

$id = $_GET['id'] ?? 0;
$client_id = $_GET['client_id'] ?? 0;

// Проверка наличия операций
$stmt = $pdo->prepare("
    SELECT 
        (SELECT COUNT(*) FROM prixod_operation WHERE id_wallet = ?) as inc,
        (SELECT COUNT(*) FROM rashod_operation WHERE id_wallet = ?) as exp
");
$stmt->execute([$id, $id]);
$result = $stmt->fetch();

if ($result['inc'] > 0 || $result['exp'] > 0) {
    $_SESSION['message'] = 'Невозможно закрыть счет: есть операции';
    $_SESSION['message_type'] = 'danger';
    header("Location: wallets.php?client_id=$client_id");
    exit;
}

$pdo->prepare("DELETE FROM wallet WHERE id = ?")->execute([$id]);
$_SESSION['message'] = 'Счет закрыт';
$_SESSION['message_type'] = 'success';
header("Location: wallets.php?client_id=$client_id");
exit;
?>