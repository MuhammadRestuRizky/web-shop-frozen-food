<?php
session_start();
include 'koneksi.php'; // Pastikan file koneksi.php berisi koneksi ke database

// Ambil isi keranjang dari session
$keranjang = isset($_SESSION['keranjang']) ? $_SESSION['keranjang'] : [];

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: center; }
        th { background-color: #f4f4f4; }
        .btn { padding: 8px 12px; background-color: #28a745; color: white; border: none; cursor: pointer; }
        .btn:hover { background-color: #218838; }
    </style>
</head>
<body>

<h2>Keranjang Belanja</h2>

<?php if (!empty($keranjang)): ?>
    <form action="proses_keranjang.php" method="post">
        <table>
            <tr>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
            <?php
            $total = 0;
            foreach ($keranjang as $id_produk => $jumlah):
                // Ambil data produk dari database
                $stmt = $pdo->prepare("SELECT nama_produk, harga FROM tb_produk WHERE id_produk = ?");
                $stmt->execute([$id_produk]);
                $produk = $stmt->fetch();

                $subtotal = $produk['harga'] * $jumlah;
                $total += $subtotal;
            ?>
                <tr>
                    <td><?= htmlspecialchars($produk['nama_produk']) ?></td>
                    <td>Rp <?= number_format($produk['harga'], 0, ',', '.') ?></td>
                    <td>
                        <input type="number" name="jumlah[<?= $id_produk ?>]" value="<?= $jumlah ?>" min="1" required>
                    </td>
                    <td>Rp <?= number_format($subtotal, 0, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <th colspan="3">Total</th>
                <th>Rp <?= number_format($total, 0, ',', '.') ?></th>
            </tr>
        </table>
        <br>
        <button type="submit" class="btn">Perbarui Keranjang</button>
        <a href="checkout.php" class="btn">Checkout</a>
    </form>
<?php else: ?>
    <p>Keranjang belanja kosong.</p>
<?php endif; ?>

</body>
</html>
