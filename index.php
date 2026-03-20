<?php
require_once 'dbconnect.php';
require_once 'auth.php';

if (isAuthenticated()) {
    header('Location: clients.php');
} else {
    header('Location: login.php');
}
exit;
?>