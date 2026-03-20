<?php
require_once 'dbconnect.php';
require_once 'auth.php';
requireAuth();

$type = $_GET['type'] ?? '';
$id = $_GET['id'] ?? 0;
$wallet_id = $_GET['wallet_id'] ?? 0;

$table = $type == 'prixod' ? 'prixod_operation' : 'rashod_operation';
$pdo->prepare("DELETE FROM $table WHERE id = ?")->execute([$id]);

$_SESSION['message'] = 'Операция удалена';
$_SESSION['message_type'] = 'success';
header("Location: operations.php?wallet_id=$wallet_id");
exit;
?>