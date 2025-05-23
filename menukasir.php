<?php
include 'proseskasir.php';
$produk = getProduk();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Menu Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #e6f0ff;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            position: fixed;
            width: 200px;
            height: 100vh;
            background: #b3d1ff;
            padding: 20px;
            box-sizing: border-box;
        }

        .sidebar h2 {
            margin-top: 0;
        }

        .sidebar a {
            display: block;
            color: black;
            text-decoration: none;
            margin: 10px 0;
            font-weight: bold;
        }

        .main {
            margin-left: 220px;
            padding: 20px;
        }

        h1 {
            color: #0066cc;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #f2f2f2;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background: #cce0ff;
        }

        tr:nth-child(even) {
            background: #e6f0ff;
        }

        img {
            width: 60px;
            height: 60px;
            object-fit: cover;
        }

        .action-buttons a {
            margin-right: 5px;
            padding: 5px 10px;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }

        .edit-btn {
            background: #007bff;
        }

        .delete-btn {
            background: #ff4d4d;
        }

        .summary {
            margin-top: 20px;
            background: #e0e0e0;
            padding: 10px;
            display: inline-block;
            border-radius: 8px;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>ADMIN</h2>
    <a href="#">DASHBOARD</a>
    <a href="#">TAMBAH PRODUK</a>
    <a href="#">KELOLA PESANAN</a>
    <a href="#">LOG-OUT</a>
</div>

<div class="main">
    <h1>DAFTAR PRODUK</h1>
    <table>
        <tr>
            <th>Produk</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($produk as $p): ?>
            <tr>
                <td>
                    <img src="uploads/<?= $p['image_produk'] ?>" alt="Produk">
                    <br>
                    <?= $p['id_produk'] ?> - <?= htmlspecialchars($p['nama_produk']) ?>
                </td>
                <td>Rp <?= number_format($p['harga_produk'], 0, ',', '.') ?></td>
                <td><?= $p['stok'] ?></td>
                <td><?= htmlspecialchars($p['deskripsi_produk']) ?></td>
                <td class="action-buttons">
                    <a class="edit-btn" href="editproduk.php?id=<?= $p['id_produk'] ?>">✏️</a>
                    <a class="delete-btn" href="prosesadmin.php?hapus=<?= $p['id_produk'] ?>" onclick="return confirm('Hapus produk ini?')">🗑️</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <div class="summary">
        Total Produk : <?= count($produk) ?>
    </div>
</div>

</body>
</html>
