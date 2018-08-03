<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Analisis extends CI_Controller {


    public function __construct()
    {
        parent::__construct();

        //check user session

        //load library in construct. Construct method will be run everytime the controller is called
        //This library will be auto-loaded in every method in this controller.
        //So there will be no need to call the library again in each method.
        $this->load->library('form_validation');
        $this->load->helper('alert_helper');
        $this->load->model('model_adm');
        $this->load->model('model_psep');
        $this->load->model('model_dashboard');
        $this->load->model('model_agcu');
        $this->load->model('model_lstest');
        $this->load->model('model_pg');
        $this->load->model('model_security');
        $this->model_security->is_logged_in();
    }



    function index(){

        $data = array(
            'navbar_title' 	=> "Analisis Siswa",
            'active'		=> "analisis",
            'select_provinsi' => $this->model_pg->fetch_all_provinsi(),
            'select_kota'     => $this->model_pg->fetch_all_kota(),
            'select_sekolah'  => $this->model_pg->fetch_all_sekolah(),
            'select_kelas'    => $this->model_pg->fetch_all_kelas(),
            'select_jenjang'  => $this->model_pg->fetch_options_jenjang(),
        );

        $this->load->view('pg_admin/analisis_sekolah', $data);

    }






    //sansan code
    function index_old()
    {
// 		if ($this->uri->segment(3) == "") {
// 			redirect('user/dashboard');
// 		} else {
// 			$idtryout = $this->uri->segment(3);
// 			$id_siswa = isset($_SESSION['id_siswa']) ? $_SESSION['id_siswa'] : 0;
// 			if (empty($this->session->userdata('akses'))) {
// 				$datapembelian = $this->model_pembayaran->get_tagihan_by_siswa($id_siswa);
// 				if (empty($datapembelian)) {
// 					redirect("user/aktivasi");
// 				} else {
// 					redirect("user/buylist");
// 				}
// 			}
// 		}

        $idsiswa = $this->session->userdata('id_siswa');
        $session = $this->session->userdata;
        //$this->model_security->psep_sekolah_is_logged_in();
        // 	$data = array(
        // 		'infoortu'	=> $this->model_parent->get_parent($_SESSION['id_ortu'])
        // 	);
        //$this->load->view('pg_ortu/pilih_tryout', $data);
        $data = array(
            'infosiswa'         => $this->model_dashboard->get_info_siswa($this->session->userdata('id_siswa')),
            'navbar_links'      => $this->model_pg->get_navbar_links(),
            'data_user'         => $this->model_pg->get_data_user($this->session->userdata('id_siswa')),
            //'profil_tryout'     => $this->model_adm->fetch_all_profil_by_id($idtryout),
            //'profil_tryout_all' => $this->model_adm->fetch_all_profil_by_kelas($session['kelas']),
            //'dataperingkat'     => $this->model_dashboard->peringkat($idtryout),
        );
        //$table_data = $data['profil_tryout'];

        $daftar_kategori_baru = [];
        $i = 0;
        $totalsoal = 0;
        $totalbenar = 0;
        //foreach ($table_data as $kat) {
        //	$daftar_kategori = $this->model_fronttryout->fetch_kategori($kat->id_tryout);
        //$daftar_kategori_baru[$i] = json_decode(json_encode($kat), True);
        $j = 0;
        $index = 0;
        if (count($daftar_kategori) > 0) {
            foreach ($daftar_kategori as $subkey => $value) {
                if ($value->id_profil == $kat->id_tryout) {
                    $cariskor = $this->model_dashboard->cari_skor($value->id_kategori, $idsiswa);
                    $cariskorsalah = $this->model_dashboard->cari_skor_salah($value->id_kategori, $idsiswa);
                    $cariwaktu = $this->model_dashboard->cari_waktu($value->id_kategori, $idsiswa);
                    $daftar_kategori_baru[$i]['daftar_kategori'][$j] = json_decode(json_encode($value), True);
                    $daftar_kategori_baru[$i]['daftar_kategori'][$j]['cariskor'] = $cariskor;
                    $daftar_kategori_baru[$i]['daftar_kategori'][$j]['cariskorsalah'] = $cariskorsalah;
                    $daftar_kategori_baru[$i]['daftar_kategori'][$j]['cariwaktu'] = $cariwaktu;
                    $totalsoal+= $daftar_kategori_baru[$i]['daftar_kategori'][$j]['jumlah_soal'];
                    $totalbenar+= $cariskor;
                    $daftar_kategori_baru[$i]['daftar_kategori'][$j]['analisawaktu'] = json_decode(json_encode($this->model_dashboard->analisis_waktu($value->id_kategori, $idsiswa)), True);
                    $daftar_kategori_baru[$i]['daftar_kategori'][$j]['analisistopik'] = json_decode(json_encode($this->model_dashboard->analisistopik($value->id_kategori, $idsiswa)), True);
                    $analisa_topik = json_decode(json_encode($this->model_dashboard->analisatopik($value->id_kategori, $idsiswa)), True);
                    $k = 0;
                    foreach ($analisa_topik as $at) {
                        if ($at['id_analisis_topik'] != null) {
                            $at['jml_benar'] = $this->model_dashboard->analisatopikbenar($value->id_kategori, $idsiswa);
                            $daftar_kategori_baru[$i]['daftar_kategori'][$j]['analisa_topik'][$k] = $at;
                            $daftar_kategori_baru[$i]['daftar_kategori'][$j]['analisa_topik'][$k]['total'] = $this->model_dashboard->jumlahtopik($value->id_kategori, $idsiswa, $at['topik']);
                            $daftar_kategori_baru[$i]['daftar_kategori'][$j]['analisa_topik'][$k]['presentase'] = ($at['jml_benar'] == 0 ? 0 : ($at['jml_benar'] / $this->model_dashboard->jumlahtopik($value->id_kategori, $idsiswa, $at['topik'])) * 100);
                        } else {
                            $daftar_kategori_baru[$i]['daftar_kategori'][$j][$k]['analisa_topik'] = null;
                        }
                        $k++;
                    }
                    //unset($daftar_kategori[$index]);
                    $j++;
                }
                if ($j == 0) {
                    //$daftar_kategori_baru[$i]['daftar_kategori'] = null;
                }
            }
            $index++;
        } else {
            //$daftar_kategori_baru[$i]['daftar_kategori'] = null;
        }
        //	$i++;
        //}
        //$data['daftar_kategori_baru'] = $daftar_kategori_baru;
        //$data['daftar_kategori_baru']['totalsoal'] = $totalsoal;
        //$data['daftar_kategori_baru']['totalbenar'] = $totalbenar;

//            return $this->output
//                ->set_content_type('application/json')
//                ->set_status_header(500)
//                ->set_output(json_encode($data));
        $this->load->view('pg_admin/tryout-statistik', $data);

    }



    public function report_siswa(){
        $idpsep = $this->session->userdata('idpsepsekolah');

        $carisekolah = $this->model_psep->cari_sekolah_by_login($idpsep);

        $data = array(
            'navbar_title' 	=> "Academic General Check Up",
            'active'		=> "agcu",
            'datakelas'		=> $this->model_psep->cari_kelas_by_jenjang($carisekolah->jenjang)
        );

        $this->load->view('pg_admin/report_siswa', $data);
    }

    function ajax_siswa_by_jenjang($sekolah){

        $carisiswa = $this->model_psep->cari_siswa_by_kelas($sekolah);

        $no = 1;
        foreach($carisiswa as $siswa){
            ?>
            <tr>
                <td><?php echo $no;?></td>
                <td><?php echo $siswa->nama_siswa;?></td>
                <td><?php echo $siswa->alias_kelas;?></td>
                <td><a href="<?php echo base_url("psep_sekolah/agcu/siswa/".$siswa->id_siswa);?>">Analisis Siswa</a></td>
            </tr>
            <?php
            $no++;
        }
    }

    function siswa($idsiswa){

        $infosiswa = $this->model_dashboard->get_info_siswa($idsiswa);
        $carikelas = $this->model_dashboard->get_kelas($idsiswa);
        $kelas = $carikelas->kelas;

        $kategoridiagnostic = $this->model_agcu->get_diagnosticbykelas($kelas);
        $datasoal = $this->model_agcu->get_jumlahsoal();

        $jumlahbenar = $this->model_agcu->get_jumlah_benar($idsiswa);

        $jumlahhasil = $this->model_agcu->get_jumlah_hasil();
        $jumlahbenarhasil = $this->model_agcu->get_jumlah_benar_hasil();

        $analisistopik = $this->model_agcu->get_analisis_topik($idsiswa);


        $skor = $this->model_lstest->skor($idsiswa);
        $hasildiagnostic = $this->model_agcu->get_ordered_hasildiagnostic();
        $peringkatsiswa = $this->model_agcu->get_peringkatsiswabykelas($kelas);

        foreach($skor as $dataskor){
            $hasil[$dataskor->no] = $dataskor->skor;
        }

        $v1 = $hasil[11] + $hasil[12] + $hasil[13] + $hasil[14] + $hasil[15] + $hasil[16] + $hasil[17] + $hasil[18] + $hasil[19] + $hasil[20];

        $a1 = $hasil[21] + $hasil[22] + $hasil[23] + $hasil[24] + $hasil[25] + $hasil[26] + $hasil[27] + $hasil[28] + $hasil[29] + $hasil[30] + $hasil[31];

        $k1 = $hasil[21] + $hasil[22] + $hasil[23] + $hasil[24] + $hasil[25] + $hasil[26] + $hasil[27] + $hasil[28] + $hasil[29] + $hasil[30] + $hasil[31];

        $no = 1;
        for($i=1; $i<=50; $i++){
            if($hasil[$no] == "V"){
                if(!isset($v2)){
                    $v2 = 1;
                }else{
                    $v2 += 1;
                }
            }
            $no++;
        }

        $x = 1;
        for($i=1; $i<=50; $i++){
            if($hasil[$x] == "A"){
                if(!isset($a2)){
                    $a2 = 1;
                }else{
                    $a2 += 1;
                }
            }
            $x++;
        }

        $y = 1;
        for($i=1; $i<=50; $i++){
            if($hasil[$y] == "K"){
                if(!isset($k2)){
                    $k2 = 1;
                }else{
                    $k2 += 1;
                }
            }
            $y++;
        }

        $totalv = $v1 + $v2;
        $totala = $a1 + $a2;
        $totalk = $k1 + $k2;

        $karakteristikv = '';
        $karakteristika = '';
        $karakteristikk = '';


        if($totalv > $totala and $totalv > $totalk){
            $dominasi = "V";
            $karakteristik = 'Rapi dan teratur - Berbicara dengan cepat - Mampu membuat rencana dan mengatur jangka panjang dengan baik - Teliti dan rinci - Mementingkan penampilan - Lebih mudah mengingat apa yang dilihat daripada apa yang didengar - Mengingat sesuatu berdasarkan asosiasi visual - Memiliki kemampuan mengeja huruf dengan sangat baik - Biasanya tidak mudah terganggu oleh keributan atau suara berisik ketika sedang belajar - Sulit menerima instruksi verbal (oleh karena itu seringkali ia minta instruksi secara tertulis) - Merupakan pembaca yang cepat dan tekun - Lebih suka membaca daripada dibacakan - Dalam memberikan respon terhadap segala sesuatu, ia selalu bersikap waspada, membutuhkan penjelasan menyeluruh tentang tujuan dan berbagai hal lain yang berkaitan - Jika sedang berbicara di telpon ia suka membuat coretan - coretan tanpa arti selama berbicara - Lupa menyampaikan pesan verbal kepada orang lain - Sering menjawab pertanyaan dengan jawaban singkat " ya" atau "tidak” - Lebih suka mendemonstrasikan sesuatu daripada berpidato/ berceramah - Lebih tertarik pada bidang seni (lukis, pahat, gambar) dari pada musik - Sering kali mengetahui apa yang harus dikatakan, tetapi tidak pandai menulis kandalam kata - kata - Kadang-kadang kehilangan konsentrasi ketika mereka ingin memperhatikan';

            $saran = 'Buatlah Peta Konsep pelajaran dengan mulai dari tema besar di tengah halaman, menggunakan kata - kata penting, menggunakan simbol, warna, kata, gambar yang mencolok dan lakukan ini dengan gayamu sendiri - Dalam mencatat pelajaran, gunakan tanda - tanda, gambar dan warna untuk menandai hal - hal penting agar dapat dengan mudah dilihat lagi jika akan mempelajarinya dilain waktu - Untuk membantu mengingat apa yang baru dibaca dan didengar , duduklah dengan santai dan bayangkan dalam pikiran apa yang baru dibaca/didengar';
        }elseif($totala > $totalv and $totala > $totalk){
            $dominasi = "A";
            $karakteristik = 'Sering berbicara sendiri ketika sedang bekerja (belajar) - Mudah terganggu oleh keributan atau suara berisik - Menggerakan bibir dan menguc apkan tulisan di buku ketika membaca - Lebih senang mendengarkan (dibacakan) daripada membaca - Jika membaca maka lebih senang membaca dengan suara keras - Dapat mengulangi atau menirukan nada, irama dan warna suara - Mengalami kesulitan untuk menuliskan s esuatu, tetapi sangat pandai dalam bercerita - Berbicara dalam irama yang terpola dengan baik - berbicara dengan sangat fasih - Lebih menyukai seni musik dibandingkan seni yang lainnya - Belajar dengan mendengarkan dan mengingat apa yang didiskusikan darip ada apa yang dilihat - Senang berbicara, berdiskusi dan menjelaskan sesuatu secara panjang lebar - Mengalami kesulitan jika harus dihadapkan pada tugas - tugas yang berhubungan dengan visualisasi - Lebih pandai mengeja atau mengucapkan kata - kata dengan keras daripada menuliskannya - Lebih suka humor atau gurauan lisan daripada membaca buku humor/komik';

            $saran = 'Bacalah pelajaran dengan cara baca yang dramatis - Cobalah menyanyikannya dengan irama iklan atau musik - Merangkum pelajaran dengan diucapkan lantang atau direkam dalam kaset / CD dan didengarkan menggunakan walkman saat ke sekolah -  Saat membaca dengan lantang, perhatikan intonasi, penekanan khusus, cobalah berbisik dan cobalah untuk memejamkan mata untuk belajar membayangkan apa yang dibaca';
        }elseif($totalk > $totalv and $totalk > $totala){
            $dominasi = "K";
            $karakteristik = 'Berbicara dengan perlahan - Menanggapi perhatian fisik - Menyentuh orang lain untuk mendapatkan perhatian mereka - Berdiri dekat ketika sedang berbicara dengan orang lain - Banyak gerak fisik -  Memiliki perkembangan awal otot-otot yang besar - Belajar melalui praktek langsung atau manipulasi - Menghafalkan sesuatu dengan cara berjalan atau melihat langsung - Menggunakan jari untuk menunjukka apa yang dibaca ketika sedang membaca - Banyak menggunakan bahasa tubuh (non verbal) - Tidak dapat duduk diam di suatu tempat untuk waktu yang lama - Sulit membaca peta kecuali ia memang pernah ke tempat tersebut - Menggunakan ka ta - kata yang mengandung aksi - Pada umumnya tulisannya jelek - Menyukai kegiatan atau permainan yang menyibukkan (secara fisik) - Ingin melakukan segala sesuatu';

            $saran = 'Cobalah belajar dalam kelompok untuk membentuk suasana bermain peran dari pelajaran yang dibahas - Tulislah poin - poin penting dari pelajaran dalam bentuk kartu - kartu yang disusun secara logis -  Buatlah semacam percobaan atau model dari apa yang sedang kamu pelajari - Libatkan tubuh dalam belajar dengan mencoba meniru apa yang dipelajari dengan gaya guru saat menyampaikan materi - Setiap kali membaca atau mendengarkan seseorang berbicara, bangkitlah untuk sedikit bergerak setiap 15 - 20 menit sekali';
        }elseif($totalv == $totala and $totalv > $totalk){
            $dominasi = "VA";
            $karakteristik = 'Rapi dan teratur - Berbicara dengan c epat - Mampu membuat rencana dan mengatur jangka panjang dengan baik - Teliti dan rinci - Mementingkan penampilan - Lebih mudah mengingat apa yang dilihat daripada apa yang didengar - Mengingat sesuatu berdasarkan asosiasi visual - Memiliki kemampuan menge ja huruf dengan sangat baik - Biasanya tidak mudah terganggu oleh keributan atau suara berisik ketika sedang belajar - Sulit menerima instruksi verbal (oleh karena itu seringkali ia minta instruksi secara tertulis) - Merupakan pembaca yang cepat dan tekun - Lebih suka membaca daripada dibacakan - Dalam memberikan respon terhadap segala sesuatu, ia selalu bersikap waspada , membutuhkan penjelasan menyeluruh tentang tujuan dan berbagai hal lain yang berkaitan - Jika sedang berbicara di telpon ia suka membuat c oretan - coretan tanpa arti selama berbicara - Lupa menyampaikan pesan verbal kepada orang lain - Sering menjawab pertanyaan dengan jawaban singkat "ya" atau "tidak” - Lebih suka mendemonstrasikan sesuatu daripada berpidato/ berceramah - Lebih tertarik pada bidang seni (lukis, pahat, gambar) dari pada musik - Sering kali menegtahui apa yang harus dikatakan, tetapi tidak pandai menuliskan dalam kata - kata - Kadang - kadang kehilangan konsentrasi ketika mereka ingin memperhatikan - Sering berbicara sendiri ketika sedang bekerja (belajar) - Mudah terganggu oleh keributan atau suara berisik - Menggerakan bibir dan mengucapkan tulisan di buku ketika membaca - Lebih senang mendengarkan (dibacakan) daripada membaca - Jika membaca maka lebih senang membaca dengan suara k eras - Dapat mengulangi atau menirukan nada, irama dan warna suara - Mengalami kesulitan untuk menuliskan sesuatu, tetapi sangat pandai dalam bercerita - Berbicara dalam irama yang terpola dengan baik - berbicara dengan sangat fasih - Lebih menyukai seni m usik dibandingkan seni yang lainnya - Belajar dengan mendengarkan dan mengingat apa yang didiskusikan daripada apa yang dilihat - Senang berbicara, berdiskusi dan menjelaskan sesuatu secara panjang lebar - Mengalami kesulitan jika harus dihadapkan pada tug as - tugas yang berhubungan dengan visualisasi - Lebih pandai mengeja atau mengucapkan kata - kata dengan keras daripada menuliskannya - Lebih suka humor atau gurauan lisan daripada membaca buku humor/komik.';

            $saran = 'Buatlah Peta Konsep pelajaran dengan mulai dari tema besar di tengah halaman, menggunakan kata - kata penting, menggunakan simbol, warna, kata, gambar yang mencolok dan lakukan ini dengan gayamu sendiri - Dalam mencatat pelajaran, gunakan tanda - tanda, gambar dan warna untuk menandai hal - hal penting agar dapat dengan mudah dilihat lagi jika akan mempelajarinya dilain waktu - Untuk membantu mengingat apa yang baru dibaca dan didengar , duduklah dengan santai dan bayangkan dalam pikiran apa yang baru dibaca/didengar - Bacalah pelajaran dengan cara baca yang dramatis - Cobalah menyanyikannya dengan irama iklan atau musik - Merangkum pelajaran dengan diucapkan lantang atau direkam dalam kaset / CD dan didengarkan menggunakan walkman saat ke sekolah -  Saat membaca dengan lantang, perhatikan intonasi, penekanan khusus, cobalah berbisik dan cobalah untuk memejamkan mata untuk belajar membayangkan apa yang dibaca';
        }elseif($totalv == $totalk and $totalv > $totala){
            $dominasi = "VK";
            $karakteristik = 'Rapi dan teratur - Berbicara dengan cepat - Mampu membuat rencana dan mengatur jangka panjang dengan baik - Teliti dan rinci - Mementingkan penampilan - Lebih mudah mengingat apa yang dilihat daripada apa yang didengar - Mengingat sesuatu berdasarkan asosiasi visual - Memiliki kemampuan mengeja huruf dengan sangat baik - Biasanya tidak mudah terganggu oleh keributan atau suara berisik ketika sedang belajar - Sulit menerima instruksi verbal (oleh karena itu seringkali ia minta instruksi secara tertulis) - Merupakan pembaca yang cepat dan tekun - Lebih suka membaca daripada dibacakan - Dalam memberikan respon terhadap segala sesuatu, ia selalu bersikap waspada, membutuhkan penjelasan menyeluruh tentang tujuan dan berbagai hal lain yang berkaitan - Jika sedang berbicara di telpon ia suka membuat coretan - coretan tanpa arti selama berbicara - Lupa menyampaikan pesan verbal kepada orang lain - Sering menjawab pertanyaan dengan jawaban singkat " ya" atau "tidak” - Lebih suka mendemonstrasikan sesuatu daripada berpidato/ berceramah - Lebih tertarik pada bidang seni (lukis, pahat, gambar) dari pada musik - Sering kali mengetahui apa yang harus dikatakan, tetapi tidak pandai menulis kandalam kata - kata - Kadang-kadang kehilangan konsentrasi ketika mereka ingin memperhatikan - Berbicara dengan perlahan - Menanggapi perhatian fisik - Menyentuh orang lain untuk mendapatkan perhatian mereka - Berdiri dekat ketika sedang berbicara dengan orang lain - Banyak gerak fisik -  Memiliki perkembangan awal otot-otot yang besar - Belajar melalui praktek langsung atau manipulasi - Menghafalkan sesuatu dengan cara berjalan atau melihat langsung - Menggunakan jari untuk menunjukka apa yang dibaca ketika sedang membaca - Banyak menggunakan bahasa tubuh (non verbal) - Tidak dapat duduk diam di suatu tempat untuk waktu yang lama - Sulit membaca peta kecuali ia memang pernah ke tempat tersebut - Menggunakan ka ta - kata yang mengandung aksi - Pada umumnya tulisannya jelek - Menyukai kegiatan atau permainan yang menyibukkan (secara fisik) - Ingin melakukan segala sesuatu';

            $saran = 'Buatlah Peta Konsep pelajaran dengan mulai dari tema besar di tengah halaman, menggunakan kata - kata penting, menggunakan simbol, warna, kata, gambar yang mencolok dan lakukan ini dengan gayamu sendiri - Dalam mencatat pelajaran, gunakan tanda - tanda, gambar dan warna untuk menandai hal - hal penting agar dapat dengan mudah dilihat lagi jika akan mempelajarinya dilain waktu - Untuk membantu mengingat apa yang baru dibaca dan didengar , duduklah dengan santai dan bayangkan dalam pikiran apa yang baru dibaca/didengar - Cobalah belajar dalam kelompok untuk membentuk suasana bermain peran dari pelajaran yang dibahas - Tulislah poin - poin penting dari pelajaran dalam bentuk kartu - kartu yang disusun secara logis -  Buatlah semacam percobaan atau model dari apa yang sedang kamu pelajari - Libatkan tubuh dalam belajar dengan mencoba meniru apa yang dipelajari dengan gaya guru saat menyampaikan materi - Setiap kali membaca atau mendengarkan seseorang berbicara, bangkitlah untuk sedikit bergerak setiap 15 - 20 menit sekali';
        }elseif($totala == $totalk and $totala > $totalv){
            $dominasi = "AK";
            $karakteristik = 'Sering berbicara sendiri ketika sedang bekerja (belajar) - Mudah terganggu oleh keributan atau suara berisik - Menggerakan bibir dan menguc apkan tulisan di buku ketika membaca - Lebih senang mendengarkan (dibacakan) daripada membaca - Jika membaca maka lebih senang membaca dengan suara keras - Dapat mengulangi atau menirukan nada, irama dan warna suara - Mengalami kesulitan untuk menuliskan s esuatu, tetapi sangat pandai dalam bercerita - Berbicara dalam irama yang terpola dengan baik - berbicara dengan sangat fasih - Lebih menyukai seni musik dibandingkan seni yang lainnya - Belajar dengan mendengarkan dan mengingat apa yang didiskusikan darip ada apa yang dilihat - Senang berbicara, berdiskusi dan menjelaskan sesuatu secara panjang lebar - Mengalami kesulitan jika harus dihadapkan pada tugas - tugas yang berhubungan dengan visualisasi - Lebih pandai mengeja atau mengucapkan kata - kata dengan keras daripada menuliskannya - Lebih suka humor atau gurauan lisan daripada membaca buku humor/komik - Berbicara dengan perlahan - Menanggapi perhatian fisik - Menyentuh orang lain untuk mendapatkan perhatian mereka - Berdiri dekat ketika sedang berbicara dengan orang lain - Banyak gerak fisik -  Memiliki perkembangan awal otot-otot yang besar - Belajar melalui praktek langsung atau manipulasi - Menghafalkan sesuatu dengan cara berjalan atau melihat langsung - Menggunakan jari untuk menunjukka apa yang dibaca ketika sedang membaca - Banyak menggunakan bahasa tubuh (non verbal) - Tidak dapat duduk diam di suatu tempat untuk waktu yang lama - Sulit membaca peta kecuali ia memang pernah ke tempat tersebut - Menggunakan ka ta - kata yang mengandung aksi - Pada umumnya tulisannya jelek - Menyukai kegiatan atau permainan yang menyibukkan (secara fisik) - Ingin melakukan segala sesuatu';

            $saran = 'Bacalah pelajaran dengan cara baca yang dramatis - Cobalah menyanyikannya dengan irama iklan atau musik - Merangkum pelajaran dengan diucapkan lantang atau direkam dalam kaset / CD dan didengarkan menggunakan walkman saat ke sekolah -  Saat membaca dengan lantang, perhatikan intonasi, penekanan khusus, cobalah berbisik dan cobalah untuk memejamkan mata untuk belajar membayangkan apa yang dibaca - Cobalah belajar dalam kelompok untuk membentuk suasana bermain peran dari pelajaran yang dibahas - Tulislah poin - poin penting dari pelajaran dalam bentuk kartu - kartu yang disusun secara logis -  Buatlah semacam percobaan atau model dari apa yang sedang kamu pelajari - Libatkan tubuh dalam belajar dengan mencoba meniru apa yang dipelajari dengan gaya guru saat menyampaikan materi - Setiap kali membaca atau mendengarkan seseorang berbicara, bangkitlah untuk sedikit bergerak setiap 15 - 20 menit sekali';
        }elseif($totalv == $totala and $totalv == $totalk){
            $dominasi = "VAK";
            $karakteristik = 'Rapi dan teratur - Berbicara dengan c epat - Mampu membuat rencana dan mengatur jangka panjang dengan baik - Teliti dan rinci - Mementingkan penampilan - Lebih mudah mengingat apa yang dilihat daripada apa yang didengar - Mengingat sesuatu berdasarkan asosiasi visual - Memiliki kemampuan menge ja huruf dengan sangat baik - Biasanya tidak mudah terganggu oleh keributan atau suara berisik ketika sedang belajar - Sulit menerima instruksi verbal (oleh karena itu seringkali ia minta instruksi secara tertulis) - Merupakan pembaca yang cepat dan tekun - Lebih suka membaca daripada dibacakan - Dalam memberikan respon terhadap segala sesuatu, ia selalu bersikap waspada , membutuhkan penjelasan menyeluruh tentang tujuan dan berbagai hal lain yang berkaitan - Jika sedang berbicara di telpon ia suka membuat c oretan - coretan tanpa arti selama berbicara - Lupa menyampaikan pesan verbal kepada orang lain - Sering menjawab pertanyaan dengan jawaban singkat "ya" atau "tidak” - Lebih suka mendemonstrasikan sesuatu daripada berpidato/ berceramah - Lebih tertarik pada bidang seni (lukis, pahat, gambar) dari pada musik - Sering kali menegtahui apa yang harus dikatakan, tetapi tidak pandai menuliskan dalam kata - kata - Kadang - kadang kehilangan konsentrasi ketika mereka ingin memperhatikan<br>
		Sering berbicara sendiri ketika sedang bekerja (belajar) - Mudah terganggu oleh keributan atau suara berisik - Menggerakan bibir dan mengucapkan tulisan di buku ketika membaca - Lebih senang mendengarkan (dibacakan) daripada membaca - Jika membaca maka lebih senang membaca dengan suara k eras - Dapat mengulangi atau menirukan nada, irama dan warna suara - Mengalami kesulitan untuk menuliskan sesuatu, tetapi sangat pandai dalam bercerita - Berbicara dalam irama yang terpola dengan baik - berbicara dengan sangat fasih - Lebih menyukai seni m usik dibandingkan seni yang lainnya - Belajar dengan mendengarkan dan mengingat apa yang didiskusikan daripada apa yang dilihat - Senang berbicara, berdiskusi dan menjelaskan sesuatu secara panjang lebar - Mengalami kesulitan jika harus dihadapkan pada tug as - tugas yang berhubungan dengan visualisasi - Lebih pandai mengeja atau mengucapkan kata - kata dengan keras daripada menuliskannya - Lebih suka humor atau gurauan lisan daripada membaca buku humor/komik.<br>
		Berbicara dengan perlahan - Menanggapi perhatian fisik - Menyentuh orang lain untuk mendapatkan perhatian mereka - Berdiri dekat ketika sedang berbicara dengan orang lain - Banyak gerak fisik -  Memiliki perkembangan awal otot-otot yang besar - Belajar melalui praktek langsung atau manipulasi - Menghafalkan sesuatu dengan cara berjalan atau melihat langsung - Menggunakan jari untuk menunjukka apa yang dibaca ketika sedang membaca - Banyak menggunakan bahasa tubuh (non verbal) - Tidak dapat duduk diam di suatu tempat untuk waktu yang lama - Sulit membaca peta kecuali ia memang pernah ke tempat tersebut - Menggunakan ka ta - kata yang mengandung aksi - Pada umumnya tulisannya jelek - Menyukai kegiatan atau permainan yang menyibukkan (secara fisik) - Ingin melakukan segala sesuatu';

            $saran = 'Buatlah Peta Konsep pelajaran dengan mulai dari tema besar di tengah halaman, menggunakan kata - kata penting, menggunakan simbol, warna, kata, gambar yang mencolok dan lakukan ini dengan gayamu sendiri - Dalam mencatat pelajaran, gunakan tanda - tanda, gambar dan warna untuk menandai hal - hal penting agar dapat dengan mudah dilihat lagi jika akan mempelajarinya dilain waktu - Untuk membantu mengingat apa yang baru dibaca dan didengar , duduklah dengan santai dan bayangkan dalam pikiran apa yang baru dibaca/didengar<br>
		Bacalah pelajaran dengan cara baca yang dramatis - Cobalah menyanyikannya dengan irama iklan atau musik - Merangkum pelajaran dengan diucapkan lantang atau direkam dalam kaset / CD dan didengarkan menggunakan walkman saat ke sekolah -  Saat membaca dengan lantang, perhatikan intonasi, penekanan khusus, cobalah berbisik dan cobalah untuk memejamkan mata untuk belajar membayangkan apa yang dibaca<br>
		Cobalah belajar dalam kelompok untuk membentuk suasana bermain peran dari pelajaran yang dibahas - Tulislah poin - poin penting dari pelajaran dalam bentuk kartu - kartu yang disusun secara logis -  Buatlah semacam percobaan atau model dari apa yang sedang kamu pelajari - Libatkan tubuh dalam belajar dengan mencoba meniru apa yang dipelajari dengan gaya guru saat menyampaikan materi - Setiap kali membaca atau mendengarkan seseorang berbicara, bangkitlah untuk sedikit bergerak setiap 15 - 20 menit sekali';
        }

        $data_eq = $this->model_agcu->get_eq($idsiswa);

        if($data_eq->skor_aq < 7){
            $analisis_aq = "Mudah gelisah, bingung dan sering cemas - Sering kehilangan rasa humor - Menyalahkan diri sendiri terhadap berbagai kegagalan - Analisisnya dangkal ";
        }elseif($data_eq->skor_aq <= 11){
            $analisis_aq = "Daya tahan emosi dalam menghadapi cobaan cenderung kurang berkembang - Mudah kehilangan ketenangan - Sering kecewa terhadap kesalahan sendiri - Mudah kehilangan keseimbangan emosi ";
        }elseif($data_eq->skor_aq <= 21){
            $analisis_aq = "Daya tahan emosi dalam menghadapi cobaan cenderung berkembang - Peningkatan daya tahan emosi tergantung lingkungan - Perlu melatih ketenangan ";
        }elseif($data_eq->skor_aq <= 26){
            $analisis_aq = "Daya tahan emosi dalam menghadapi cobaan cukup baik - Terkadang menyerah tapi jarang mengalami kebingungan - Mempunyai ketenangan yang tidak mudah goyah - Tetap mampu mengambil keputusan yang akurat";
        }elseif($data_eq->skor_aq <= 32){
            $analisis_aq = "Daya tahan emosi dalam menghadapi cobaan sangat tinggi - Tidak akan stress kecuali kondisi sangat tragis - Mempunyai ketenangan yang sangat kuat - Tetap berorientasi pada tujuan";
        }

        if($data_eq->skor_eq < 7){
            $analisis_eq = "Tidak mampu memahami dinamika kelompok - Kesulitan memahami perasaan orang lain - Kurang kemauan untuk membantu kesulitan orang lain - Sering tegang menghadapi tekanan ";
        }elseif($data_eq->skor_eq <= 11){
            $analisis_eq = "Cenderung menolak perubahan - Kurang mampu mengendalikan perasaan - Cenderung egois - Selalu mengambil untung di setiap kesempatan - Kurang luwes dalam bergaul ";
        }elseif($data_eq->skor_eq <= 21){
            $analisis_eq = "Memiliki keterbukaan terhadap perubahan lingkungan - Memiliki semangat yang cukup baik - Mampu mendeteksi perasaan dan perspektif orang lain ";
        }elseif($data_eq->skor_eq <= 26){
            $analisis_eq = "Mampu menyemangati dirinya dan orang lain - Memiliki toleransi terhadap kekurangan orang lain - Mampu memelihara norma kejujuran dan integritas - Memiliki teknik persuasi yang baik ";
        }elseif($data_eq->skor_eq <= 32){
            $analisis_eq = "Memiliki rasa empati yang tinggi pada kesulitan orang lain - Mempu mengendalikan perasaannya - memiliki semangat yang tinggi dalam kondisi apapun";
        }

        if($data_eq->skor_am < 7){
            $analisis_am = "Tidak ada kemauan untuk berprestasi - Merasa yakin bahwa prestasinya selama ini sudah cukup - Tidak pernah instrospeksi diri ";
        }elseif($data_eq->skor_am <= 11){
            $analisis_am = "Jarang mendapatkan atau menginginkan prestasi tertentu - Tidak ada semangat bersaing - Biasanya menginginkan hasil seketika - Biasanya menjadi trouble maker";
        }elseif($data_eq->skor_am <= 21){
            $analisis_am = "Tidak ada prestasi yang istimewa - Kurang semangat bersaing - Cepat puas terhadap hasil yang diperoleh - Hanya berorientasi pada melaksanakan instruksi dengan benar ";
        }elseif($data_eq->skor_am <= 26){
            $analisis_am = "Memiliki kecenderungan high achiever dan rasa percaya diri cukup - Memiliki misi yang jelas dan terukur - Mampu memberi penghargaan terhadap hasil karya orang lain ";
        }elseif($data_eq->skor_am <= 32){
            $analisis_am = "High achiever, penuh rasa percaya diri dan optimis - Punya misi yang jelas untuk jangka panjang - Memiliki apresiasi yang tinggi terhadap hasil karya orang lain";
        }

        $data = array(
            'navbar_links' 	=> $this->model_pg->get_navbar_links(),
            'infosiswa'				=> $infosiswa,
            'kategoridiagnostic'	=> $kategoridiagnostic,
            'hasildiagnostic'		=> $hasildiagnostic,
            'peringkatsiswa'		=> $peringkatsiswa,
            'datasoal'				=> $datasoal,
            'jumlahbenar'			=> $jumlahbenar,
            'jumlahhasil'			=> $jumlahhasil,
            'jumlahbenarhasil'		=> $jumlahbenarhasil,
            'analisistopik'			=> $analisistopik,
            'totalv' 				=> $totalv,
            'totala' 				=> $totala,
            'totalk' 				=> $totalk,
            'dominasi'				=> $dominasi,
            'karakteristik'			=> $karakteristik,
            'saran'					=> $saran,
            'data_eq'				=> $this->model_agcu->get_eq($idsiswa),
            'analisis_aq'			=> $analisis_aq,
            'analisis_eq'			=> $analisis_eq,
            'analisis_am'			=> $analisis_am,
            'idsiswa'				=> $idsiswa
        );
        $this->load->view('psep_sekolah/agcu_siswa', $data);
    }

    function rekap(){
        $idpsep = $this->session->userdata('idpsepsekolah');

        $carisekolah = $this->model_psep->cari_sekolah_by_login($idpsep);

        $data = array(
            'navbar_title' 	=> "Academic General Check Up",
            'active'		=> "agcu",
            'datakelas'		=> $this->model_psep->cari_kelas_by_jenjang($carisekolah->jenjang)
        );

        $this->load->view('psep_sekolah/rekap_agcu_pilih_kelas', $data);
    }

    function rekap_detail(){
        $params 	= $this->input->post(null, true);

        if(!isset($params['submit'])){
            redirect("psep_sekolah/agcu/rekap");
        }
        $kelas = $params['kelas'];

        $idsekolah = $this->session->userdata('idsekolah');
        $carisiswa = $this->model_psep->cari_siswa_by_kelas($kelas, $idsekolah);

        $kategoridiagnostic	= $this->model_agcu->get_diagnosticbykelas($kelas);
        $datasoal			= $this->model_agcu->get_jumlahsoal();
        $jumlahbenar 		= $this->model_agcu->get_jumlah_benar_by_kelas_sekolah($idsiswa, $idsekolah);

    }

    function tryoutsiswa()
    {
        if ($this->uri->segment(3) == "") {
            redirect('user/dashboard');
        } else {
            $idtryout = $this->uri->segment(3);
            $id_siswa = isset($_SESSION['id_siswa']) ? $_SESSION['id_siswa'] : 0;
            if (empty($this->session->userdata('akses'))) {
                $datapembelian = $this->model_pembayaran->get_tagihan_by_siswa($id_siswa);
                if (empty($datapembelian)) {
                    redirect("user/aktivasi");
                } else {
                    redirect("user/buylist");
                }
            }

            $idsiswa = $this->session->userdata('id_siswa');
            $session = $this->session->userdata;
            //$this->model_security->psep_sekolah_is_logged_in();
            // 	$data = array(
            // 		'infoortu'	=> $this->model_parent->get_parent($_SESSION['id_ortu'])
            // 	);
            //$this->load->view('pg_ortu/pilih_tryout', $data);
            $data = array(
                'infosiswa'         => $this->model_dashboard->get_info_siswa($this->session->userdata('id_siswa')),
                'navbar_links'      => $this->model_pg->get_navbar_links(),
                'data_user'         => $this->model_pg->get_data_user($this->session->userdata('id_siswa')),
                'profil_tryout'     => $this->model_adm->fetch_all_profil_by_id($idtryout),
                'profil_tryout_all' => $this->model_adm->fetch_all_profil_by_kelas($session['kelas']),
                'dataperingkat'     => $this->model_dashboard->peringkat($idtryout),
            );
            $table_data = $data['profil_tryout'];

            $daftar_kategori_baru = [];
            $i = 0;
            $totalsoal = 0;
            $totalbenar = 0;
            foreach ($table_data as $kat) {
                $daftar_kategori = $this->model_fronttryout->fetch_kategori($kat->id_tryout);
                $daftar_kategori_baru[$i] = json_decode(json_encode($kat), True);
                $j = 0;
                $index = 0;
                if (count($daftar_kategori) > 0) {
                    foreach ($daftar_kategori as $subkey => $value) {
                        if ($value->id_profil == $kat->id_tryout) {
                            $cariskor = $this->model_dashboard->cari_skor($value->id_kategori, $idsiswa);
                            $cariskorsalah = $this->model_dashboard->cari_skor_salah($value->id_kategori, $idsiswa);
                            $cariwaktu = $this->model_dashboard->cari_waktu($value->id_kategori, $idsiswa);
                            $daftar_kategori_baru[$i]['daftar_kategori'][$j] = json_decode(json_encode($value), True);
                            $daftar_kategori_baru[$i]['daftar_kategori'][$j]['cariskor'] = $cariskor;
                            $daftar_kategori_baru[$i]['daftar_kategori'][$j]['cariskorsalah'] = $cariskorsalah;
                            $daftar_kategori_baru[$i]['daftar_kategori'][$j]['cariwaktu'] = $cariwaktu;
                            $totalsoal+= $daftar_kategori_baru[$i]['daftar_kategori'][$j]['jumlah_soal'];
                            $totalbenar+= $cariskor;
                            $daftar_kategori_baru[$i]['daftar_kategori'][$j]['analisawaktu'] = json_decode(json_encode($this->model_dashboard->analisis_waktu($value->id_kategori, $idsiswa)), True);
                            $daftar_kategori_baru[$i]['daftar_kategori'][$j]['analisistopik'] = json_decode(json_encode($this->model_dashboard->analisistopik($value->id_kategori, $idsiswa)), True);
                            $analisa_topik = json_decode(json_encode($this->model_dashboard->analisatopik($value->id_kategori, $idsiswa)), True);
                            $k = 0;
                            foreach ($analisa_topik as $at) {
                                if ($at['id_analisis_topik'] != null) {
                                    $at['jml_benar'] = $this->model_dashboard->analisatopikbenar($value->id_kategori, $idsiswa);
                                    $daftar_kategori_baru[$i]['daftar_kategori'][$j]['analisa_topik'][$k] = $at;
                                    $daftar_kategori_baru[$i]['daftar_kategori'][$j]['analisa_topik'][$k]['total'] = $this->model_dashboard->jumlahtopik($value->id_kategori, $idsiswa, $at['topik']);
                                    $daftar_kategori_baru[$i]['daftar_kategori'][$j]['analisa_topik'][$k]['presentase'] = ($at['jml_benar'] == 0 ? 0 : ($at['jml_benar'] / $this->model_dashboard->jumlahtopik($value->id_kategori, $idsiswa, $at['topik'])) * 100);
                                } else {
                                    $daftar_kategori_baru[$i]['daftar_kategori'][$j][$k]['analisa_topik'] = null;
                                }
                                $k++;
                            }
                            unset($daftar_kategori[$index]);
                            $j++;
                        }
                        if ($j == 0) {
                            $daftar_kategori_baru[$i]['daftar_kategori'] = null;
                        }
                    }
                    $index++;
                } else {
                    $daftar_kategori_baru[$i]['daftar_kategori'] = null;
                }
                $i++;
            }
            $data['daftar_kategori_baru'] = $daftar_kategori_baru;
            $data['daftar_kategori_baru']['totalsoal'] = $totalsoal;
            $data['daftar_kategori_baru']['totalbenar'] = $totalbenar;

//            return $this->output
//                ->set_content_type('application/json')
//                ->set_status_header(500)
//                ->set_output(json_encode($data));
            $this->load->view('pg_user/tryout-statistik', $data);
        }
    }

}