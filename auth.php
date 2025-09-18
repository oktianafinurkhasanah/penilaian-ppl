<?php
function checkAccess($roles = []) {
    if (!isset($_SESSION['role'])) {
        header("Location: ../login/login.php");
        exit;
    }

    if (!in_array($_SESSION['role'], $roles)) {
        die("<h3>Akses ditolak 🚫</h3>");
    }
}
