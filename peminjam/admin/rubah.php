<?php
include 'fungsi.php'; 

// 1. Mengambil ID buku dari URL
$id = cek_data("id");

// 2. Ganti 'buku' menjadi 'book' sesuai nama tabel di DB library
$query = "SELECT * FROM book WHERE id = '$id'";
$data = mysqli_query(db(), $query);
$buku = mysqli_fetch_assoc($data);

if (!$buku) {
    header("Location: index.php");
    exit;
}
?>
<html>
<head>
    <title>Update Data Buku</title>
     <style>
        :root {
            --primary: #2c3e50;
            --accent: #3498db;
            --success: #2ecc71;
            --bg: #f4f7f6;
            --text: #333;
        }

        body {
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: var(--bg);
            color: var(--text);
            /* Fixed: Stack elements vertically */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        h1 {
            font-size: 1.8rem;
            color: var(--primary);
            margin-bottom: 20px;
            text-align: center;
            width: 100%;
        }

        form {
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 0.9rem;
            color: #555;
        }

        input[type="text"], 
        select {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus, 
        select:focus {
            outline: none;
            border-color: var(--accent);
        }

        /* Grouping button and link on one line */
        .btn-container {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-top: 10px;
        }

        input[type="submit"] {
            background-color: var(--success);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #27ae60;
        }

        a {
            text-decoration: none;
            color: #7f8c8d;
            font-size: 0.9rem;
        }

        a:hover {
            color: var(--primary);
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Update Data Buku</h1>
    <form action="fungsi.php" method="get">
    <input type="hidden" name="id" value="<?= $buku['id']; ?>">

    <label>Judul Buku:</label><br>
    <input type="text" name="judul" value="<?= $buku['judul']; ?>" required>
    <br><br>

    <label>Penulis:</label><br>
    <input type="text" name="penulis" value="<?= $buku['penulis']; ?>" required>
    <br><br>

    <label>Status Buku:</label><br>
    <select name="status">
        <option value="Tersedia" <?= ($buku['status'] == 'Tersedia') ? 'selected' : ''; ?>>Tersedia</option>
        <option value="Dipinjam" <?= ($buku['status'] == 'Dipinjam') ? 'selected' : ''; ?>>Dipinjam</option>
    </select>
    <br><br>

    <input type="submit" name="dor" value="rubah">
    <a href="index.php">Batal</a>
</form>
</body>
</html>