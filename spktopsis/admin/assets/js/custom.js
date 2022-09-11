/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";


jQuery.extend(jQuery.validator.messages, {
    required: "Field tidak boleh kosong.",
    remote: "Please fix this field.",
    email: "Please enter a valid email address.",
    url: "Please enter a valid URL.",
    date: "Please enter a valid date.",
    dateISO: "Please enter a valid date (ISO).",
    number: "Field hanya boleh diisi dengan angka.",
    digits: "Hanya boleh angka.",
    creditcard: "Please enter a valid credit card number.",
    equalTo: "Please enter the same value again.",
    accept: "Please enter a value with a valid extension.",
    maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
    minlength: jQuery.validator.format("Mohon masukan {0} angka."),
    rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
    range: jQuery.validator.format("Please enter a value between {0} and {1}."),
    max: jQuery.validator.format("Angka harus lebih kecil dari {0}."),
    min: jQuery.validator.format("Angka harus lebih besar dari {0}.")
});

jQuery.validator.addMethod("lettersonly", function (value, element) {
    return this.optional(element) || /^[A-Z a-z /S]+$/g.test(value);
}, "Tidak boleh angka");

$(function () {


    $("#formadmin").validate({
        rules: {
            nama: {
                required: true,
                lettersonly: true
            },
            nohp: {
                required: true,
                number: true
            }
        },

        highlight: (element, errorClass, validClass) => {
            $(element).addClass("is-invalid")
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass("is-invalid").addClass("is-valid");

        }
    });

    $("#formkriteria").validate({
        rules: {
            bobot: {
                required: true,
                number: true,
                min: 1
            }
        },

        highlight: (element, errorClass, validClass) => {
            $(element).addClass("is-invalid")
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass("is-invalid").addClass("is-valid");

        }
    });

    $("#formsubkriteria").validate({
        rules: {
            bobot: {
                required: true,
                number: true,
                min: 1
            }
        },

        highlight: (element, errorClass, validClass) => {
            $(element).addClass("is-invalid")
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass("is-invalid").addClass("is-valid");

        }
    });

    $("#formproduk").validate({
        rules: {
            nama: {
                required: true,
                lettersonly: true,
            }
        },

        highlight: (element, errorClass, validClass) => {
            $(element).addClass("is-invalid")
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass("is-invalid").addClass("is-valid");

        }
    });



    $('#mytable').DataTable();

})


function editPengurus(idpengurus) {
    $.ajax({
        method: "post",
        url: 'admin/ajax/datapengurus.php',
        data: {
            idpengurus
        },
        dataType: "json",
        success: res => {
            $("#idpengurus").val(res.id_pengurus);
            $("#nama").val(res.nama)
            $("#email").val(res.email)
            $("#bidang").val(res.bidang)
            $("#tanggal").val(res.tanggal_lahir)
            $("#alamat").html(res.alamat)
            $("#nohp").val(res.no_hp)

        }
    })
}

function editKriteria(idkriteria) {
    $.ajax({
        method: "post",
        data: {
            idkriteria
        },
        url: 'kriteria/ajax/datakriteria.php',
        dataType: 'json',
        success: res => {
            $("#idkriteria").val(res.id_kriteria)
            $("#nama").val(res.nama)
            $("#bobot").val(res.bobot)
            $("#atribut").val(res.atribut)
        }
    })
}

function editSubKriteria(idsubkriteria) {
    $.ajax({
        method: "post",
        data: {
            idsubkriteria
        },
        url: 'subkriteria/ajax/datasubkriteria.php',
        dataType: 'json',
        success: res => {
            $("#idsubkriteria").val(res.id_sub_kriteria)
            $("#nama").val(res.nama_sub)
            $("#nilai").val(res.nilai)
            $("#bobot").val(res.bobot_sub)
            $("#kriteria").val(res.id_kriteria)
        }
    })
}

function editProduk(idproduk) {
    $.ajax({
        method: "post",
        data: {
            idproduk
        },
        url: 'produk/ajax/dataproduk.php',
        dataType: 'json',
        success: res => {
            $("#idproduk").val(res.id_produk)
            $("#nama").val(res.nama)
            $("#harga").val(res.harga)
            $("#deskripsi").html(res.deskripsi)

        }
    })
}

function editAdmin(idadmin) {
    $.ajax({
        method: "post",
        data: {
            idadmin
        },
        url: 'admin/ajax/dataadmin.php',
        dataType: 'json',
        success: res => {
            $("#idadmin").val(res.id_admin)
            $("#nama").val(res.nama)
            $("#jk").val(res.jk)
            $("#email").val(res.email)
            $("#jabatan").val(res.role)

            $("#alamat").html(res.alamat)

        }
    })
}


function editCustomer(idcustomer) {
    $.ajax({
        method: "post",
        data: {
            idcustomer
        },
        url: 'customer/ajax/datacustomer.php',
        dataType: 'json',
        success: res => {
            $("#idcustomer").val(res.id_customer)
            $("#nama").val(res.nama)
            $("#jk").val(res.jk)
            $("#email").val(res.email)
            $("#jabatan").val(res.role)

            $("#alamat").html(res.alamat)

        }
    })
}


function editNilai(idproduk) {


    $.ajax({
        method: "post",
        data: {
            idproduk
        },
        url: 'nilai/ajax/datanilai.php',
        dataType: 'json',
        success: res => {
            $("#idproduk").val(idproduk)

            $.each(res, function (index, value) {
                var res = index.replace(/\s+/g, "_");


                $("#" + res).val(value)
                // $("#" + index).val(value)
            })

        }
    })
}


function hapusData(id, path, back) {
    Swal.fire({
        title: 'Yakin ingin menghapus data?',
        text: "Data akan dihapus selamanya!",
        icon: 'warning',
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
                dataType: "json",
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