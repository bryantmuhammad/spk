$(function () {


    $('#example').DataTable();

    $("#formkriteria").validate({
        rules: {
            nama: {
                required: true,
            },
            presentase: {
                required: true,
                number: true
            },
        },
        highlight: (element, errorClass, validClass) => {
            $(element).addClass("is-invalid")
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass("is-invalid").addClass("is-valid");

        }
    });
    $("#formspv").validate({
        rules: {
            nip: {
                required: true,
                number: true,

            },
            username: {
                required: true,
                lettersonly: true
            },
            nama: {
                required: true,
                lettersonly: true
            },
        },
        highlight: (element, errorClass, validClass) => {
            $(element).addClass("is-invalid")
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass("is-invalid").addClass("is-valid");

        }
    });


})




//================================== MY FUNCTION ===========================================

function jenisSurat(id) {
    $.ajax({
        method: 'post',
        url: "ajax/datajenissurat.php",
        data: {
            id
        },
        dataType: "json",
        success: res => {

            $("#idjenis").val(res.id_jenis);
            $("#jenissurat").val(res.jenis);
        }
    })
}

function hapusData(id, path, back) {
    Swal.fire({
        title: 'Yakin ingin menghapus data?',
        text: "Data akan dihapus selamanya!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: path,
                method: "post",
                data: {
                    id
                },
                dataType: "json",
                success: res => {
                    if (res.hasil) {
                        Swal.fire(
                            'Deleted!',
                            'Data berhasil dihapus.',
                            'success'
                        ).then(klik => {
                            if (klik.value) {
                                document.location.href = "index.php?page=" + back
                            }
                        })
                    }
                }
            })
        }
    })
}




function editKriteria(id) {
    $.ajax({
        method: 'post',
        url: "ajax/datakriteria.php",
        data: {
            id
        },
        dataType: "json",
        success: res => {

            $("#idkriteria").val(res.id_kriteria);
            $("#nama").val(res.nama_kriteria);
            $("#presentase").val(res.presentase);
            $("#jenis").val(res.jenis);
        }
    })
}

function editSubKriteria(id) {
    $.ajax({
        method: 'post',
        url: "ajax/datasubkriteria.php",
        data: {
            id
        },
        dataType: "json",
        success: res => {

            $("#idsubkriteria").val(res.id_sub_kriteria);
            $("#nama").val(res.nama_sub_kriteria);
            $("#bobot").val(res.bobot);
            $("#idkriteria").val(res.id_kriteria);
        }
    })
}

function editKaryawan(id) {
    $.ajax({
        method: 'post',
        url: "ajax/datakaryawan.php",
        data: {
            id
        },
        dataType: "json",
        success: res => {
            $("#idkaryawan").val(res.id_karyawan);
            $("#nip").val(res.nip);
            $("#nama").val(res.nama);
            $("#divisi").val(res.divisi);
            $("#jk").val(res.jk);
            $("#jabatan").val(res.jabatan);
            $("#alamat").html(res.alamat);

        }
    })
}



function editUser(id) {
    $.ajax({
        method: 'post',
        url: "ajax/datauser.php",
        data: {
            id
        },
        dataType: "json",
        success: res => {

            $("#iduser").val(res.id_user);
            $("#nama").val(res.nama);
            $("#username").val(res.username);
            $("#jk").val(res.jk);
            $("#tanggallahir").val(res.tgl_lahir);
            $("#alamat").html(res.alamat);

        }
    })
}

function editSpv(id) {
    $.ajax({
        method: 'post',
        url: "ajax/dataspv.php",
        data: {
            id
        },
        dataType: "json",
        success: res => {

            $("#idspv").val(res.id_spv);
            $("#nama").val(res.nama);
            $("#nip").val(res.nip);
            $("#username").val(res.username);
            $("#jabatan").val(res.jabatan);

        }
    })
}

function editPemilik(id) {
    $.ajax({
        method: 'post',
        url: "ajax/datapemilik.php",
        data: {
            id
        },
        dataType: "json",
        success: res => {
            $("#idpemilik").val(res.id_pemilik);
            $("#nama").val(res.nama);
            $("#alamat").html(res.alamat);
            $("#jk").val(res.jk);
            $("#username").val(res.username);
        }
    })
}