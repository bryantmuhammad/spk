$(function () {

    $('#mytable').DataTable();
    $("#formkeluarga").validate({
        rules: {
            nik: {
                required: true,
                number : true,
                maxlength: 16,
                minlength : 16
            },
            nokk: {
                required: true,
                number : true,
                maxlength: 16,
                minlength : 16
            },
        },
        messages: {
            nik: {
                maxlength: "Tidak boleh lebih dari 16 digit",
                minlength: "Harus 16 Digit"
            },
            nokk: {
                maxlength: "Tidak boleh lebih dari 16 digit",
                minlength: "Harus 16 Digit"
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

function editKriteria(idkriteria){
    $.ajax({
        method: "post",
        data : {
            idkriteria
        },
        url : 'kriteria/ajax/datakriteria.php',
        dataType : 'json',
        success : res => {
            $("#idkriteria").val(res.id_kriteria)
            $("#nama").val(res.nama)
            $("#bobot").val(res.bobot)
            $("#atribut").val(res.atribut)
        }
    })
}
function editSubKriteria(idsubkriteria){
    $.ajax({
        method: "post",
        data : {
            idsubkriteria
        },
        url : 'subkriteria/ajax/datasubkriteria.php',
        dataType : 'json',
        success : res => {
            $("#idsubkriteria").val(res.id_sub_kriteria)
            $("#nama").val(res.nama_sub)
            $("#nilai").val(res.nilai)
            $("#bobot").val(res.bobot_sub)
            $("#kriteria").val(res.id_kriteria)
        }
    })
}

function editProduk(idproduk){
    $.ajax({
        method: "post",
        data : {
            idproduk
        },
        url : 'produk/ajax/dataproduk.php',
        dataType : 'json',
        success : res => {
            $("#idproduk").val(res.id_produk)
            $("#nama").val(res.nama)
            $("#deskripsi").html(res.deskripsi)
          
        }
    })
}


function editKeluarga(nik){
    $.ajax({
        method: "post",
        data : {
            nik
        },
        url : 'keluarga/ajax/datakeluarga.php',
        dataType : 'json',
        success : res => {
            $("#nik").val(res.nik)
            $("#nokk").val(res.no_kk)
            $("#kepalakeluarga").val(res.kepala_keluarga)
            $("#rt").val(res.rt)
            $("#jk").val(res.jenis_kelamin)
           
          
        }
    })
}

function editUsers(username){
    $.ajax({
        method: "post",
        data : {
            username
        },
        url : 'user/ajax/datauser.php',
        dataType : 'json',
        success : res => {
            $("#iduser").val(res.id_user)
            $("#username").val(res.username)
            $("#nama").val(res.nama)
            $("#hak").val(res.hak_akses)
        
           
          
        }
    })
}



function editNilai(nik){

    $.ajax({
        method: "post",
        data : {
            nik
        },
        url : 'nilai/ajax/datanilai.php',
        dataType : 'json',
        success : res => {
      
            $("#nik").val(nik)
           
            $.each(res, function(index,value){

                var res = index.replace(/\s+/g, "_");
                console.log(res);

                $("#" + res).val(value)
            })
          
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
        confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: path,
                method: "post",
                data: {
                    id
                },
                dataType : "json",
                success: res => {
                    if (res.hasil) {
                        Swal.fire(
                            'Berhasil Dihapus!',
                            'Data anda sudah terhapus.',
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