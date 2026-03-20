<?php
require_once 'dbconnect.php';
require_once 'auth.php';
requireAuth();

$wallet_id = $_GET['wallet_id'] ?? 0;

$wallet = $pdo->prepare("
    SELECT w.*, c.full_name as client_name 
    FROM wallet w
    JOIN сlients c ON w.id_client = c.id
    WHERE w.id = ?
");
$wallet->execute([$wallet_id]);
$wallet = $wallet->fetch();

if (!$wallet) {
    header('Location: clients.php');
    exit;
}

$operations = $pdo->prepare("
    (SELECT 'prixod' as type, id, total, date_and_time FROM prixod_operation WHERE id_wallet = ?)
    UNION ALL
    (SELECT 'rashod' as type, id, total, date_and_time FROM rashod_operation WHERE id_wallet = ?)
    ORDER BY date_and_time DESC
");
$operations->execute([$wallet_id, $wallet_id]);
$operations = $operations->fetchAll();

include 'header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1>
            <i class="bi bi-arrow-left-right"></i> 
            Счет #<?= $wallet['id'] ?> (<?= $wallet['wallet_currency'] ?>)
        </h1>
        <p class="text-muted"><?= htmlspecialchars($wallet['client_name']) ?></p>
    </div>
    <div>
        <a href="operation_add.php?wallet_id=<?= $wallet_id ?>&type=prixod" class="btn btn-add">
            <i class="bi bi-plus-circle"></i> Приход
        </a>
        <a href="operation_add.php?wallet_id=<?= $wallet_id ?>&type=rashod" class="btn btn-delete">
            <i class="bi bi-plus-circle"></i> Расход
        </a>
        <a href="wallets.php?client_id=<?= $wallet['id_client'] ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Назад
        </a>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Дата и время</th>
                <th>Тип</th>
                <th>Сумма</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($operations as $op): ?>
            <tr>
                <td><?= date('d.m.Y H:i', strtotime($op['date_and_time'])) ?></td>
                <td>
                    <?php if ($op['type'] == 'prixod'): ?>
                        <span class="badge bg-success">Приход</span>
                    <?php else: ?>
                        <span class="badge bg-danger">Расход</span>
                    <?php endif; ?>
                </td>
                <td class="<?= $op['type'] == 'prixod' ? 'amount-pos' : 'amount-neg' ?>">
                    <?= $op['type'] == 'prixod' ? '+' : '-' ?><?= number_format($op['total'], 2) ?>
                </td>
                <td>
                    <a href="delete_operation.php?type=<?= $op['type'] ?>&id=<?= $op['id'] ?>&wallet_id=<?= $wallet_id ?>" 
                       class="btn btn-sm btn-delete"
                       onclick="return confirm('Удалить операцию?')">
                        <i class="bi bi-trash"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
            
            <?php if (empty($operations)): ?>
            <tr>
                <td colspan="4" class="text-center text-muted py-4">
                    <i class="bi bi-info-circle"></i> Нет операций по счету
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>