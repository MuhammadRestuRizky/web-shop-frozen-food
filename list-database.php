<?php include("konfig.php"); ?>


<!DOCTYPE html>
<html>
<head>
    <title>List | Pembeli</title>
</head>

<body>
<header>
    <h3>Pembeli yang sudah mendaftar Akun</h3>
</header>

<nav>
    <a href="registrasi akun.php">[+] Tambah Baru</a>
</nav>

<br>

<table border="1">
    <thead>
        <tr>
            <th>Id_Pembeli</th>
            <th>username</th>
            <th>No_Telpon</th>
            <th>Password</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $sql = "SELECT * FROM tb_pembeli";
        $query = mysqli_query($db, $sql);

        while($pembeli = mysqli_fetch_array($query)){
            echo "<tr>";

            echo "<td>".$pembeli['id_pembeli']."</td>";
            echo "<td>".$pembeli['username']."</td>";
            echo "<td>".$pembeli['no_telpon']."</td>";
            echo "<td>".$pembeli['password']."</td>";
            echo "</tr>";
        }
        ?>

    </tbody>
    </table>

    <p>Total: <?php echo mysqli_num_rows($query) ?></p>

    </body>
</html>
<!-- pppp -->