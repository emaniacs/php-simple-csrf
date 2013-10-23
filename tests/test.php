<?php

require __DIR__ . '/../vendor/autoload.php';

use SimpleCsrf\SimpleCsrfSessionStorage;
use SimpleCsrf\SimpleCsrf;

$storage = new SimpleCsrfSessionStorage();

$csrf = new SimpleCsrf($storage);

$data = $csrf->getCSRF(false);

var_dump($data);

$postData = array (
    'csrf_key'   => $data['key'],
    'csrf_token' => $data['token'],
);

$validate1 = $csrf->validate($postData);
$validate2 = $csrf->validate($postData);

echo 'Validate with data ' . ($validate1?'True':'False') . "\n"; 
echo 'Validate with data ' . ($validate2?'True':'False') . "\n"; 

