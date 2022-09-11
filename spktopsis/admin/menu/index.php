<?php
$data       = ambilData("SELECT * FROM produk");
$kriteria   = ambilData("SELECT * FROM kriteria");

?>


<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pencarian Menu</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
                <div class="breadcrumb-item">Pencarian Menu</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <form class="" id="formkriteria" method="post" action="">
                            <div class="card-body">
                                <div class="row">
                                    <?php foreach ($kriteria as $k) : ?>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label><?= $k['nama'] ?></label>
                                                <select name="<?= makeId($k['nama']) ?>" class="form-control" id="<?= makeId($k['nama']) ?>">
                                                    <option value="0">- Belum Memilih - </option>
                                                    <?php
                                                        $subkriteria = ambilData("SELECT * FROM sub_kriteria WHERE id_kriteria = {$k['id_kriteria']}");
                                                        foreach ($subkriteria as $s) :
                                                            ?>
                                                        <option value="<?= $s['id_sub_kriteria'] ?>"><?= $s['nama_sub'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                    <?php endforeach; ?>


                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <button class="btn btn-block btn-primary" type="submit" id="cari" name="submit">Cari</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group masukrincian">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="table-responsive masuk">



                                <div class="alert alert-success" role="alert">
                                    <h4 class="alert-heading">Silahkan pilih kriteria terlebih dahulu!</h4>

                                </div>


                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

</div>

<script>
    $(function(e) {
        $("#cari").click(function(e) {
            e.preventDefault();

            let form = document.getElementById("formkriteria");
            var fd = new FormData(form);

            $.ajax({
                url: "menu/ajax/perhitungan.php",
                data: fd,
                processData: false,
                contentType: false,
                cache: false,
                enctype: 'multipart/form-data',
                method: "post",
                dataType: "html",
                beforeSend: res => {

                    $(".masuk").empty();

                    let el = $(`<div class="row">
                                    <div class="col-lg-12 text-center">
                                        <img src="assets/loading.gif" alt="" height="500px" width="500px">
                                    </div>
                                </div>`)
                    $(".masuk").append(el);
                },
                success: Response => {
                    let el = $(`<button class="btn btn-block btn-info" type="submit" onclick="rinci(event)" id="rincian" name="submit">Lihat Rincian</button>`)
                    $(".masuk").empty();
                    $(".masuk").append(Response);
                    $(".masukrincian").empty();
                    $(".masukrincian").append(el);
                }
            })
        })



    })


    function simpanNilaiProduk(id) {
        let form = document.getElementById("formproduk");
        var fd = new FormData(form);
        fd.append('idlaporan', id);


        $.ajax({
            url: "menu/ajax/simpanproduk.php",
            data: fd,
            processData: false,
            contentType: false,
            cache: false,
            enctype: 'multipart/form-data',
            method: "post",
            dataType: "json",
            success: Response => {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Penilaian berhasil disimpan',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {

                })
            }
        })

    }

    function simpanPenilaian() {


        let form = document.getElementById("formkriteria");
        var fd = new FormData(form);
        // let produk = document.getElementById("formproduk");



        $.ajax({
            url: "menu/ajax/simpanperhitungan.php",
            data: fd,
            processData: false,
            contentType: false,
            cache: false,
            enctype: 'multipart/form-data',
            method: "post",
            dataType: "json",
            success: Response => {

                simpanNilaiProduk(Response.id);
            }
        })
    }

    function rinci(e) {
        e.preventDefault();

        let form = document.getElementById("formkriteria");
        var fd = new FormData(form);


        fd.append("rinci", 1);


        $.ajax({
            url: "menu/ajax/perhitungan.php",
            data: fd,
            processData: false,
            contentType: false,
            cache: false,
            enctype: 'multipart/form-data',
            method: "post",
            dataType: "html",
            beforeSend: res => {

                $(".masuk").empty();

                let el = $(`<div class="row">
                        <div class="col-lg-12 text-center">
                            <img src="assets/loading.gif" alt="" height="500px" width="500px">
                        </div>
                    </div>`)
                $(".masuk").append(el);
            },
            success: Response => {

                $(".masuk").empty();
                $(".masuk").append(Response);

            }
        })
    }
</script>