<?php
// Koneksi ke database MySQL
$servername = "localhost"; // Ganti dengan alamat server MySQL Anda
$username = "root"; // Ganti dengan username MySQL Anda
$password = ""; // Ganti dengan password MySQL Anda
$database = "akma_data_mahasiswa"; // Ganti dengan nama database Anda

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Code for registration
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert the user data into the 'pengguna' table
    $sql = "INSERT INTO pengguna (username, password) VALUES ('$username', '$hashedPassword')";
    if (mysqli_query($conn, $sql)) {
        echo "Registrasi berhasil. Silakan login.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrasi</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Registrasi</h2>
    <form method="post">
        Username: <input type="text" name="username"><br>
        Password: <input type="password" name="password"><br>
        <input type="submit" name="register" value="Daftar">
    </form>

    <div class="menu">
        <a href="index.php">Menu</a>
    </div>
</body>
</html>
