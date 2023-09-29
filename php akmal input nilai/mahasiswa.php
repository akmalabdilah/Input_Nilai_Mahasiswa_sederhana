

<!DOCTYPE html>
<html>
<head>
    <title>Program Nilai Data Mahasiswa</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Selamat Datang Mahasiswa</h1>
    <form method="post">
        <input type="submit" name="lihat" value="Lihat Data Mahasiswa"><br><br>
    </form>
    
    <form method="post">
        <input type="text" name="nim_cari" placeholder="Cari Mahasiswa berdasarkan NIM">
        <input type="submit" name="cari" value="Cari">
    </form>


   

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



// Fungsi untuk melihat data mahasiswa dari database
function lihatMahasiswa()
{
    global $conn;
    $sql = "SELECT * FROM mahasiswa";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "Nama: " . $row["nama"] . "<br>";
            echo "NIM: " . $row["nim"] . "<br>";
            echo "Kelas: " . $row["kelas"] . "<br>";
            echo "Jurusan: " . $row["jurusan"] . "<br>";
            echo "Kehadiran: " . $row["kehadiran"] . "<br>";
            echo "Tugas: " . $row["tugas"] . "<br>";
            echo "UTS: " . $row["uts"] . "<br>";
            echo "UAS: " . $row["uas"] . "<br>";
            echo "Nilai Akhir: " . $row["nilai_akhir"] . "<br>";
            echo "--------------------------<br>";
        }
    } else {
        echo "Tidak ada data mahasiswa.";
    }
}




// Fungsi untuk mencari data mahasiswa berdasarkan NIM
function cariMahasiswa($nim)
{
    global $conn;
    $sql = "SELECT * FROM mahasiswa WHERE nim = '$nim'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "Nama: " . $row["nama"] . "<br>";
            echo "NIM: " . $row["nim"] . "<br>";
            echo "Kelas: " . $row["kelas"] . "<br>";
            echo "Jurusan: " . $row["jurusan"] . "<br>";
            echo "Kehadiran: " . $row["kehadiran"] . "<br>";
            echo "Tugas: " . $row["tugas"] . "<br>";
            echo "UTS: " . $row["uts"] . "<br>";
            echo "UAS: " . $row["uas"] . "<br>";
            echo "Nilai Akhir: " . $row["nilai_akhir"] . "<br>";
            echo "--------------------------<br>";
        }
    } else {
        echo "Data mahasiswa dengan NIM $nim tidak ditemukan.";
    }
}

// Kode utama
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Cek tindakan yang dilakukan
    if (isset($_POST["tambah"])) {
        $nama = $_POST["nama"];
        $nim = $_POST["nim"];
        $kelas = $_POST["kelas"];
        $jurusan = $_POST["jurusan"];
        $hadir = $_POST["hadir"];
        $tugas = $_POST["tugas"];
        $uts = $_POST["uts"];
        $uas = $_POST["uas"];
        $akhir = $_POST["akhir"];
        tambahMahasiswa($nama, $nim, $kelas, $jurusan, $hadir, $tugas, $uts, $uas, $akhir);
    } elseif (isset($_POST["lihat"])) {
        lihatMahasiswa();
    } elseif (isset($_POST["ubah"])) {
        $id = $_POST["id"];
        $hadir = $_POST["hadir"];
        $tugas = $_POST["tugas"];
        $uts = $_POST["uts"];
        $uas = $_POST["uas"];
        $akhir = $_POST["akhir"];
        ubahMahasiswa($id, $hadir, $tugas, $uts, $uas, $akhir);
    } elseif (isset($_POST["hapus"])) {
        $id = $_POST["id"];
        hapusMahasiswa($id);
    } elseif (isset($_POST["cari"])) {
        $nimCari = $_POST["nim_cari"];
        cariMahasiswa($nimCari);
    }
}
?>

<div class="menu">
        <a href="index.php">Menu</a>
    </div>
</body>
</html>
