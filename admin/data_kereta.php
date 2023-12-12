<?php
session_start();

if (!$_SESSION['data']) {
    session_destroy();
    header('location:login.php');
    exit();
}

require __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client([
    'base_uri' => 'http://127.0.0.1:8000',
]);

$response = $client->request('GET', '/api/datas');
$body = $response->getBody();
$dataraw = json_decode($body);
$dataBody = $dataraw->datas;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Topsis Metode</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">Dashboard</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>


    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Data</div>
                        <a class="nav-link" href="data_pesawat.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Data Tiket Pesawat
                        </a>
                        <a class="nav-link" href="data_kereta.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Data Tiket Kereta
                        </a>
                        <div class="sb-sidenav-menu-heading">Logout</div>
                        <a class="nav-link" href="controller_logout.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Logout
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Administrator
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Data Tiket Kereta Api</h1>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Data Tiket Kereta Api
                        </div>
                        <div class="card-body">
                            <button type="button" class="btn btn-primary btn-xl mb-4" class="btn btn-primary btn-xl mb-4" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah</button>
                            <table class="table align-middle table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kereta</th>
                                        <th>Jenis Tiket</th>
                                        <th>Destinasi</th>
                                        <th>Estimasi Waktu</th>
                                        <th>Harga</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kereta</th>
                                        <th>Jenis Tiket</th>
                                        <th>Destinasi</th>
                                        <th>Estimasi Waktu</th>
                                        <th>Harga</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $no = 1; // Inisialisasi nomor
                                    foreach ($dataBody as $data) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td> <!-- Kolom Nomor -->
                                            <td><?= $data->nama_kereta; ?></td>
                                            <td><?= $data->jenis_kereta; ?></td>
                                            <td><?= $data->destinasi; ?></td>
                                            <td><?= $data->estimasi_waktu; ?></td>
                                            <td><?= $data->harga; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $data->id; ?>">Edit</button>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $data->id; ?>">Delete</button>
                                            </td>
                                        </tr>
                                        <!-- Modal Hapus -->
                                        <div class="modal fade" id="hapusModal<?= $data->id; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="editModalLabel">Hapus Data ID <?= $data->id; ?></h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="controller.php">
                                                            <h5 class="modal-title fs-5" id="editModalLabel">Apakah Ingin Menghapus data ini? ID <?= $data->id; ?></h5>
                                                            <input type="hidden" name="keretaId" value=<?= $data->id; ?>>
                                                            <button type="submit" name="hapus_data_kereta" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="editModal<?= $data->id; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="editModalLabel">Edit Data ID <?= $data->id; ?></h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="controller.php" method="post">
                                                            <input type="hidden" name="keretaId" value=<?= $data->id; ?>>
                                                            <div class="mb-3">
                                                                <label for="kereta" class="form-label">Nama Kereta</label>
                                                                <input type="text" name="nama_kereta" class="form-control" id="kereta" aria-describedby="emailHelp" value="<?= $data->nama_kereta; ?>" placeholder="e.g Garuda Indonesia">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="tiket" class="form-label">Jenis Tiket</label>
                                                                <input type="text" name="jenis_kereta" class="form-control" id="tiket" aria-describedby="emailHelp" value="<?= $data->jenis_kereta; ?>" placeholder="Ekonomi / Executive">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="destinasi" class="form-label">Destinasi</label>
                                                                <input type="text" name="destinasi" class="form-control" id="destinasi" aria-describedby="emailHelp" value="<?= $data->destinasi; ?>" placeholder="e.g Malang ke Surabaya">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="estimasi" class="form-label">Estimasi Waktu</label>
                                                                <input type="text" name="estimasi_waktu" class="form-control" id="estimasi" aria-describedby="emailHelp" value="<?= $data->estimasi_waktu; ?>" placeholder="e.g 10 jam 5 menit">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="harga" class="form-label">Harga</label>
                                                                <input type="text" name="harga" class="form-control" id="harga" aria-describedby="emailHelp" value="<?= $data->harga; ?>" placeholder="e.g 1000000">
                                                            </div>
                                                            <button type="submit" name="edit_data_kereta" class="btn btn-primary">Submit</button>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <!-- Modal Tambah -->
        <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editModalLabel">Tambah Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="controller.php" method="post">
                            <div class="mb-3">
                                <label for="kereta" class="form-label">Nama Kereta</label>
                                <input type="text" name="nama_kereta" class="form-control" id="kereta" aria-describedby="emailHelp" placeholder="e.g Garuda Indonesia">
                            </div>
                            <div class="mb-3">
                                <label for="tiket" class="form-label">Jenis Tiket</label>
                                <input type="text" name="jenis_kereta" class="form-control" id="tiket" aria-describedby="emailHelp" placeholder="Ekonomi / Executive">
                            </div>
                            <div class="mb-3">
                                <label for="destinasi" class="form-label">Destinasi</label>
                                <input type="text" name="destinasi" class="form-control" id="destinasi" aria-describedby="emailHelp" placeholder="e.g Malang ke Surabaya">
                            </div>
                            <div class="mb-3">
                                <label for="estimasi" class="form-label">Estimasi Waktu</label>
                                <input type="text" name="estimasi_waktu" class="form-control" id="estimasi" aria-describedby="emailHelp" placeholder="e.g 10 jam 5 menit">
                            </div>
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga</label>
                                <input type="text" name="harga" class="form-control" id="harga" aria-describedby="emailHelp" placeholder="e.g 1000000">
                            </div>
                            <button type="submit" name="tambah_data_kereta" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>