<?php if (!defined('BASEPATH')) exit('No direct script access allowed!');

class Model_encrypt extends CI_Model
{
    const CIPHER = MCRYPT_RIJNDAEL_128; // Rijndael-128 is AES
    const MODE = MCRYPT_MODE_CBC;

    function __construct()
    {
        parent::__construct();
    }

    public function encrypt($key, $plaintext)
    {
        $ivSize = mcrypt_get_iv_size(self::CIPHER, self::MODE);
        $iv = mcrypt_create_iv($ivSize, MCRYPT_DEV_URANDOM);
        $ciphertext = mcrypt_encrypt(self::CIPHER, $key, $plaintext, self::MODE, $iv);
        return base64_encode($iv . $ciphertext);
    }

    function decrypt($key, $ciphertext)
    {
        $ciphertext = base64_decode($ciphertext);
        $ivSize = mcrypt_get_iv_size(self::CIPHER, self::MODE);
        if (strlen($ciphertext) < $ivSize) {
            throw new Exception('Missing initialization vector');
        }

        $iv = substr($ciphertext, 0, $ivSize);
        $ciphertext = substr($ciphertext, $ivSize);
        $plaintext = mcrypt_decrypt(self::CIPHER, $key, $ciphertext, self::MODE, $iv);
        return rtrim($plaintext, "\0");
    }

    function read($json_url)
    {
        $json = file_get_contents($json_url);
        $json = str_replace('},]', "}]", $json);
        $data = json_decode($json);

        return $data;
    }

    function write($json_url, $json)
    {
        $fp = fopen($json_url, 'w');
        fwrite($fp, $json);
        fclose($fp);
    }
}


?>