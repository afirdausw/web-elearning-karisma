<?php
include("header_dashboard.php"); ?>


<div class="breadcrumb-container">
    <ol class="breadcrumb text-center">
        <li><a href="<?php echo base_url("") ?>">Dashboard</a></li>
        <li><a href="<?php echo base_url("agcutest") ?>">AGCU Test</a></li>
        <li class="active"><a href="<?php echo base_url("user/tryout") ?>">Try Out</a></li>
        <!-- sementara -->
        <?php $try = 1; ?>
        <li><a href="<?php echo base_url("user/tryoutsiswa/" . $try); ?>">Analisis Try Out</a></li>
        <li><a href="<?php echo base_url("user/download_konten"); ?>">Download Konten</a></li>
    </ol>
</div>
<?php
$i = 0;
foreach ($daftar_kategori_baru as $kategori) {
    $i++;

    ?>


    <div class="panel-group stat-wrapper container">

        <div class="panel panel-default">
            <div class="panel-heading row">

                <div class="col-md-2 col-sm-2 col-xs-12" data-toggle="collapse" href="#kat_<?php echo $i; ?>"
                     style="cursor:pointer;">
                    <h1><?php echo $kategori['nama_profil']; ?></h1>
                </div>
                <div class="col-md-8 col-sm-8 col-xs-12 text-center" data-toggle="collapse"
                     href="#kat_<?php echo $i; ?>" style="cursor:pointer;">
                    <h1 style="font-weight:normal">
                        Penyelenggara : <?php echo $kategori['penyelenggara']; ?>
                    </h1>
                </div>
                <a href="<?php echo base_url("user/tryoutsiswa/" . $kategori['id_tryout']) ?>">
                    <div class="col-md-2 col-sm-2 col-xs-12 text-center">
                        <h1 style="font-weight:normal;">
                            Lihat Statistik Nilai
                        </h1>
                    </div>
                </a>

            </div>
            <div class="collapse in" id="kat_<?php echo $i; ?>">

                <div class="panel-body">
                    <?php
                    $row = count($kategori['daftar_kategori']);
                    $mod = 0;
                    $col = " ";
                    if ($row % 3 == 2) {
                        $mod = $row % 3;
                        $col = "col-md-6 col-sm-6 col-xs-12";
                    } else if ($row % 2 == 1) {
                        $mod = $row % 2;
                        $col = "col-md-12 col-sm-12 col-xs-12";
                    } else {
                        $col = "col-md-4 col-sm-4 col-xs-12";
                    }
                    $j = 1;
                    if (count($kategori['daftar_kategori']) > 0) {
                        foreach ($kategori['daftar_kategori'] as $dk) {
                            if ($dk['remidi'] == 0) {


                                $jml = $j + $mod;
                                $prosentase = ($dk['jumlah_soal'] == 0 ? 0 : round(($dk['cariskor'] / $dk['jumlah_soal']) * 100, 2));
                                ?>

                                <div class="mapel-container <?php if ($jml >= $row) {
                                    echo $col;
                                } ?>" style="margin:35px 0;padding:0;">

                                    <div class="header"><?php echo $dk['jumlah_soal']; ?> Soal</div>
                                    <div class="content">
                                        <div class="title">
                                            <h5><?php echo $kategori['alias_kelas']; ?></h5>
                                            <h3><?php echo $dk['nama_kategori']; ?></h3>
                                        </div>
                                        <?php
                                        if (($dk['cariskor'] > 0 or $dk['cariskorsalah'] > 0) and $dk['cariwaktu'] > 0) {
                                            ?>
                                            <div class="progress" style="height: 12.5px;">
                                                <div class="progress-bar" role="progressbar"
                                                     aria-valuenow="<?php echo $prosentase; ?>"
                                                     aria-valuemin="0" aria-valuemax="100"
                                                     style="width: <?php echo $prosentase; ?>%;">
                                                    <span class="sr-only"><?php echo $prosentase; ?>% Complete</span>
                                                </div>
                                            </div>

                                            <!-- soal benar persen tuntas -->
                                            <?php
                                            if ($dk['cariskor'] > 0 and $dk['cariwaktu'] > 0) {
                                                echo "<h4 class=\"pull-left\"><span style=\"color:red;\">" . $prosentase . "%</span> Tuntas</h4>
												<h6 class=\"pull-right\"><span style=\"color:red;\">" . ($dk['jumlah_soal'] == 0 ? 0 : ($dk['cariskor'] . "</span>
													/" . $dk['jumlah_soal'])) . " Soal yang benar</h6>
												";
                                            } elseif ($dk['cariskor'] == 0 and $dk['cariskorsalah'] > 0 and $dk['cariwaktu'] > 0) {
                                                echo "
												<h4 class=\"pull-left\"><span style=\"color:red;\">0%</span> progress</h4>
												<h6 class=\"pull-right\"><span style=\"color:red;\">0</span>/" . $dk['jumlah_soal'] . " Soal yang benar</h6>
												";
                                            } elseif ($dk['cariskor'] > 0 and $dk['cariwaktu'] == 0) {
                                                echo "
												<h4 class=\"pull-left\"><span style=\"color:red;\">0%</span> progress</h4>
												<h6 class=\"pull-right\"><span style=\"color:red;\">0</span>/" . $dk['jumlah_soal'] . " Soal yang benar</h6>
												";
                                            } elseif ($dk['cariskor'] == 0 and $dk['cariwaktu'] == 0) {
                                                echo "
												<h4 class=\"pull-left\"><span style=\"color:red;\">0%</span> progress</h4>
												<h6 class=\"pull-right\"><span style=\"color:red;\">0</span>/" . $dk['jumlah_soal'] . " Soal yang benar</h6>
												";
                                            } else {
                                                echo "
												<h4 class=\"pull-left\"><span style=\"color:red;\">0%</span> progress</h4>
												<h6 class=\"pull-right\"><span style=\"color:red;\">0</span>/" . $dk['jumlah_soal'] . " Soal yang benar</h6>
												";
                                            }
                                            ?>
                                            <div class="clearfix"></div>
                                            <div style="margin:20px 0 10px;" class="row text-center">
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <a href="../tryout/openclass/<?php echo $dk['id_kategori']; ?>"
                                                       target="_blank" class="btn btn-primary">Open Class</a>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <a href="../tryout/pembahasan/<?php echo $dk['id_kategori']; ?>"
                                                       target="_blank" class="btn btn-success"
                                                       type="submit">Pembahasan</a>
                                                </div>
                                            </div>

                                            <?php
                                        } elseif (($dk['cariskor'] > 0 or $dk['cariskorsalah'] > 0) and $dk['cariwaktu'] == 0) {
                                            ?>
                                            <div class="progress" style="height: 12.5px;">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="0"
                                                     aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                                                    <span class="sr-only">0% Complete</span>
                                                </div>
                                            </div>
                                            <a href="../tryout/mulai/<?php echo $dk['id_kategori']; ?>"
                                               target="_blank" class="btn btn-default  btn-turquoise text-center"
                                               type="submit" style="margin: 15px 0;">Lanjut
                                                Mengerjakan</a>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="progress" style="height: 12.5px;">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="0"
                                                     aria-valuemin="0"
                                                     aria-valuemax="100" style="width: 0%;">
                                                    <span class="sr-only">0% Complete</span>
                                                </div>
                                            </div>

                                            <?php
                                            if (isset($dk['kategori_status'])) { ?>
                                                <?php
                                            } else { ?>
                                                <a href="../tryout/mulai/<?php echo $dk['id_kategori']; ?>"
                                                   target="_blank" class="btn btn-default btn-turquoise text-center"
                                                   type="submit"
                                                   style="margin: 15px 0;">Mulai </a>
                                                <?php

                                            }

                                        }
                                        ?>


                                    </div>
                                </div>
                                <?php
                                
                                if(!$dk['tuntas'] && count($dk['analisa'])>0 && count($dk['profil_remidi'])) {
                                    foreach ($dk['profil_remidi'] as $key_rem => $rem) {
                                        $jml = $j + $mod;
                                        $prosentase = ($dk['jumlah_soal'] == 0 ? 0 : round(($dk['cariskor'] / $dk['jumlah_soal']) * 100, 2));

                                        ?>

                                    <div class="mapel-container <?php if ($jml >= $row) {
                                        echo $col;
                                    } ?>" style="margin:35px 0;padding:0;">

                                        <div class="header"><?php echo $rem['jumlah_soal']; ?> Soal</div>
                                        <div class="content">
                                            <div class="title">
                                                <h5><?php echo $kategori['alias_kelas']; ?></h5>
                                                <h3><?php echo $rem['nama_kategori']; ?></h3>
                                            </div>
                                            <?php
                                            if (($rem['cariskor'] > 0 or $rem['cariskorsalah'] > 0) and $rem['cariwaktu'] > 0) {
                                                ?>
                                                <div class="progress" style="height: 12.5px;">
                                                    <div class="progress-bar" role="progressbar"
                                                         aria-valuenow="<?php echo $prosentase; ?>"
                                                         aria-valuemin="0" aria-valuemax="100"
                                                         style="width: <?php echo $prosentase; ?>%;">
                                                        <span class="sr-only"><?php echo $prosentase; ?>
                                                            % Complete</span>
                                                    </div>
                                                </div>

                                                <!-- soal benar persen tuntas -->
                                                <?php
                                                if ($rem['cariskor'] > 0 and $rem['cariwaktu'] > 0) {
                                                    echo "<h4 class=\"pull-left\"><span style=\"color:red;\">" . $prosentase . "%</span> Tuntas</h4>
												<h6 class=\"pull-right\"><span style=\"color:red;\">" . ($rem['jumlah_soal'] == 0 ? 0 : ($rem['cariskor'] . "</span>
													/" . $rem['jumlah_soal'])) . " Soal yang benar</h6>
												";
                                                } elseif ($rem['cariskor'] == 0 and $rem['cariskorsalah'] > 0 and $rem['cariwaktu'] > 0) {
                                                    echo "
												<h4 class=\"pull-left\"><span style=\"color:red;\">0%</span> progress</h4>
												<h6 class=\"pull-right\"><span style=\"color:red;\">0</span>/" . $rem['jumlah_soal'] . " Soal yang benar</h6>
												";
                                                } elseif ($rem['cariskor'] > 0 and $rem['cariwaktu'] == 0) {
                                                    echo "
												<h4 class=\"pull-left\"><span style=\"color:red;\">0%</span> progress</h4>
												<h6 class=\"pull-right\"><span style=\"color:red;\">0</span>/" . $rem['jumlah_soal'] . " Soal yang benar</h6>
												";
                                                } elseif ($rem['cariskor'] == 0 and $rem['cariwaktu'] == 0) {
                                                    echo "
												<h4 class=\"pull-left\"><span style=\"color:red;\">0%</span> progress</h4>
												<h6 class=\"pull-right\"><span style=\"color:red;\">0</span>/" . $rem['jumlah_soal'] . " Soal yang benar</h6>
												";
                                                } else {
                                                    echo "
												<h4 class=\"pull-left\"><span style=\"color:red;\">0%</span> progress</h4>
												<h6 class=\"pull-right\"><span style=\"color:red;\">0</span>/" . $rem['jumlah_soal'] . " Soal yang benar</h6>
												";
                                                }
                                                ?>
                                                <div class="clearfix"></div>
                                                <div style="margin:20px 0 10px;" class="row text-center">
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <a href="../tryout/openclass/<?php echo $rem['id_kategori']; ?>"
                                                           target="_blank" class="btn btn-primary">Open Class</a>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <a href="../tryout/pembahasan/<?php echo $rem['id_kategori']; ?>"
                                                           target="_blank" class="btn btn-success"
                                                           type="submit">Pembahasan</a>
                                                    </div>
                                                </div>

                                                <?php
                                            } elseif (($rem['cariskor'] > 0 or $rem['cariskorsalah'] > 0) and $rem['cariwaktu'] == 0) {
                                                ?>
                                                <div class="progress" style="height: 12.5px;">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="0"
                                                         aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                                                        <span class="sr-only">0% Complete</span>
                                                    </div>
                                                </div>
                                                <a href="../tryout/mulai/<?php echo $rem['id_kategori']; ?>"
                                                   target="_blank" class="btn btn-default  btn-turquoise text-center"
                                                   type="submit" style="margin: 15px 0;">Lanjut
                                                    Mengerjakan</a>
                                                <?php
                                            } else {
                                                ?>
                                                <div class="progress" style="height: 12.5px;">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="0"
                                                         aria-valuemin="0"
                                                         aria-valuemax="100" style="width: 0%;">
                                                        <span class="sr-only">0% Complete</span>
                                                    </div>
                                                </div>

                                                <?php
                                                if (isset($rem['kategori_status'])) { ?>
                                                    <?php
                                                } else { ?>
                                                    <a href="../tryout/mulai/<?php echo $rem['id_kategori']; ?>"
                                                       target="_blank" class="btn btn-default btn-turquoise text-center"
                                                       type="submit"
                                                       style="margin: 15px 0;">Mulai </a>
                                                    <?php

                                                }

                                            }
                                            ?>


                                        </div>
                                        </div><?php
                                    }
                                }
                            }

                            $j++;
                        }
                    } ?>
                </div>

                <div class="clearfix"></div>

                <div class="panel-footer"></div>

            </div> <!-- PENUTUP COLLAPSE -->
        </div>
    </div> <!-- PANEL GROUP -->
    <?php
}

include('modal_profil.php');


include('footer.php');
?>

<script src="<?php echo base_url('assets/dashboard/js/jquery1.11.0.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/dashboard/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/dashboard/js/init.js'); ?>"></script>
<script src="<?php echo base_url('assets/dashboard/js/jquery.matchHeight.js'); ?>"></script>


<script type="text/javascript" charset="utf-8">
    $(function () {
        $('.mapel-container .content .title h3').matchHeight();
        $('.content').matchHeight();
        $('.panel-group.stat-wrapper .panel-heading div[class*="col"]').matchHeight();
    });
</script>

</body>
</html>