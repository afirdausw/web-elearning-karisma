var loading = false;

var tambahCart = function (id_mapel) {
    if (!loading) {
        loading = true;
        var berhasil = false;
        jQuery('#error').addClass('d-none');
        btn_simpan.removeClass('btn-alt-primary').addClass('btn-alt-secondary disabled').attr("disabled", true);
        btn_back.removeClass('btn-alt-primary').addClass('btn-alt-secondary disabled').attr("disabled", true);
        icon_btn_simpan.removeClass('si si-login d-none').addClass('fa fa-sun-o fa-spin mr-5');
        text_btn_simpan.html('Menyimpan');
        block.addClass('block-mode-loading');
        var formData = new FormData(formToko[0]);

        var request = $.ajax({
            url: url,
            data: formData,
            type: 'POST',
            contentType: false,
            processData: false
        });
        request.fail(function (xhr, status, error) {
            berhasil = false;
            alert('Terjadi Kesalahan Jaringan');
        });

        request.done(function (xhr, status, error) {
            if (xhr.success) {
                berhasil = true;
            } else {
                berhasil = false;
                alert('Data Gagal Di masukan Ke Keranjang');
            }
        });

        request.always(function (xhr, status, error) {
            if (berhasil) {
                setTimeout(function () {
                    document.location.reload();
                }, 1000);
            }
        });
    }
};