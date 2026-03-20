<?php
require_once 'dbconnect.php';
require_once 'auth.php';
requireAuth();

$client_id = $_GET['client_id'] ?? 0;

$client = $pdo->prepare("SELECT * FROM сlients WHERE id = ?");
$client->execute([$client_id]);
$client = $client->fetch();

if (!$client) {
    header('Location: clients.php');
    exit;
}

$wallets = $pdo->prepare("SELECT * FROM wallet WHERE id_client = ? ORDER BY id");
$wallets->execute([$client_id]);
$wallets = $wallets->fetchAll();

include 'header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1> Счета: <?= htmlspecialchars($client['full_name']) ?> </h1>
    <div>
        <a href="wallets_add.php?client_id=<?= $client_id ?>" class="btn btn-add">
            <i class="bi bi-plus-circle"></i> Новый счет
        </a>
        <a href="clients.php" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Назад
        </a>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Валюта</th>
                <th>Баланс</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($wallets as $wallet): 
                $income = $pdo->prepare("SELECT COALESCE(SUM(total), 0) FROM prixod_operation WHERE id_wallet = ?");
                $income->execute([$wallet['id']]);
                $expense = $pdo->prepare("SELECT COALESCE(SUM(total), 0) FROM rashod_operation WHERE id_wallet = ?");
                $expense->execute([$wallet['id']]);
                $balance = $income->fetchColumn() - $expense->fetchColumn();
            ?>
            <tr>
                <td><?= $wallet['id'] ?></td>
                <td><span class="badge badge-custom"><?= $wallet['wallet_currency'] ?></span></td>
                <td class="<?= $balance >= 0 ? 'amount-pos' : 'amount-neg' ?>">
                    <?= number_format($balance, 2) ?>
                </td>
                <td>
                    <a href="operations.php?wallet_id=<?= $wallet['id'] ?>" class="btn btn-sm btn-action">
                        <i class="bi bi-arrow-left-right"></i> Операции
                    </a>
                    <a href="delete_wallet.php?id=<?= $wallet['id'] ?>&client_id=<?= $client_id ?>" 
                       class="btn btn-sm btn-delete"
                       onclick="return confirm('Закрыть счет?')">
                        <i class="bi bi-trash"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>