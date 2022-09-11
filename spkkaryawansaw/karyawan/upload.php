<?php

if (isset($_POST['submit'])) {
    $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

    if (isset($_FILES['berkas_excel']['name']) && in_array($_FILES['berkas_excel']['type'], $file_mimes)) {

        $arr_file = explode('.', $_FILES['berkas_excel']['name']);
        $extension = end($arr_file);
        $return = 0;
        if ('csv' == $extension) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        } else {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }

        $spreadsheet = $reader->load($_FILES['berkas_excel']['tmp_name']);

        $sheetData = $spreadsheet->getActiveSheet()->toArray();
        for ($i = 1; $i < count($sheetData); $i++) {
            $nip        = $sheetData[$i]['1'];
            $periode    = $sheetData[$i]['2'];
            $tahun      = $sheetData[$i]['3'];
            $hadir      = $sheetData[$i]['4'];
            $alpha      = $sheetData[$i]['5'];
            $izin       = $sheetData[$i]['6'];
            $minggu     = $sheetData[$i]['7'];
            mysqli_query($koneksi, "INSERT INTO absensi VALUES ('','{$nip}',{$periode},'{$tahun}',{$hadir},{$alpha},{$izin},{$minggu})");

            $return += mysqli_affected_rows($koneksi);
        }
        if ($return) {
            echo "<script>
        Swal.fire({
            position: 'center',
            type: 'success',
            title: 'Data absensi berhasil ditambahkan',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            document.location.href = 'index.php?page=karyawan'
        })
        
        </script>";
        } else {
            echo "<script>
            Swal.fire({
            position: 'center',
            type: 'error',
            title: 'Data absensi gagal ditambahkan',
            showConfirmButton: false,
            timer: 1500
            }).then(() => {
            document.location.href = 'index.php?page=karyawan'
             })
        
        </script>";
        }
    }
}
?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Tambah Absensi Karyawan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Absensi Karyawan</li>
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
                <form role="form" method="post" action="" id="formkriteria" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- text input -->
                            <div class="form-group">
                                <label class="col-form-label" for="nip"> Upload File Excel </label>
                                <input type="file" name="berkas_excel" class="form-control">

                            </div>
                        </div>

                    </div>
            </div>


            <button name="submit" type="submit" class="btn btn-primary btn-block">Upload File Excel</button>


            </form>
        </div>
        <!-- /.card-body -->
</div>


</div>
</section>
<!-- /.content -->

</div>
<!-- /.content-wrapper -->