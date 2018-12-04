var loading = false;
var url = base_url + "/keranjang/simpan";
var tambahCart = function (id_mapel) {
    if (!loading) {
        loading = true;
        var berhasil = false;

        var request = $.ajax({
            url: url,
            type: 'POST',
            data: {id_mapel: id_mapel},
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