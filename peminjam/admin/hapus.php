<?php
include 'fungsi.php';

// Ambil ID dari URL
$id = cek_data("id");

if($id != 0){
    // Langsung panggil fungsi hapus yang ada di fungsi.php
    hapus($id); 
    echo "<script>
            alert('Data buku telah dihapus!');
            location.href='index.php';
        </script>";
} else {
    header("Location: index.php");
}
?>