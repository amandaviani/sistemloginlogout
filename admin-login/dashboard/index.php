<?php
session_start();
require_once "../config/database.php";

// Cek apakah admin sudah login atau belum
if (!isset($_SESSION["admin_id"])) {
 header("Location: ../auth/login.php");
 exit;
}

$adminName = $_SESSION["admin_name"];
$adminEmail = $_SESSION["admin_email"];
$adminId = $_SESSION["admin_id"];

// Mengambil jumlah total admin dari database untuk ditampilkan di kartu statistik
try {
 $stmtCount = $pdo->query("SELECT COUNT(*) as total FROM admins");
 $totalAdmins = $stmtCount->fetch()['total'];
} catch (PDOException $e) {
 $totalAdmins = 1;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Admin</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="dashboard-container">
 <!-- Navbar -->
 <nav class="navbar">
  <h2>⚡ Admin Panel</h2>
  <div class="nav-right">
   <span class="welcome-text">Halo, <b><?= htmlspecialchars($adminName) ?></b></span>
   <a href="../auth/logout.php" class="btn-logout">Logout</a>
  </div>
 </nav>

 <!-- Main Content -->
 <main class="dashboard-content">
  <!-- Welcome Banner Card -->
  <div class="dashboard-card welcome-banner">
   <div class="banner-text">
    <h1>Selamat Datang Kembali, <?= htmlspecialchars($adminName) ?>! 🙋‍♂️🙋‍♀️</h1>
    <p>Anda berhasil masuk ke dalam sistem administrator. Kelola data dan pantau aktivitas sistem melalui panel kontrol ini.</p>
   </div>
   <div class="banner-badge">Status: Online </div>
  </div>

  <!-- Statistik Grid -->
  <div class="stats-grid">
   <div class="stat-card">
    <div class="stat-icon">⭐</div>
    <div class="stat-info">
     <h3>Total Admin</h3>
     <p class="stat-value"><?= $totalAdmins ?> Akun</p>
    </div>
   </div>
   <div class="stat-card">
    <div class="stat-icon">🔐</div>
    <div class="stat-info">
     <h3>Hak Akses</h3>
     <p class="stat-value">Super Admin</p>
    </div>
   </div>
   <div class="stat-card">
    <div class="stat-icon">👤</div>
    <div class="stat-info">
     <h3>Email Aktif</h3>
     <p class="stat-value-email"><?= htmlspecialchars($adminEmail) ?></p>
    </div>
   </div>
  </div>

  <!-- Informasi Sesi / Panel Tambahan -->
  <div class="dashboard-card info-section">
   <h2>Informasi Sesi Login</h2>
   <table class="info-table">
    <tr>
     <td>ID Admin</td>
     <td>: #<?= htmlspecialchars($adminId) ?></td>
    </tr>
    <tr>
     <td>Waktu Sesi</td>
     <td>: Aktif (Aman dengan Regenerate Session ID)</td>
    </tr>
    <tr>
     <td>Keamanan</td>
     <td>: Enkripsi Password Terverifikasi (Bcrypt)</td>
    </tr>
   </table>
  </div>
 </main>
</div>
</body>
</html>