<?php
$matkul = [
    ["nama" => "Pemrograman Web", "sks" => 3, "nilai" => 85],
    ["nama" => "Basis Data", "sks" => 3, "nilai" => 75],
    ["nama" => "Algoritma Pemrograman", "sks" => 4, "nilai" => 60],
    ["nama" => "Jaringan Komputer", "sks" => 3, "nilai" => 45], 
    ["nama" => "Sistem Operasi", "sks" => 3, "nilai" => 90],
];

function hitungBobot($nilai) {
    if ($nilai >= 85) {
        return ["huruf" => "A", "bobot" => 4.0];
    } elseif ($nilai >= 70) {
        return ["huruf" => "B", "bobot" => 3.0];
    } elseif ($nilai >= 55) {
        return ["huruf" => "C", "bobot" => 2.0];
    } elseif ($nilai >= 40) {
        return ["huruf" => "D", "bobot" => 1.0];
    } else {
        return ["huruf" => "E", "bobot" => 0.0];
    }
}

$total_sks = 0;
$total_bobot = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kartu Hasil Studi (KHS)</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #333;
            padding: 8px 12px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .baris-mengulang {
            background-color: #ffcccc; 
        }
    </style>
</head>
<body>

    <h2>Kartu Hasil Studi Mahasiswa</h2>

    <table>
        <tr>
            <th>No</th>
            <th>Mata Kuliah</th>
            <th>SKS</th>
            <th>Nilai Angka</th>
            <th>Nilai Huruf</th>
            <th>Bobot</th>
            <th>Status</th>
        </tr>

        <?php 
        $no = 1;
        foreach ($matkul as $m) : 
            $hasil = hitungBobot($m['nilai']);
            $huruf = $hasil['huruf'];
            $bobot = $hasil['bobot'];

            if ($bobot >= 2.0) {
                $status = "LULUS";
                $kelas_warna = "";
            } else {
                $status = "MENGULANG";
                $kelas_warna = "baris-mengulang";
            }

            $total_sks += $m['sks'];
            $total_bobot += ($m['sks'] * $bobot);
        ?>
        <tr class="<?= $kelas_warna; ?>">
            <td><?= $no++; ?></td>
            <td style="text-align: left;"><?= $m['nama']; ?></td>
            <td><?= $m['sks']; ?></td>
            <td><?= $m['nilai']; ?></td>
            <td><?= $huruf; ?></td>
            <td><?= $bobot; ?></td>
            <td><b><?= $status; ?></b></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <?php
    $ips = $total_bobot / $total_sks;

    if ($ips >= 3.00) {
        $maks_sks = 24;
        $keterangan = "Karena IPS >= 3.00, Anda berhak mengambil maksimal 24 SKS.";
    } else {
        $maks_sks = 20;
        $keterangan = "Karena IPS < 3.00, batas maksimal SKS semester depan adalah 20 SKS.";
    }
    ?>

    <h3>Ringkasan Hasil Studi:</h3>
    <ul>
        <li>Total SKS: <b><?= $total_sks; ?> SKS</b></li>
        <li>Indeks Prestasi Semester (IPS): <b><?= number_format($ips, 2); ?></b></li>
        <li>Batas Maksimal SKS Semester Depan: <b><?= $maks_sks; ?> SKS</b></li>
    </ul>
    <p><i>Catatan: <?= $keterangan; ?></i></p>

</body>
</html>
