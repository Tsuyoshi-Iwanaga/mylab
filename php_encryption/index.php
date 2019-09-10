<?php
// https://php-jp.com/encryption/#outline__1_2

$data = '暗号化します';

$method = 'AES-256-CTR';

$path_key = './key';

if(file_exists($path_key)) {
  $key = file_get_contents($path_key);
} else {
  $key = random_bytes(32);
  file_put_contents($path_key, $key);
}

$length = openssl_cipher_iv_length($method);

$iv = openssl_random_pseudo_bytes($length);

$encrypted = openssl_encrypt($data, $method, $key, 0, $iv);