<?php
    session_start();
    echo $sesi = $_SESSION['mulai_waktu'];
//    if($sesi == NULL){
//        $this->session->unset_userdata('mulai_waktu');
//        echo "Session was destroyed";
//    }else{
//        echo "Tidak ada sesi";
//    }
?>