<?php
if (!isset($_GET['id'])) echo "<script>document.location.href='index.php?page=karyawan'</script>";
$nip = $_GET['id'];

$karyawan = ambilData("SELECT * FROM karyawan WHERE nip = '{$nip}'");
if (!count($karyawan)) echo "<script>document.location.href='index.php?page=karyawan'</script>";
$karyawan = $karyawan[0];


if (isset($_POST["submit"])) {
    if (tambahNilai($_POST) > 0) {
        echo "<script>
        Swal.fire({
            position: 'center',
            type: 'success',
            title: 'Data berhasil ditambahkan',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            document.location.href = 'index.php?page=tambahnilai'
        })
        
        </script>";
    } else {
        echo "<script>
        Swal.fire({
            position: 'center',
            type: 'error',
            title: 'Data gagal ditambahkan',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            document.location.href = 'index.php?page=tambahnilai'
        })
        
        </script>";
    }
}
$query = "SELECT DISTINCT(tahun) FROM absensi WHERE nip = '{$nip}'";

?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Data Absensi <?= $karyawan['nama'] ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Data Absensi <?= $karyawan['nama'] ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">


            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="col-form-label" for="tahun"> Tahun</label>
                            <select name="tahun" id="tahun" class="form-control">
                                <?php
                                $dataTahun  = ambilData($query);
                                foreach ($dataTahun as $d) :
                                ?>
                                    <option value="<?= $d['tahun'] ?>"><?= $d['tahun'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="col-form-label" for="tahun"> Periode</label>
                            <select name="periode" id="periode" class="form-control">
                                <option value="1">Januari - Maret</option>
                                <option value="2">April - Juni</option>
                                <option value="3">Juli - September</option>
                                <option value="4">Oktober - Desmber</option>
                            </select>
                        </div>
                    </div>


                    <?php if ($role == 2) : ?>
                        <button onclick="tampilAbsensiKaryawan('<?= $nip ?>',1)" class="btn btn-primary btn-block">Tampilkan Data Karyawan</button>
                    <?php else : ?>
                        <button onclick="tampilAbsensiKaryawan('<?= $nip ?>')" class="btn btn-primary btn-block">Tampilkan Data Karyawan</button>
                    <?php endif; ?>






                </div>

            </div>
            <div id="masuk"></div>


        </div>






</div>
<!-- /.card-body -->
</div>


</div>
</section>
<!-- /.content -->

</div>
<!-- /.content-wrapper -->

<script>
    function tampilAbsensiKaryawan(nip, tanda = 0) {
        let tahun = $("#tahun").val()
        if (!tahun) {
            alert("Tahun harus diisi dengan benar")
            return false;
        }
        let periode = $("#periode").val()
        $.ajax({
            method: 'post',
            url: "ajax/absensikaryawan.php",
            data: {
                tahun,
                periode,
                nip,
                tanda
            },
            dataType: "html",
            success: res => {
                $("#masuk").empty()
                $("#masuk").append(res)
                $('#mytable').DataTable();
            }
        })
    }
</script>