<?php 

 error_reporting(E_ALL);

require_once __DIR__ . "/../vendor/autoload.php";
// require_once __DIR__ . "/../app/Controller/HomeController.php";


use Noval\UKK\Paket1\Controller\HomeController;
use Noval\UKK\Paket1\Controller\FileController;
use Noval\UKK\Paket1\Controller\KelasController;
use Noval\UKK\Paket1\Controller\PembayaranController;
use Noval\UKK\Paket1\Controller\SppController;
use Noval\UKK\Paket1\Controller\PetugasController;
use Noval\UKK\Paket1\Controller\SiswaController;
use Noval\UKK\Paket1\Middleware\MustLoginMiddleware;
use Noval\UKK\Paket1\Middleware\MustAdminMiddleware;
use Noval\UKK\Paket1\Middleware\MustNotSiswaMiddleware;
use Noval\UKK\Paket1\App\Router;

// home & login
Router::add("GET", "/", HomeController::class, "index", [MustLoginMiddleware::class]);
Router::add("GET", "/home", HomeController::class, "index", [MustLoginMiddleware::class]);
Router::add("GET", "/logout", HomeController::class, "logout", []);
Router::add("GET", "/login", HomeController::class, "login", []);
Router::add("POST", "/login", HomeController::class, "postLogin", []);
Router::add("GET", "/login/petugas", HomeController::class, "loginPetugas", []);
Router::add("POST", "/login/petugas", HomeController::class, "postLoginPetugas", []);

Router::add("GET", "/history", PembayaranController::class, "index", [MustLoginMiddleware::class]);
Router::add("GET", "/laporan", PembayaranController::class, "laporan", [MustAdminMiddleware::class]);
Router::add("GET", "/laporan/cetak", PembayaranController::class, "Cetaklaporan", [MustAdminMiddleware::class]);

// pembayaran 
Router::add("GET", "/pembayaran", PembayaranController::class, "pilihSiswa", [MustLoginMiddleware::class, MustNotSiswaMiddleware::class]);
Router::add("GET", "/pembayaran/tambah/([0-9]*)", PembayaranController::class, "tambah", [MustLoginMiddleware::class, MustNotSiswaMiddleware::class]);
Router::add("POST", "/pembayaran/tambah/([0-9]*)", PembayaranController::class, "postTambah", [MustLoginMiddleware::class, MustNotSiswaMiddleware::class]);
Router::add("GET", "/pembayaran/berhasil/([0-9]*)", PembayaranController::class, "berhasil", [MustLoginMiddleware::class, MustNotSiswaMiddleware::class]);
Router::add("GET", "/pembayaran/hapus/([0-9]*)", KelasController::class, "hapus", [MustLoginMiddleware::class, MustNotSiswaMiddleware::class]);
Router::add("GET", "/pembayaran/cetak/([0-9]*)", PembayaranController::class, "cetak", [MustLoginMiddleware::class]);
Router::add("POST", "/pembayaran/edit/([0-9]*)", KelasController::class, "postEdit", [MustLoginMiddleware::class, MustNotSiswaMiddleware::class]);

// kelas 
Router::add("GET", "/kelas", KelasController::class, "index", [MustLoginMiddleware::class, MustAdminMiddleware::class]);
Router::add("GET", "/kelas/tambah", KelasController::class, "tambah", [MustLoginMiddleware::class, MustAdminMiddleware::class]);
Router::add("POST", "/kelas/tambah", KelasController::class, "postTambah", [MustLoginMiddleware::class, MustAdminMiddleware::class]);
Router::add("GET", "/kelas/hapus/([0-9]*)", KelasController::class, "hapus", [MustLoginMiddleware::class, MustAdminMiddleware::class]);
Router::add("GET", "/kelas/edit/([0-9]*)", KelasController::class, "edit", [MustLoginMiddleware::class, MustAdminMiddleware::class]);
Router::add("POST", "/kelas/edit/([0-9]*)", KelasController::class, "postEdit", [MustLoginMiddleware::class, MustAdminMiddleware::class]);

// spp
Router::add("GET", "/spp", SppController::class, "index", [MustLoginMiddleware::class, MustAdminMiddleware::class]);
Router::add("GET", "/spp/tambah", SppController::class, "tambah", [MustLoginMiddleware::class, MustAdminMiddleware::class]);
Router::add("POST", "/spp/tambah", SppController::class, "postTambah", [MustLoginMiddleware::class, MustAdminMiddleware::class]);
Router::add("GET", "/spp/hapus/([0-9]*)", SppController::class, "hapus", [MustLoginMiddleware::class, MustAdminMiddleware::class]);
Router::add("GET", "/spp/edit/([0-9]*)", SppController::class, "edit", [MustLoginMiddleware::class, MustAdminMiddleware::class]);
Router::add("POST", "/spp/edit/([0-9]*)", SppController::class, "postEdit", [MustLoginMiddleware::class, MustAdminMiddleware::class]);

// petugas
Router::add("GET", "/petugas", PetugasController::class, "index", [MustLoginMiddleware::class, MustAdminMiddleware::class]);
Router::add("GET", "/petugas/tambah", PetugasController::class, "tambah", [MustLoginMiddleware::class, MustAdminMiddleware::class]);
Router::add("POST", "/petugas/tambah", PetugasController::class, "postTambah", [MustLoginMiddleware::class, MustAdminMiddleware::class]);
Router::add("GET", "/petugas/hapus/([0-9]*)", PetugasController::class, "hapus", [MustLoginMiddleware::class, MustAdminMiddleware::class]);
Router::add("GET", "/petugas/edit/([0-9]*)", PetugasController::class, "edit", [MustLoginMiddleware::class, MustAdminMiddleware::class]);
Router::add("POST", "/petugas/edit/([0-9]*)", PetugasController::class, "postEdit", [MustLoginMiddleware::class, MustAdminMiddleware::class]);

// siswa
Router::add("GET", "/siswa", SiswaController::class, "index", [MustLoginMiddleware::class, MustAdminMiddleware::class]);
Router::add("GET", "/siswa/tambah", SiswaController::class, "tambah", [MustLoginMiddleware::class, MustAdminMiddleware::class]);
Router::add("POST", "/siswa/tambah", SiswaController::class, "postTambah", [MustLoginMiddleware::class, MustAdminMiddleware::class]);
Router::add("GET", "/siswa/hapus/([0-9]*)", SiswaController::class, "hapus", [MustLoginMiddleware::class, MustAdminMiddleware::class]);
Router::add("GET", "/siswa/edit/([0-9]*)", SiswaController::class, "edit", [MustLoginMiddleware::class, MustAdminMiddleware::class]);
Router::add("POST", "/siswa/edit/([0-9]*)", SiswaController::class, "postEdit", [MustLoginMiddleware::class, MustAdminMiddleware::class]);

Router::add("GET", "/asset/([a-z]*)/([a-z/]*)", FileController::class, "getFile", []);
// run router
Router::run();

 ?>