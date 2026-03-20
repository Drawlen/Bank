<?php
require_once 'dbconnect.php';
require_once 'auth.php';
requireAuth();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = trim($_POST['full_name'] ?? '');
    
    if (!empty($full_name)) {
        $pdo->prepare("INSERT INTO сlients (full_name) VALUES (?)")->execute([$full_name]);
        $_SESSION['message'] = 'Клиент успешно добавлен';
        $_SESSION['message_type'] = 'success';
        header('Location: clients.php');
        exit;
    }
}

include 'header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header card-header-main">
                <h4 class="mb-0"><i class="bi bi-person-plus"></i> Новый клиент</h4>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Введите ФИО нового клиента</label>
                        <input type="text" name="full_name" class="form-control" required minlength = 10>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Сохранить
                    </button>
                    <a href="clients.php" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Отмена
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>