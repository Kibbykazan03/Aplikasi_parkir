<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    session_start();
    include "../config/koneksi.php";

    /* proteksi login */
    if (!isset($_SESSION['role'])) {
        header("Location: ../auth/login.php");
        exit;
    }

    /* ambil id transaksi */
    if (!isset($_GET['id'])) {
        echo "ID transaksi tidak ditemukan";
        exit;
    }

    $id = $_GET['id'];

    /* ambil data transaksi */
    $q = mysqli_query($koneksi, "
    SELECT 
        t.id_parkir,
        t.waktu_masuk,
        t.waktu_keluar,
        t.durasi_jam,
        t.total_bayar,
        k.plat_nomor,
        k.jenis_kendaraan,
        a.nama_area,
        u.username,
        tr.tarif_per_jam
    FROM tb_transaksi t
    JOIN tb_kendaraan k ON t.id_kendaraan = k.id_kendaraan
    JOIN tb_area_parkir a ON t.id_area = a.id_area
    JOIN tb_user u ON t.id_user = u.id_user
    JOIN tb_tarif tr ON t.id_tarif = tr.id_tarif
    WHERE t.id_parkir = '$id'
");

    $data = mysqli_fetch_assoc($q);

    if (!$data) {
        echo "Data transaksi tidak ditemukan";
        exit;
    }
    ?>

    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <title>Struk Parkir</title>

        <style>
            body {
                font-family: monospace;
                font-size: 12px;
            }

            .struk {
                width: 280px;
                margin: auto;
            }

            hr {
                border: 1px dashed #000;
            }

            .center {
                text-align: center;
            }
        </style>
    </head>

    <body onload="window.print()">

        <div class="struk">

            <div class="center">
                <h3>🚗 PARKIRAN STEMPERT</h3>
                <p>Jl. Kapten Piere Tendean KM 05</p>
            </div>

            <hr>

            <p>
                Plat : <?= $data['plat_nomor'] ?><br>
                Kendaraan : <?= ucfirst($data['jenis_kendaraan']) ?><br>
                Area : <?= $data['nama_area'] ?><br>
                Petugas : <?= $data['username'] ?>
            </p>

            <hr>

            <p>
                Masuk : <?= $data['waktu_masuk'] ?><br>
                Keluar : <?= $data['waktu_keluar'] ?><br>
                Durasi : <?= $data['durasi_jam'] ?> jam
            </p>

            <hr>

            <p>
                Tarif/jam : Rp <?= number_format($data['tarif_per_jam'], 0, ',', '.') ?><br>
                <strong>Total : Rp <?= number_format($data['total_bayar'], 0, ',', '.') ?></strong>
            </p>

            <hr>

            <div class="center">
                <p>Terima kasih 🙏</p>
                <p>Simpan struk ini</p>
            </div>

        </div>

    </body>

    </html>

</body>

</html>