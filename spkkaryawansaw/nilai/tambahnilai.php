<?php
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
?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Tambah Nilai</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Nilai</li>
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
                            <input type="text" class="form-control" id="tahun" name="tahun" autocomplete="off" required>
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
                        <?php
                        $divisi = divisi();
                        ?>
                        <div class="form-group">
                            <label class="col-form-label" for="tahun"> Jabatan</label>
                            <select name="jabatan" id="jabatan" class="form-control">
                                <?php
                                $dataDivisi = ambilData("SELECT DISTINCT(jabatan) FROM karyawan");
                                foreach ($dataDivisi as $d) :
                                    if (in_array($d['jabatan'], $divisi)) :
                                ?>
                                        <option value="<?= $d['jabatan'] ?>"><?= $d['jabatan'] ?></option>
                                <?php
                                    endif;
                                endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <button onclick="tambahNilaiKaryawan()" class="btn btn-primary btn-block">Tampilkan Data Karyawan</button>

                </div>

                <form role="form" method="post" action="" id="formkriteria" enctype="multipart/form-data">





            </div>
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
    function tambahNilaiKaryawan() {
        let tahun = $("#tahun").val()
        let jabatan = $("#jabatan").val()
        if (!tahun) {
            alert("Tahun harus diisi dengan benar")
            return false;
        }
        let periode = $("#periode").val()
        $.ajax({
            method: 'post',
            url: "ajax/tambahkaryawan.php",
            data: {
                tahun,
                periode,
                jabatan
            },
            dataType: "html",
            success: res => {
                $("#formkriteria").empty()
                $("#formkriteria").append(res)
            }
        })
    }
</script>