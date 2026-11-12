<?php 
include 'fungsi.php';

// Logika Tambah Buku
if(isset($_GET['dor'])){
    tambah($_GET['buku'], $_GET['penulis']);
    header("Location: index.php");
}

// Logika Pinjam (Dinamis)
if(isset($_GET['aksi']) && $_GET['aksi'] == 'pinjam'){
    
    header("Location: index.php");
}

// Logika Kembali (Dinamis)
if(isset($_GET['aksi']) && $_GET['aksi'] == 'kembali'){
    kembaliBuku($_GET['id']);
    header("Location: index.php");
}
?>
<html>
<head>
    <title>Sistem Perpustakaan</title>
    <style>
        :root {
            --primary: #2c3e50;
            --accent: #3498db;
            --success: #27ae60;
            --danger: #e74c3c;
            --warning: #f39c12;
            --light: #ecf0f1;
            --dark: #2c3e50;
        }

        body {
            font-family: 'Inter', -apple-system, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
            color: var(--dark);
        }

        h1 {
            text-align: center;
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 30px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        form {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            max-width: 900px;
            margin: 0 auto 20px auto;
            display: flex;
            gap: 15px;
            align-items: flex-end;
            flex-wrap: wrap;
        }

        form label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 5px;
            color: #666;
        }

        input[type="text"] {
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            flex: 1;
            min-width: 200px;
        }

        input[type="submit"], button {
            cursor: pointer;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        input[type="submit"] {
            background-color: var(--accent);
            color: white;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }

        button {
            background-color: #bdc3c7;
            color: var(--dark);
        }

        /* Table Styling */
        table {
            width: 100%;
            max-width: 1000px;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }

        th {
            background-color: var(--primary);
            color: white;
            text-align: left;
            padding: 15px;
            font-size: 0.9rem;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #f1f1f1;
            font-size: 0.95rem;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover {
            background-color: #fcfcfc;
        }

        /* Action Links */
        a {
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 5px 10px;
            border-radius: 4px;
        }

        /* Pinjam Button */
        tr td:nth-child(6) a {
            color: var(--accent);
            border: 1px solid var(--accent);
        }
        tr td:nth-child(6) a:hover {
            background: var(--accent);
            color: white;
        }

        /* Hapus Link */
        tr td:nth-child(7) a {
            color: var(--danger);
        }

        /* Rubah Link */
        tr td:nth-child(8) a {
            color: var(--warning);
        }

        .btn-clear {
            display: block;
            text-align: center;
            margin-bottom: 20px;
        }

        hr {
            border: 0;
            height: 1px;
            background: #ddd;
            margin: 30px 0;
        }
    </style>
</head>
<body>
    <h1>DAFTAR BUKU PERPUSTAKAAN</h1>
    
    <form action="" method="get">
        <label>Judul Buku:</label>
        <input type="text" name="buku" required>
        <label>Penulis:</label>
        <input type="text" name="penulis" required>
        <input type="submit" name="dor" value="Tambah Buku">
    </form>

    <a href="index.php"><button>Bersihkan</button></a>
    <hr>

    <table border="1" cellpadding="10" cellspacing="0">  
        <tr>
            <th>No</th>
            <th>Judul Buku</th>
            <th>Penulis</th>
            <th>Status</th>
            <th>Peminjam</th>
            <th colspan="3">Aksi</th>
        </tr>
        <?php
        $num = 1;
        foreach(tampil() as $z){
        ?>
            <tr>
                <td><?= $num; ?></td>
                <td><?= $z['judul']; ?></td>
                <td><?= $z['penulis']; ?></td>
                <td style="color: <?= ($z['status'] == 'Tersedia') ? 'green' : 'red'; ?>;">
                    <?= $z['status']; ?>
                </td>
                <td><?= $z['peminjam']; ?></td>
                
                <td>
    <?php if($z['status'] == 'Tersedia'): ?>
        <a href="#" onclick="var nm = prompt('Masukkan Nama Peminjam:'); if(nm) { window.location.href='index.php?aksi=pinjam&id=<?= $z['id']; ?>&peminjam=' + nm; }">Pinjam</a>
    <?php else: ?>
        <a href="index.php?aksi=kembali&id=<?= $z['id']; ?>" style="color:red;" onclick="return confirm('Kembalikan buku ini?')">Kembalikan</a>
    <?php endif; ?>
</td>

                <td><a href="hapus.php?id=<?= $z['id']; ?>" onclick="return confirm('Yakin hapus?')">Hapus</a></td>
                <td><a href="rubah.php?id=<?= $z['id']; ?>">Rubah</a></td>
            </tr>
        <?php
        $num++;
        } 
        ?>  
    </table>
</body>
</html>