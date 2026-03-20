<?php
require_once 'dbconnect.php';
require_once 'auth.php';
requireAuth();

$client_id = $_GET['client_id'] ?? 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $currency = $_POST['currency'] ?? '';
    
    if (!empty($currency)) {
        $pdo->prepare("INSERT INTO wallet (id_client, wallet_currency) VALUES (?, ?)")
            ->execute([$client_id, $currency]);
        $_SESSION['message'] = 'Счет успешно открыт';
        $_SESSION['message_type'] = 'success';
        header("Location: wallets.php?client_id=$client_id");
        exit;
    }
}

include 'header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header card-header-main">
                <h4 class="mb-0"><i class="bi bi-plus-circle"></i> Открытие счета</h4>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Валюта</label>
                        <select name="currency" class="form-select" required>
                            <option value="">Выберите валюту</option>
                            <option value="RUB">RUB</option>
                            <option value="USD">USD</option>
                            <option value="EUR">EUR</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Открыть
                    </button>
                    <a href="wallets.php?client_id=<?= $client_id ?>" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Отмена
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>