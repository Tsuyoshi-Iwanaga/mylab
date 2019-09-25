<?php
// https://php-jp.com/encryption/#outline__1_2

$data = 'これは暗号文です!!';

# AES-256-CBCはパッディングオラクル攻撃の対象になるのでNG
$method = 'AES-256-CTR';

# 作成して保存、公開ディレクトリにはしないこと
$path_key = './key';

if(file_exists($path_key)) {
  $key = file_get_contents($path_key);
} else {
  $key = random_bytes(32);
  file_put_contents($path_key, $key);
}

# 初期化ベクトルを生成する
# 同じデータでも同じ暗号文にならないようにするために使う
# keyとは異なり知られても問題ないが、暗号化の度に新しく生成する必要がある

# 暗号化方式(ここではAES-256-CTR)の初期化ベクトルの長さを取得
$length = openssl_cipher_iv_length($method);

# 長さを渡して初期化ベクトルを生成する
$iv = openssl_random_pseudo_bytes($length);

# 暗号化(引数はデータ、暗号化方式、鍵、戻り値の設定、初期化ベクトル)
# 戻り値を0にするとbase64でエンコードされた暗号文が返ってくる
$encrypted = openssl_encrypt($data, $method, $key, 0, $iv);
print($encrypted).'<br>';

# 複合する
$decrypted = openssl_decrypt($encrypted, $method, $key, 0, $iv);
print($decrypted).'<br>';

print('<hr>');

# URLを暗号化
# 複合する時はクエリを分解する
$encrypted = openssl_encrypt($data, $method, $key, 0, $iv);

$queries = [
  'encrypted' => $encrypted,
  'iv' => base64_encode($iv)
];

$query = http_build_query($queries);

print('<a href="https://example.com/?'.$query.'">暗号化したリンクです</a><br>');
print('https://example.com/?'.$query.'<br>');