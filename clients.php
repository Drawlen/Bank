<?php
require_once 'dbconnect.php';
require_once 'auth.php';
requireAuth();

$clients = $pdo->query("SELECT * FROM сlients ORDER BY id")->fetchAll();
include 'header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="bi bi-people"></i> Клиенты</h1>
    <a href="clients_add.php" class="btn btn-add">
        <i class="bi bi-plus-circle"></i> Добавить клиента
    </a>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>ФИО</th>
                <th>Количество счетов</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clients as $client): 
                $count = $pdo->prepare("SELECT COUNT(*) FROM wallet WHERE id_client = ?");
                $count->execute([$client['id']]);
                $wallets_count = $count->fetchColumn();
            ?>
            <tr>
                <td><?= $client['id'] ?></td>
                <td><?= htmlspecialchars($client['full_name']) ?></td>
                <td><span class="badge badge-custom"><?= $wallets_count ?></span></td>
                <td>
                    <a href="wallets.php?client_id=<?= $client['id'] ?>" class="btn btn-sm btn-action">
                        <i class="bi bi-wallet2"></i> Счета
                    </a>
                    <a href="clients_delete.php?id=<?= $client['id'] ?>" 
                       class="btn btn-sm btn-delete"
                       onclick="return confirm('Удалить клиента?')">
                        <i class="bi bi-trash"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>