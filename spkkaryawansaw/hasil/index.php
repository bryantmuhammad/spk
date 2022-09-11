<?php
$divisi = ambilData("SELECT divisi FROM karyawan WHERE id_karyawan = {$_SESSION['login']['id']}")[0]['divisi'];
// $data = ambilData("SELECT * FROM karyawan");
if (isset($_POST["submit"])) {
    $hasil = editNilai($_POST);
    if ($hasil['hasil'] > 0) {
        echo "<script>
        Swal.fire({
            position: 'center',
            type: 'success',
            title: 'Data berhasil dirubah',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            tampilNilai({$hasil['tahun']},{$hasil['periode']})
        })
        
        </script>";
    } else {
        echo "<script>
        Swal.fire({
            position: 'center',
            type: 'error',
            title: 'Data gagal dirubah',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            tampilNilai({$hasil['tahun']},{$hasil['periode']})
        })
        
        </script>";
    }
    // }
}
?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Karywan Terbaik </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Karyawan Terbaik </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">


            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="col-form-label" for="tahun"> Tahun</label>
                        <select name="tahun" id="tahun" class="form-control">
                            <?php
                            $dataTahun  = ambilData("SELECT DISTINCT(tahun) FROM hasil_penilaian");
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
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="col-form-label" for="tahun"> Divisi</label>
                        <input type="text" class="form-control" name="divisi" id="divisi" value="<?= $divisi ?>" readonly>
                    </div>
                </div>
            </div>

            <button onclick="tampilNilai()" class="btn btn-info mb-4 btn-block">Tampilkan Hasil</button>



            <form action="" method="post">
                <div class="ganti">


                </div>
            </form>
        </div>


</div>
</section>
<!-- /.content -->

</div>
<!-- /.content-wrapper -->


<!-- modal edit -->

<!-- Modal -->
<script>
    function tampilNilai(tahun = 0, periode = 0, divisi = 0) {
        if (tahun == 0) {
            tahun = $("#tahun").val()
        }
        if (periode == 0) {
            periode = $("#periode").val()
        }

        if (divisi == 0) {
            divisi = $("#divisi").val()
        }

        $.ajax({
            method: 'post',
            url: "ajax/dataperhitungan.php",
            data: {
                tahun,
                periode,
                divisi,
                tanda: 1
            },
            dataType: "html",
            beforeSend: res => {

                $(".ganti").empty()
                let timerInterval
                Swal.fire({
                    title: 'Sedang melakukan perhitungan',
                    html: 'Harap menunggu',
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    },
                    onClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {
                    if (
                        result.dismiss === Swal.DismissReason.timer
                    ) {}
                });

            },
            success: res => {
                Swal.fire({
                    position: 'center',
                    type: 'success',
                    title: 'Perhitungan Selesai',
                    showConfirmButton: false,
                    timer: 1000,
                }).then(function() {

                    $(".ganti").append(res)
                    // $("#tablespk").dataTable()
                });
            }
        })
    }
</script>