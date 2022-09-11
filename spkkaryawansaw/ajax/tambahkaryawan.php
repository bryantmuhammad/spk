<?php
require_once "../include/functions.php";
$tahun      = $_POST['tahun'];
$periode    = $_POST['periode'];
$jabatan     = $_POST['jabatan'];
//karyawan yang sudah ada nilai
$karyawan = ambilData("SELECT karyawan.id_karyawan FROM hasil_penilaian INNER JOIN karyawan USING(id_karyawan) WHERE hasil_penilaian.tahun = '{$tahun}' AND hasil_penilaian.periode = {$periode} AND karyawan.jabatan = '{$jabatan}'");
$i = 0;
$last = count($karyawan);
$query = "SELECT * FROM karyawan WHERE jabatan = '{$jabatan}'";
if ($last) {
    $query = "SELECT * FROM karyawan WHERE id_karyawan NOT IN(";
    foreach ($karyawan as $k) {
        if (++$i == $last) {
            $query .= $k['id_karyawan'] . ")";
        } else {
            $query .= $k['id_karyawan'] . ",";
        }
    }
}



$kriteria = ambilData("SELECT * FROM kriteria WHERE id_kriteria != 3");
$karyawan = ambilData($query);

?>

<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th class="text-center">Nama Karyawan</th>
            <th class="text-center">Divisi</th>
            <?php foreach ($kriteria as $k) : ?>
                <th class="text-center"><?= $k['nama_kriteria'] ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>


    <?php foreach ($karyawan as $k) : ?>
        <tr>
            <td class="text-center"><?= $k["nama"] ?></td>
            <td class="text-center"><?= $k["divisi"] ?></td>
            <?php foreach ($kriteria as $d) :  ?>

                <td class="text-center">
                    <select name="sub[<?= $k['id_karyawan'] ?>][]" class="form-control" required>
                        <?php
                        $dataSub = ambilData("SELECT nama_sub_kriteria,id_sub_kriteria FROM sub_kriteria WHERE id_kriteria = {$d['id_kriteria']}");
                        foreach ($dataSub as $s) :
                        ?>
                            <option value="<?= $s['id_sub_kriteria'] ?>"><?= $s['nama_sub_kriteria'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>

            <?php endforeach; ?>
        </tr>
        <input type="hidden" name="periode" value="<?= $periode ?>">
        <input type="hidden" name="tahun" value="<?= $tahun ?>">
    <?php endforeach; ?>

</table>
<button name="submit" type="submit" class="btn btn-primary btn-block">Tambah Nilai</button>