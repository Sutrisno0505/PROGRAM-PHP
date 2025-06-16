<?php
include "koneksi23b.php";
$nim          = $_POST['nim'];
$nama         = $_POST['nama'];
$matakul      = $_POST['matakul'];
$kodemk       = $_POST['kodemk'];
$nilai        = $_POST['nilai'];
$sql_cek_mhs = "SELECT * FROM mahasiswa WHERE nim = ?";
$stmt = $conn->prepare($sql_cek_mhs);
$stmt->bind_param("s", $nim);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0) {
    $sql_mhs = "INSERT INTO siswa (nis,nama) VALUES (?, ?)";
    $stmt_mhs = $conn->prepare($sql_mhs);
    $stmt_mhs->bind_param("ss",$nis, $nama);
    $stmt_mhs->execute();
}
// Simpan mata kuliah jika belum ada
$sql_cek_matkul = "SELECT * FROM mapel WHERE kodemp = ?";
$stmt = $conn->prepare($sql_cek_matkul);
$stmt->bind_param("s", $kodemp);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0) {
    $sql_matkul = "INSERT INTO mapel (matapel, kodemp) VALUES (?, ?)";
    $stmt_matkul = $conn->prepare($sql_matkul);
    $stmt_matkul->bind_param("ss", $kodemp, $matapel);
    $stmt_matkul->execute();
}

// Simpan nilai
$sql_nilai = "INSERT INTO nilai (nis, kodemp, nilai) VALUES (?, ?, ?)";
$stmt_nilai = $conn->prepare($sql_nilai);
$stmt_nilai->bind_param("ssd", $nis, $kodemp, $nilai);
$stmt_nilai->execute();

echo "Data berhasil disimpan!";
?>



