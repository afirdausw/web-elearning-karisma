<?php
/**
 * Created by PhpStorm.
 * User: karisma-12
 * Date: 31/01/2018
 * Time: 9:57
 */
defined('BASEPATH') OR exit('No direct script access allowed');


function arr_to_obj($data)
{
    return $object = json_decode(json_encode($data), FALSE);
}

function obj_to_arr($data)
{
    return $object = json_decode(json_encode($data), TRUE);
}


function getSatuanDisk($size)
{
    $base = log($size) / log(1024);
    $suffix = array("", "KB", "MB", "GB", "TB");
    $f_base = floor($base);

    return $suffix[$f_base];
}

function getSpaceDisk($size)
{
    $base = log($size) / log(1024);

    return round(pow(1024, $base - floor($base)), 1);
}

function ribuan($val)
{
    if ($val < 10)
        $val = "00" . $val;
    else if ($val < 100)
        $val = "0" . $val;

    return $val;
}

function money($val)
{
    $hasil_rupiah = number_format($val, 0, ',', '.');
    return $hasil_rupiah;

}


function delete_files($directory)
{

    if (substr($directory, strlen($directory) - 1, 1) != '/') {
        $directory .= '/';
    }

    $files = glob($directory . "*");

    if (!empty($files)) {
        foreach ($files as $file) {
            if (is_dir($file)) {
                delete_files($file);
            } else {
                unlink($file);
            }
        }
    }
    rmdir($directory);

}

function tgl_indo($tanggal)
{
    $bulan = array(
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember',
    );
    $pecahkan = explode('-', $tanggal);

    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}

function alert($class, $message)
{

    $_SESSION['alert'][] = '
                <div class="alert alert-' . $class . '">
                    Pesan
                     ' . $message . '
                </div>';
}