<?php
// 1. Fungsi koneksi
function db(){
    $koneksi = mysqli_connect("localhost", "root", "", "library"); 
    if($koneksi->connect_errno){
        return $koneksi->connect_error;
    } else {
        return $koneksi;
    }
}

function cek_data($data){
    if(isset($_GET[$data])){
        return ($_GET[$data] == NULL) ? 0 : $_GET[$data];
    }
    return 0;
}

// 2. Fungsi Tambah Buku (Statis)
function tambah($judul, $penulis){
    $db = db(); 
    $query = "INSERT INTO book (judul, penulis, status, peminjam) VALUES ('$judul', '$penulis', 'Tersedia', '-')";
    mysqli_query($db, $query);
    echo "<script>alert('Buku Berhasil Ditambah!'); window.location.href='index.php';</script>";
}

function tampil(){
    $query = "SELECT * FROM book";
    $data = mysqli_query(db(), $query);
    return $data;
}

// 3. Fungsi Pinjam (Dinamis + Anti-Double)
function pinjam($id, $nama){
    $db = db();
    $cek = mysqli_query($db, "SELECT status FROM book WHERE id = '$id'");
    $r = mysqli_fetch_assoc($cek);

    if ($r['status'] == 'Dipinjam') {
        echo "<script>alert('GAGAL! Buku ini lagi dipinjam orang.'); location.href='index.php';</script>";
    } else {
        mysqli_query($db, "UPDATE book SET status='Dipinjam', peminjam='$nama' WHERE id='$id'");
        echo "<script>alert('Berhasil dipinjam oleh $nama'); location.href='index.php';</script>";
    }
}

function hapus($id){
    $db = db();
    mysqli_query($db, "DELETE FROM book WHERE id = '$id'");
    header("Location: index.php");
}

// 4. Fungsi Kembali (Reset nama peminjam)
function kembali($id){
    $db = db();
    $query = "UPDATE book SET status = 'Tersedia', peminjam = '-' WHERE id = '$id'";
    mysqli_query($db, $query);
    echo "<script>alert('Buku telah dikembalikan!'); location.href='index.php';</script>";
}

// 5. Fungsi Rubah (Reset nama jika status manual jadi Tersedia)
function rubah($id, $judul, $penulis, $status){
    $db = db();
    if ($status == "Tersedia") {
        $query = "UPDATE book SET judul='$judul', penulis='$penulis', status='$status', peminjam='-' WHERE id='$id'";
    } else {
        $query = "UPDATE book SET judul='$judul', penulis='$penulis', status='$status' WHERE id='$id'";
    }
    mysqli_query($db, $query);
    echo "<script>alert('Data Berhasil Dirubah!'); location.href = 'index.php';</script>";
}




// Aksi: Rubah
if(cek_data("dor") == "rubah"){
    rubah(cek_data("id"), cek_data("judul"), cek_data("penulis"), cek_data("status"));
}

// Aksi: Tambah (Pastikan name tombol di form tambah adalah 'dor' dan value 'Tambah')
if(cek_data("dor") == "Tambah"){
    tambah(cek_data("judul"), cek_data("penulis"));
}

// Aksi: Pinjam (Menangkap kiriman dari prompt index.php)
if(cek_data("aksi") == "pinjam"){
    pinjam(cek_data("id"), cek_data("peminjam"));
}

// Aksi: Kembali
if(cek_data("aksi") == "kembali"){
    kembali(cek_data("id"));
}


// Penangkap Aksi Kembali (Supaya web tidak blank saat klik Kembali)
if (cek_data("aksi") == "kembali") {
    kembali(cek_data("id"));
}

// Penangkap Aksi Pinjam (Supaya web tidak blank saat klik Pinjam)
if (cek_data("aksi") == "pinjam") {
    pinjam(cek_data("id"), cek_data("peminjam"));
}
?>