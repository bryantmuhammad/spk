<?php
require_once "../include/functions.php";
$nip        = $_POST['nip'];
$tahun      = $_POST['tahun'];
$periode    = $_POST['periode'];
$data       = ambilData("SELECT * FROM absensi WHERE nip = '{$nip}' AND periode = {$periode} AND tahun = '{$tahun}'");
$tanda      = $_POST['tanda'];

$bulan = [];
$angka = [];
$status = '';
if ($periode == 1) {
    $status = "Januari - Maret";
    $bulan = [
        "Januari",
        "Februari",
        "Maret"
    ];
    $angka = [[1, 2, 3, 4], [5, 6, 7, 8], [9, 10, 11, 12]];
} else if ($periode == 2) {
    $status = "April - Juni";
    $bulan = [
        "April",
        "Mei",
        "Juni"
    ];
    $angka = [[1, 2, 3, 4], [5, 6, 7, 8], [9, 10, 11, 12]];
} else if ($periode == 3) {
    $status = "Juli - September";
    $bulan = [
        "Juli",
        "Agustus",
        "September"
    ];
    $angka = [[1, 2, 3, 4], [5, 6, 7, 8], [9, 10, 11, 12]];
} else {
    $status = "Oktober - Desmber";
    $bulan = [
        "Oktober",
        "November",
        "Desember"
    ];
    $angka = [[1, 2, 3, 4], [5, 6, 7, 8], [9, 10, 11, 12]];
}

if (count($data)) :
?>
    <a href="cetak/cetakabsensi.php?nip=<?= $nip ?>&periode=<?= $periode ?>&tahun=<?= $tahun ?>" target="_blank">
        <button class="btn btn-warning mb-3">
            <i class="fa fa-print"></i>
        </button>
    </a>
    <table id="mytable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">Minggu Ke</th>
                <th class="text-center">Hadir</th>
                <th class="text-center">Alpha</th>
                <th class="text-center">Izin</th>
                <th class="text-center">Periode</th>
                <?php if (!$tanda) : ?>
                    <th class="text-center">Aksi</th>
                <?php endif; ?>
            </tr>
        </thead>
        <?php
        foreach ($data as $k) :
        ?>
            <tr>
                <td class="text-center"><?= $k["minggu"] ?></td>
                <td class="text-center"><?= $k["hadir"] ?></td>
                <td class="text-center"><?= $k["alpha"] ?></td>
                <td class="text-center"><?= $k["izin"] ?></td>
                <td class="text-center"><?= $status ?></td>
                <?php if (!$tanda) : ?>
                    <td class="text-center">
                        <button class="btn btn-danger" data-id="<?= $k['id_absensi'] ?>" onclick="hapusData($(this).data('id'),'ajax/hapus/hapusabsensi.php','karyawan')"><i class="fas fa-trash"></i></button>
                    </td>
                <?php endif; ?>

            </tr>
        <?php endforeach; ?>
    </table>

    <?php
    $jumlah = [];
    $cek = 1;
    for ($i = 0; $i < count($angka); $i++) {

        $j = 0;
        for ($z = 0; $z < count($angka[$i]); $z++) {

            $query      = "SELECT hadir  FROM absensi WHERE nip = '{$nip}' AND minggu = {$angka[$i][$z]} AND periode = {$periode} AND tahun = '{$tahun}'";

            $temp       = ambilData($query);
            // var_dump($temp);
            if (count($temp)) {
                $j += $temp[0]['hadir'];
            }

            // var_dump($jumlah);
        }

        $jumlah[]   = $j;
    }


    ?>


    <h3 class="text-center">Grafik Absensi</h3>
    <canvas id="myChart" width="400" height="150"></canvas>
    <script>
        var ctx = document.getElementById('myChart');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['<?= $bulan[0] ?>', '<?= $bulan[1] ?>', '<?= $bulan[2] ?>'],
                datasets: [{
                    label: 'Absensi',
                    data: ['<?= $jumlah[0] ?>', '<?= $jumlah[1] ?>', '<?= $jumlah[2] ?>'],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 206, 86)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>



<?php else : ?>
    <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Tidak ada data absensi!</h4>
        <p>Silahkan tambah data absensi terlebih dahulu.</p>
    </div>
<?php endif; ?>