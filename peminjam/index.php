<?php 


include 'fungsi_peminjam.php'; 

$buku = tampil();
?>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f4f7f6;
        color: #333;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 40px;
    }

    h2 {
        color: #2c3e50;
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    table {
        width: 100%;
        max-width: 900px;
        border-collapse: collapse;
        background-color: #fff;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden; /* Ensures corners stay rounded */
        border: none;
    }

    th {
        background-color: #3498db;
        color: white;
        text-align: left;
        padding: 15px;
        font-weight: 600;
    }

    td {
        padding: 12px 15px;
        border-bottom: 1px solid #eee;
    }

    tr:hover {
        background-color: #f9f9f9;
    }

    a {
        text-decoration: none;
        background-color: #2ecc71;
        color: white;
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 0.9em;
        transition: background 0.3s ease;
    }

    a:hover {
        background-color: #27ae60;
    }

    .status-unavailable {
        color: #e74c3c;
        font-weight: bold;
        font-style: italic;
    }
</style>
<h2>Daftar Buku Tersedia</h2>
<table border="1" cellpadding="10">
    <tr>
        <th>Judul</th>
        <th>Penulis</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    <?php while($z = mysqli_fetch_assoc($buku)): ?>
    <tr>
        <td><?= $z['judul']; ?></td>
        <td><?= $z['penulis']; ?></td>
        <td><?= $z['status']; ?></td>
        <td>
            <?php if($z['status'] == 'Tersedia'): ?>
                <a href="#" onclick="var nm = prompt('Masukkan Nama Kamu:'); if(nm) { window.location.href='index.php?aksi=pinjam&id=<?= $z['id']; ?>&peminjam=' + nm; }">Pinjam Buku</a>
            <?php else: ?>
                <span style="color:red;">Sedang Dipinjam</span>
            <?php endif; ?>
        </td>
    </tr>
    <?php endwhile; ?>
</table>