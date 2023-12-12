<?php
session_start();
require __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client([
    'base_uri' => 'http://127.0.0.1:8000',
]);

$response = $client->request('GET', "api/logout", [
    'headers' => [
        'Authorization' => 'Bearer ' . $_SESSION['data']->token
    ],
]);

// Hancurkan sesi
session_destroy();

// Redirect ke halaman register setelah logout
header("Location: login.php");
exit();
?>