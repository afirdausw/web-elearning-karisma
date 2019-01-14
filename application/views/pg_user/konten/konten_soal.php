<?php
$judul_tab = $sub_materi->materi_pokok_id.".".$sub_materi->urutan_materi." ".$sub_materi->nama_sub_materi;
$this->load->view('pg_user/inc/header.php');
?>
<?php
// Pengaturan waktu countdown
// if(isset($_SESSION['mulai_waktu'])){
//     $telah_berlalu = time() - $_SESSION["mulai_waktu"];
// } else {
//     $_SESSION["mulai_waktu"] = date("r",strtotime($log["start"]));
//     $telah_berlalu = 0;
// }

// $waktu_quiz = date("r",strtotime($log['finish']));
// $waktu_sisa = $waktu_quiz - $telah_berlalu;

// Session halaman sebelumnya ketika sudah login
$_SESSION['RedirectKe'] = current_url();


$status_finish = 0;
$nilai = (float)0.0;
$waktu_quiz = (float)0.0;
$jam = (float)0.0;
// Pengaturan waktu countdown
if (isset($log) AND $log != NULL) {
    $telah_berlalu = time() - strtotime($log->start);
    $nilai = $log->nilai;
    if ($log->finish_ujian != NULL) {
        $status_finish = 1;
    }

} else {
    $telah_berlalu = 0;
}
foreach ($soal as $s) {
    if ($s->waktu_soal != 0 || $s->waktu_soal != NULL) {
        $jam = $s->waktu_soal;
    } else {
        $jam = 90;
    }
    $waktu_quiz = $jam * 60;
}
$waktu_sisa = $waktu_quiz - $telah_berlalu;
if ($waktu_sisa < 0) {
    $waktu_sisa = 0;
    $status_finish = 1;
}
?>

<section> <!-- konten-->
    <div class="container fixed-top">
        <div class="row">
            <!-- Sub Materi Kanan -->
            <?php include("konten_sidebar.php");?>

            <div class="col-lg-8 col-md-7 col-sm-7 materi" style="float: left">
                <!-- WRAP JUDUL MATERI -->
                <?php $key = $sub_materi; ?>
                <div class="row wrap-materi">
                    <div class="col-lg-7 col-md-7">
                        <span class="materi-no"><?= $key->urutan_materi ?>.</span>
                        <span class="judul-submateri"><?= $key->nama_sub_materi ?></span>
                    </div>
                    <div class="col-lg-5 col-md-5 wrap-button-materi">
                        <button class="btn btn-default">
                            <span class="ti-more-alt"></span> Pertanyaan
                        </button>
                        <button class="btn btn-default">
                            <span class="ti-user"></span> Peserta
                        </button>
                    </div>
                </div>

                <!-- WRAP ISI MATERI -->
                <div class="row" style="text-align: center">
                    <div class="col-lg-12">
                        <img src="<?php echo base_url('assets/img/icon/icon-soal.png') ?>" width="552px"
                             class="img-soal"/><br>
                        <?php
                        $pretest = $key->pretest_status;
                        ?>
                        <?php
                        if ($this->session->userdata('id_siswa') != NULL OR $this->session->userdata('pretest_id') != NULL) { ?>
                            <button id="mulai" data-toggle="modal" href="#soal" type="button" class="btn
							<?php if ($test_jum == 0) {
                                echo 'btn-primary';
                            } else {
                                echo 'btn-success';
                            } ?> btn-md">
                                <?php if ($test_jum == 0) { ?>
                                    <i class="ti-check-box"></i> Mulai Quiz
                                <?php } else { ?>
                                    <i class="ti-control-forward"></i> Lanjutkan
                                <?php } ?>
                            </button>
                            <?php
                        } else if ($this->session->userdata('id_siswa') == NULL || $this->session->userdata('pretest_id') == NULL) { ?>
                            <a href="<?= base_url(); ?>login">
                                <button type="button" class="btn btn-default btn-md" id="mulai">
                                    <i class="ti-lock"></i> Login untuk memulai
                                </button>
                            </a>
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="row hidden" id="nilaiContainer">
                    <div>Nilai Anda</div>
                    <span class="nilainya">
                		10
                	</span>
                </div>
                <dialog id="timeUp">Waktu mengerjakan sudah selesai, tekan <b>esc</b> untuk menutup pesan ini!</dialog>


                <!-- MODAL -->
                <div class="modal multi-step modal-quiz modal-center fade" id="soal">
                    <div class="modal-dialog modal-dialog-quiz">
                        <div id="progressBar">
                            <div class="bar"></div>
                        </div>
                        <div class="modal-content modal-content-quiz">
                            <div class="modal-header">
                                <div class="quiz-waktu">
                                    <i class="ti-time"></i>
                                    <span id="timer">-</span>
                                </div>
                                <h4 class="modal-judul"><i
                                            class="ti-check-box"></i>&nbsp;&nbsp;<b>Quiz <?= $sub_materi->id_sub_materi ?></b> <?= $sub_materi->nama_sub_materi ?>
                                </h4>
                            </div>
                            <?php
                            $no = 1;
                            foreach ($soal as $value) {
                                $id_soal = $value->id_soal;
                                $inc_terjawab = 0;
                                $array_terjawab = [];


                                if (isset($data_jawaban)) {
                                    foreach ($data_jawaban as $dj) {
                                        if ($dj->soal_id == $id_soal) {
                                            $array_terjawab[$inc_terjawab] = $dj->jawaban;
                                        } else {
                                            $array_terjawab[$inc_terjawab] = 0;
                                        }
                                        $inc_terjawab++;
                                    }
                                }
                                ?>
                                <div class="modal-body modal-konten step-<?= $no ?>" data-step="<?= $no ?>">
                                    <div class="row">
                                        <div class="col-md-7 pertanyaan">
                                            <span class="badge">Soal <?= $no ?> dari <?= $jumlah ?></span>
                                            <p><?= $value->isi_soal ?></p>
                                        </div>
                                        <div class="col-md-5 jawaban">
                                            <div class="row">
                                                <span class="badge">Pilihan</span>
                                            </div>
                                            <div class="row">
                                                <div class="btn-group" data-toggle="buttons">
                                                <label class="btn btn-primary btn-block <?php if (isset($data_jawaban)) {
                                                    if (isset($array_terjawab[$no - 1]) AND $array_terjawab[$no - 1] == 1) {
                                                        echo "active";
                                                    }
                                                } ?>">
                                                    <input type="radio" name="jawabSoal" id="option1" autocomplete="off"
                                                           value="1"
                                                           soal-no="<?= $id_soal; ?>" <?php if (isset($data_jawaban)) {
                                                        if (isset($array_terjawab[$no - 1]) AND $array_terjawab[$no - 1] == 1) {
                                                            echo "checked='checked'";
                                                        }
                                                    } ?>><span>A.</span> <?php $text = str_ireplace('<p>', '', $value->jawab_1);
                                                    echo $text;
                                                    ?>
                                                </label>
                                                <label class="btn btn-primary btn-block <?php if (isset($data_jawaban)) {
                                                    if (isset($array_terjawab[$no - 1]) AND $array_terjawab[$no - 1] == 2) {
                                                        echo "active";
                                                    }
                                                } ?>">
                                                    <input type="radio" name="jawabSoal" id="option2" autocomplete="off"
                                                           value="2"
                                                           soal-no="<?= $id_soal; ?>" <?php if (isset($data_jawaban)) {
                                                        if (isset($array_terjawab[$no - 1]) AND $array_terjawab[$no - 1] == 2) {
                                                            echo "checked='checked'";
                                                        }
                                                    } ?>><span>B.</span> <?php $text = str_ireplace('<p>', '', $value->jawab_2);
                                                    echo $text;
                                                    ?>
                                                </label>
                                                <label class="btn btn-primary btn-block <?php if (isset($data_jawaban)) {
                                                    if (isset($array_terjawab[$no - 1]) AND $array_terjawab[$no - 1] == 3) {
                                                        echo "active";
                                                    }
                                                } ?>">
                                                    <input type="radio" name="jawabSoal" id="option3" autocomplete="off"
                                                           value="3"
                                                           soal-no="<?= $id_soal; ?>" <?php if (isset($data_jawaban)) {
                                                        if (isset($array_terjawab[$no - 1]) AND $array_terjawab[$no - 1] == 3) {
                                                            echo "checked='checked'";
                                                        }
                                                    } ?>><span>C.</span> <?php $text = str_ireplace('<p>', '', $value->jawab_3);
                                                    echo $text;
                                                    ?>
                                                </label>
                                                <label class="btn btn-primary btn-block <?php if (isset($data_jawaban)) {
                                                    if (isset($array_terjawab[$no - 1]) AND $array_terjawab[$no - 1] == 4) {
                                                        echo "active";
                                                    }
                                                } ?>">
                                                    <input type="radio" name="jawabSoal" id="option4" autocomplete="off"
                                                           value="4"
                                                           soal-no="<?= $id_soal; ?>" <?php if (isset($data_jawaban)) {
                                                        if (isset($array_terjawab[$no - 1]) AND $array_terjawab[$no - 1] == 4) {
                                                            echo "checked='checked'";
                                                        }
                                                    } ?>><span>D.</span> <?php $text = str_ireplace('<p>', '', $value->jawab_4);
                                                    echo $text;
                                                    ?>
                                                </label>
                                                <label class="btn btn-primary btn-block <?php if (isset($data_jawaban)) {
                                                    if (isset($array_terjawab[$no - 1]) AND $array_terjawab[$no - 1] == 5) {
                                                        echo "active";
                                                    }
                                                } ?>">

                                                    <input type="radio" name="jawabSoal" id="option5" autocomplete="off"
                                                           value="5"
                                                           soal-no="<?= $id_soal; ?>" <?php if (isset($data_jawaban)) {
                                                        if (isset($array_terjawab[$no - 1]) AND $array_terjawab[$no - 1] == 5) {
                                                            echo "checked='checked'";
                                                        }
                                                    } ?>><span>E.</span> <?php $text = str_ireplace('<p>', '', $value->jawab_5);
                                                    echo $text;
                                                    ?>
                                                </label>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $no++;
                            } ?>
                            <div class="modal-footer" style="text-align: center">
                                <div class="col-md-12">
                                    <ul class="pagination">
                                        <li class="prev"><a href="javascript:prev_m();"><i
                                                        class="fa fa-chevron-left"></i></a></li>
                                        <?php
                                        $no = 1;
                                        foreach ($soal as $value) {
                                            ?>
                                            <li id="page-<?= $no ?>"><a href="#"
                                                                        onclick="hal(<?= $no ?>)"><?= $no ?></a>
                                            </li>
                                            <?php $no++;
                                        } ?>
                                        <li class="next"><a href="javascript:next_m();"><i
                                                        class="fa fa-chevron-right"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                <div id="finalButton" class="col-md-12 text-center hidden" style="margin-top: 10px">
                                    <button class="btn btn-block btn-success"><span
                                                class="glyphicon glyphicon-ok"></span> Selesai
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- WRAP DETAIL MATERI -->
                <?php $data = $materi ?>
                <div class="row wrap-detail-materi">
                    <div class="col-lg-1 col-md-2 col-sm-2 col-xs-2 text-right">
                        <a href="<?= base_url().'mapel/'.$materi->mapel_id ?>">
                            <img class="centered-cover" src="<?= base_url()?>/image/mapel/<?= $materi->gambar_mapel ?>" alt="Logo Materi">
                        </a>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-10">
                        <h3><?= $data->nama_materi_pokok ?></h3>
                        <span class="badge">12 Materi</span>
                        <span class="badge">50 Peserta</span>
                        <p>Oleh
                            <?php if ($instruktur != null): ?>
                                <a href="<?= base_url('instruktur/' . $instruktur[0]->id_instruktur) ?>"
                                   target="_blank"><?= $instruktur[0]->nama_instruktur ?></a>
                            <?php else: ?>
                                <a href="#">Instruktur Karisma Academy</a>
                            <?php endif; ?>
                            . 12/02/2018</p>
                    </div>
                    <div class="col-lg-5 col-md-4 col-sm-4 col-xs-12">
                        <ul class="pager">
                            <?php
                            if (!empty($prev) || !empty($prev_mapok)) {
                                if (!empty($prev)) {
                                    $prev = $prev;
                                } elseif (!empty($prev_mapok)) {
                                    $prev = $prev_mapok;
                                }
                                $prev_url = "#";
                                if ($prev->kategori == "1") {
                                    $prev_url = base_url('konten/detail/' . $prev->id_konten);
                                }
                                if ($prev->kategori == "2") {
                                    $prev_url = base_url('konten/detail_video/' . $prev->id_konten);
                                }
                                if ($prev->kategori == "3") {
                                    $prev_url = base_url('konten/detail_soal/' . $prev->id_konten);
                                }

                                echo '<li><a href="' . $prev_url . '" title="' . $prev->nama_sub_materi . '" class="prev-materi"><span class="ti-angle-left"></span> Sebelumnya</a></li>';
                            }
                            ?>

                            <?php
                            if (!empty($next) || !empty($next_mapok)) {
                                if (!empty($next)) {
                                    $next = $next;
                                } elseif (!empty($next_mapok)) {
                                    $next = $next_mapok;
                                }
                                $next_url = "#";
                                if ($next->kategori == "1") {
                                    $next_url = base_url('konten/detail/' . $next->id_konten);
                                }
                                if ($next->kategori == "2") {
                                    $next_url = base_url('konten/detail_video/' . $next->id_konten);
                                }
                                if ($next->kategori == "3") {
                                    $next_url = base_url('konten/detail_soal/' . $next->id_konten);
                                }

                                echo '<li><a href="' . $next_url . '" title="' . $next->nama_sub_materi . '" class="next-materi">Selanjutnya <span class="ti-angle-right"></span></a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> <!-- End of konten-->

<?php $this->load->view('pg_user/inc/footer.php'); ?>
<script src="<?php echo base_url('assets/plugins/my/my-multi-modal.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/jquery/jquery.plugin.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/jquery/jquery.countdown.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

<?php if ($this->session->userdata('pretest_logged_in')) {
    $idsiswa = $this->session->userdata('pretest_id');
}
?>

<script type="text/javascript">
    var cur = 1;
    $('#soal').on('shown.bs.modal', function () {
        hal(cur);
    });
    var ttl = <?= count($soal) ?>;
    var next = (cur + 1) > ttl ? ttl : (cur + 1);
    var prev = (cur - 1) < 1 ? 1 : (cur - 1);

    function hal(i) {
        $('li#page-' + cur).removeClass('active');
        cur = i;
        $('li#page-' + cur).addClass('active');
        $('#soal').trigger('next.m.' + cur);
        next = (cur + 1) > ttl ? ttl : (cur + 1);
        prev = (cur - 1) < 1 ? 1 : (cur - 1);

        if (i ==<?= $jumlah ?>) {
            $('#finalButton').removeClass('hidden');
        } else {
            $('#finalButton').addClass('hidden');
        }
    }

    function next_m() {
        $('li#page-' + cur).removeClass('active');
        cur = next;
        $('li#page-' + cur).addClass('active');
        $('#soal').trigger('next.m.' + cur);
        next = (cur + 1) > ttl ? ttl : (cur + 1);
        prev = (cur - 1) < 1 ? 1 : (cur - 1);

        if (cur ==<?= $jumlah ?>) {
            $('#finalButton').removeClass('hidden');
        } else {
            $('#finalButton').addClass('hidden');
        }
    }

    function prev_m() {
        $('li#page-' + cur).removeClass('active');
        cur = prev;
        $('li#page-' + cur).addClass('active');
        $('#soal').trigger('next.m.' + cur);
        next = (cur + 1) > ttl ? ttl : (cur + 1);
        prev = (cur - 1) < 1 ? 1 : (cur - 1);

        if (cur ==<?= $jumlah ?>) {
            $('#finalButton').removeClass('hidden');
        } else {
            $('#finalButton').addClass('hidden');
        }
    }

    sendEvent = function (sel, step) {
        $('#soal').trigger('next.m.' + step);
    }

    // Progressbar
    function progress(timeleft, timetotal, $element) {
        // var progressBarWidth = timeleft * $element.width() / timetotal
        var progressBarWidth = timeleft / timetotal * $element.width();
        $element.find('div').animate({width: progressBarWidth}, timeleft == timetotal ? 0 : 1000, 'linear');

        if (timeleft > 0) {
            setTimeout(function () {
                progress(timeleft - 1, timetotal, $element);
            }, 1000);
        }
    };

    // Timer start
    var sisa_waktu = <?= $waktu_quiz ?> - <?= $telah_berlalu ?>;
    $(document).ready(function () {
        if ((<?= $waktu_quiz ?> - <?= $telah_berlalu ?>) < 0 || <?=$status_finish;?>== 1) {
            $("#mulai").removeClass("btn-success").addClass("btn-danger");
            $("#mulai").attr('disabled', 'disabled');
            $("#mulai").html("<i class='glyphicon glyphicon-minus-sign'></i> Waktu Habis");
            $("#soal").remove();
            $("body").addClass("modal-open");
            document.getElementById("timeUp").showModal();
            $("#nilaiContainer").removeClass("hidden").addClass("text-center");
            $("#nilaiContainer span.nilainya").html("<?=$innerHTMLnya?>");
        }
    });
    //fix tekan esc tidak meghilangkan class modal notifikasi
    $(document).keyup(function (e) {
        if (e.keyCode == 27 && <?=$status_finish;?>== 1) {
            $("body").removeClass("modal-open");
        }
    });
    $("#mulai").click(function () {
        <?php
        if($idsiswa != NULL){
        ?>
        var currentURL = 'http://' + window.location.hostname + window.location.pathname;
        var idSubMateri = currentURL.substr(currentURL.lastIndexOf('/') + 1);

        $.ajax({
            url: "<?=base_url();?>konten/start_soal/" + idSubMateri,
            success: function (result) {
                $("#mulai").html("<i class='ti-control-forward'></i> Lanjutkan");
                $("#mulai").removeClass("btn-primary").addClass("btn-success");
            }
        });


        progress(<?= $waktu_sisa ?>, <?= $waktu_quiz ?>, $('#progressBar'));

        <?php //$telah_berlalu ?>
        $("#timer").countdown({
            until: sisa_waktu,
            compact: true,
            format: 'MS',
            onTick: hampirHabis,
            onExpiry: waktuHabis,
            // expiryUrl: ''
        });
        <?php
        }
        ?>

    });

    function hampirHabis(periods) {
        if ($.countdown.periodsToSeconds(periods) <= 60) {
            $(this).css({color: "red"});
        }
    }

    function waktuHabis() {
        document.getElementById("timeUp").showModal();

        window.location.reload(true);
    }


    $("#finalButton").click(function () {
        bootbox.confirm({
            message: "Apakah anda yakin untuk mengakhiri soal?",
            buttons: {
                confirm: {
                    label: '<i class="fa fa-check"></i> Ya, saya yakin',
                    className: 'btn-success'
                },
                cancel: {
                    label: '<i class="fa fa-times"></i> Tidak',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                if (result) {
                    var currentURL = 'http://' + window.location.hostname + window.location.pathname;
                    var idSubMateri = currentURL.substr(currentURL.lastIndexOf('/') + 1);
                    $.ajax({
                        type: 'POST',
                        url: "<?=base_url();?>konten/end_soal/" + idSubMateri + "/",
                        success: function (result) {
                            alert("Anda telah menyelesaikan '"+<?="'".$sub_materi->nama_sub_materi."'"?>+"'");
                            window.location.reload(true);
                        }
                    });
                }
            }
        });
    })


    //SOAL

    $("input[name='jawabSoal']").change(function () {
        var currentURL = 'http://' + window.location.hostname + window.location.pathname;
        var idSubMateri = currentURL.substr(currentURL.lastIndexOf('/') + 1);
        $.ajax({
            type: 'POST',
            url: "<?=base_url();?>konten/submit_jawab/" + idSubMateri + "/" + $(this).attr("soal-no") + "/" + this.value,
            success: function (result) {
                alert(result);
                next_m();
            }
        });
    }); 
</script>
</body>
</html>

<!-- TO-DO -->
<!-- 
	Waktu habis langsung menampilkan nilai
	Jawaban mengubah nilai
 -->
