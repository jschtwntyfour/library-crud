<?php

include 'admin/fungsi.php'; 

if (isset($_GET['aksi']) && $_GET['aksi'] == "pinjam") {
    $id = $_GET['id'];
    $nama = $_GET['peminjam'];
    
    // Panggil fungsi pinjam yang ada di dalam admin/fungsi.php
    pinjam($id, $nama); 
}
?>