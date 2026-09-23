<?php
require_once "config/database.php";

$name = "Administrator";
$email = "admin@gmail.com";
$password = "admin123";

// Enkripsi password agar bisa dibaca oleh password_verify di halaman login
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO admins (name, email, password) VALUES (:name, :email, :password)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
 "name" => $name,
 "email" => $email,
 "password" => $passwordHash
]);

echo "Akun admin berhasil dibuat!<br>";
echo "Email: <b>$email</b><br>";
echo "Password: <b>$password</b><br>";
echo "<br><a href='auth/login.php'>Klik di sini untuk login</a>";
?>