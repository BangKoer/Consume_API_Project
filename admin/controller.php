<?php
session_start();
require __DIR__ . '/../vendor/autoload.php';
use GuzzleHttp\Client;

if (isset($_POST['tambah_data_pesawat'])) {
    $client = new Client([
        'base_uri' => 'http://127.0.0.1:8080',
    ]);
    
    $response = $client->request('POST', "api/datas", [
        'json' => [
            'nama_maskapai' => $_POST['nama_maskapai'],
            'jenis_pesawat' => $_POST['jenis_pesawat'],
            'destinasi' => $_POST['destinasi'],
            'estimasi_waktu' => $_POST['estimasi_waktu'],
            'harga' => $_POST['harga'],
            'logo' => $_POST['logo'],
        ]
    ]);
    $body = $response->getBody();
    header('location:data_pesawat.php');
}

if (isset($_POST['tambah_data_kereta'])) {
    $client = new Client([
        'base_uri' => 'http://127.0.0.1:8000',
    ]);
    
    $response = $client->request('POST', "api/datas", [
        'headers' => [
            'Authorization' => 'Bearer ' . $_SESSION['data']->token
        ],
        'json' => [
            'nama_kereta' => $_POST['nama_kereta'],
            'jenis_kereta' => $_POST['jenis_kereta'],
            'destinasi' => $_POST['destinasi'],
            'estimasi_waktu' => $_POST['estimasi_waktu'],
            'harga' => $_POST['harga'],
        ]
    ]);
    $body = $response->getBody();
    header('location:data_kereta.php');
}

if (isset($_POST['edit_data_kereta'])) {
    $id = $_POST['keretaId'];
    $client = new Client([
        'base_uri' => 'http://127.0.0.1:8000',
    ]);
    
    $response = $client->request('PUT', "api/datas/$id", [
        'headers' => [
            'Authorization' => 'Bearer ' . $_SESSION['data']->token
        ],
        'json' => [
            'nama_kereta' => $_POST['nama_kereta'],
            'jenis_kereta' => $_POST['jenis_kereta'],
            'destinasi' => $_POST['destinasi'],
            'estimasi_waktu' => $_POST['estimasi_waktu'],
            'harga' => $_POST['harga'],
        ]
    ]);
    $body = $response->getBody();
    header('location:data_kereta.php');
}

if (isset($_POST['edit_data_pesawat'])) {
    $id = $_POST['pesawatId'];
    $client = new Client([
        'base_uri' => 'http://127.0.0.1:8080',
    ]);
    
    $response = $client->request('PUT', "api/datas/$id", [
        'json' => [
            'nama_maskapai' => $_POST['nama_maskapai'],
            'jenis_pesawat' => $_POST['jenis_pesawat'],
            'destinasi' => $_POST['destinasi'],
            'estimasi_waktu' => $_POST['estimasi_waktu'],
            'harga' => $_POST['harga'],
            'logo' => $_POST['logo'],
        ]
    ]);
    $body = $response->getBody();
    header('location:data_pesawat.php');
}

if (isset($_POST['hapus_data_kereta'])) {
    $id = $_POST['keretaId'];
    $client = new Client([
        'base_uri' => 'http://127.0.0.1:8000',
    ]);
    $response = $client->request('DELETE', "api/datas/$id", [
        'headers' => [
            'Authorization' => 'Bearer ' . $_SESSION['data']->token
        ],
    ]);
    header('location:data_pesawat.php');
}

if (isset($_POST['hapus_data_pesawat'])) {
    $id = $_POST['pesawatId'];
    $client = new Client([
        'base_uri' => 'http://127.0.0.1:8080',
    ]);
    $response = $client->request('DELETE', "api/datas/$id");
    header('location:data_pesawat.php');
}

?>