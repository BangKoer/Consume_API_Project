<?php
require __DIR__ . '/vendor/autoload.php';
use GuzzleHttp\Client;
if (isset($_POST["tambah_pembeli_kereta"])) {
    $client = new Client([
        'base_uri' => 'http://127.0.0.1:8000',
    ]);
    
    $response = $client->request('POST', 'api/pembelianDatas', [
        'json' => [
            'tiket_id' => $_POST['keretaId'],
            'nama_pembeli' => "{$_POST['first-name']} {$_POST['last-name']}",
        ]
    ]);
    $body = $response->getBody();
    header('location:index_tiketkereta.php');
}

if (isset($_POST["tambah_pembeli_pesawat"])) {
    $client = new Client([
        'base_uri' => 'http://127.0.0.1:8080',
    ]);
    
    $response = $client->request('POST', 'api/pembelianDatas', [
        'json' => [
            'tiket_id' => $_POST['keretaId'],
            'nama_pembeli' => "{$_POST['first-name']} {$_POST['last-name']}",
        ]
    ]);
    $body = $response->getBody();
    header('location:index_tiketpesawat.php');
}

if (isset($_POST["edit_pembeli_kereta"])) {
    $userid = $_POST['userId'];
    $client = new Client([
        'base_uri' => 'http://127.0.0.1:8000',
    ]);
    
    $response = $client->request('PUT', "api/pembelianDatas/$userid", [
        'json' => [
            'tiket_id' => $_POST['id_kereta'],
            'nama_pembeli' => "{$_POST['first-name']} {$_POST['last-name']}",
        ]
    ]);
    $body = $response->getBody();
    header('location:index_tiketpembeli.php');
}

if (isset($_POST["edit_pembeli_pesawat"])) {
    $userid = $_POST['userId'];
    $client = new Client([
        'base_uri' => 'http://127.0.0.1:8080',
    ]);
    
    $response = $client->request('PUT', "api/pembelianDatas/$userid", [
        'json' => [
            'tiket_id' => $_POST['id_kereta'],
            'nama_pembeli' => "{$_POST['first-name']} {$_POST['last-name']}",
        ]
    ]);
    $body = $response->getBody();
    header('location:index_tiketpembeli.php');
}

if (isset($_POST["hapus_pembeli_kereta"])) {
    $userid = $_POST['userId'];
    $client = new Client([
        'base_uri' => 'http://127.0.0.1:8000',
    ]);
    
    $response = $client->request('PUT', "api/pembelianDatas/$userid", [
        'json' => [
            'tiket_id' => $_POST['id_kereta'],
            'nama_pembeli' => "{$_POST['first-name']} {$_POST['last-name']}",
        ]
    ]);
    $body = $response->getBody();
    header('location:index_tiketpembeli.php');
}
?>