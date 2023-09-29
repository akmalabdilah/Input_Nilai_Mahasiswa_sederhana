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

// Fungsi untuk mengubah data mahasiswa di database
function ubahMahasiswa($id, $hadir, $tugas, $uts, $uas, $akhir)
{
    global $conn;
    $sql = "UPDATE mahasiswa SET kehadiran = $hadir, tugas = $tugas, uts = $uts, uas = $uas, nilai_akhir = $akhir WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        echo "Data mahasiswa berhasil diubah.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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

<!DOCTYPE html>
<html>
<head>
    <title>Program Nilai Data Mahasiswa</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Selamat Datang Dosen Terhormat</h1>

    <h2>Ubah Data Mahasiswa</h2>
    <form method="post">
        ID: <input type="text" name="id"><br>
        Kehadiran: <input type="text" name="hadir"><br>
        Tugas: <input type="text" name="tugas"><br>
        UTS: <input type="text" name="uts"><br>
        UAS: <input type="text" name="uas"><br>
        Nilai Akhir: <input type="text" name="akhir"><br>
        <input type="submit" name="ubah" value="Ubah Data">
    </form>

   
    <div class="menu">
        <a href="admin.php">Menu Dosen</a>
    </div>
</body>
</html>
