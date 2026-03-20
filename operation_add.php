<?php
require_once 'dbconnect.php';
require_once 'auth.php';
requireAuth();

$wallet_id = $_GET['wallet_id'] ?? 0;
$type = $_GET['type'] ?? 'prixod';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $amount = $_POST['amount'] ?? 0;
    $date = $_POST['date'] ?? date('Y-m-d H:i:s');
    
    if ($amount > 0) {
        $table = $type == 'prixod' ? 'prixod_operation' : 'rashod_operation';
        $pdo->prepare("INSERT INTO $table (id_wallet, total, date_and_time) VALUES (?, ?, ?)")
            ->execute([$wallet_id, $amount, $date]);
        
        $_SESSION['message'] = 'Операция успешно добавлена';
        $_SESSION['message_type'] = 'success';
        header("Location: operations.php?wallet_id=$wallet_id");
        exit;
    }
    else {
    $_SESSION['message'] = 'Сумма должна быть больше нуля!';
    $_SESSION['message_type'] = 'danger';
}
}

include 'header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header <?= $type == 'prixod' ? 'header-inc' : 'header-exp' ?>">
                <h4 class="mb-0">
                    <i class="bi <?= $type == 'prixod' ? 'bi-plus-circle' : 'bi-dash-circle' ?>"></i>
                    <?= $type == 'prixod' ? 'Приходная' : 'Расходная' ?> операция
                </h4>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Сумма</label>
                        <input type="number" step="0.01" name="amount" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Дата и время</label>
                        <input type="datetime-local" name="date" class="form-control" 
                               value="<?= date('Y-m-d\TH:i') ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Сохранить
                    </button>
                    <a href="operations.php?wallet_id=<?= $wallet_id ?>" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Отмена
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>