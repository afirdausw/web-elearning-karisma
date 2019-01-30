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



function get_string_between($string, $start, $end)
{
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

function convert_base64_to_image($text, $dir)
{
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
    $doc = new DOMDocument();
    @$doc->loadHTML($text);

    $tags = $doc->getElementsByTagName('img');
    $img = [];
    $i = 0;
    $text_lama = $text;
    foreach ($tags as $tag) {
        $img[$i]['img'] = $tag->getAttribute('src');
        if (strpos($tag->getAttribute('src'), ';base64,') !== false) {
            $image_parts = explode(";base64,", $tag->getAttribute('src'));
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $img[$i]['tipe'] = $image_type;
            $img[$i]['tipe_file'] = tipe($image_type);
            $file = $dir . uniqid() . '.' . tipe($image_type);
            $image_base64 = base64_decode($image_parts[1]);
            file_put_contents($file, $image_base64);
            $img[$i]['file'] = base_url($file);
            $text = str_replace($tag->getAttribute('src'), base_url($file), $text);
            $i++;
        }

    }
    $img['text'] = $text;
    $img['text_lama'] = $text_lama;
    if ($handle = opendir($dir)) {
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != "..") {
                if (strpos($text, $entry) != true) {
                    unlink($dir . $entry);
                    echo $entry;
                }
            }
        }

        closedir($handle);
    }

    return $text;
}

function tipe($tipe)
{
    $tipe = strtolower($tipe);
    switch ($tipe) {
        case "gif":
            return "gif";
            break;
        case "jpeg":
            return "jpg";
            break;
        case "png":
            return "png";
            break;
        default :
            return false;
            break;
    }
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