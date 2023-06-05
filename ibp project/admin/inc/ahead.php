<?php
session_start();
if (!(isset($_SESSION["Oturum"]) && $_SESSION["Oturum"] == "6789")) { //oturum yoksa direkt login.php acılacak
header("location:login.php");}
include ("../inc/vt.php");
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?=$sayfa?> - SB Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables kütüphanesi ve stil dosyası -->
    <link rel="stylesheet" href="css/datatables.min.css">
    <script src="../js/datatables.min.js"></script>


</head>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="anasayfa.php">Çetinay Plastik</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="parolaGuncelleGenel.php">Parola Değiştir</a>
                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">Çıkış</a>
            </ul>
        </li>
    </ul>
</nav>
<!-- Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Çıkış</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Çıkış yapmak istediğinize emin misiniz?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                <a href="logout.php" class="btn btn-danger">Çıkış</a>
            </div>
        </div>
    </div>
</div>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">

                    <div class="sb-sidenav-menu-heading">Sayfalar</div>
                    <a class="nav-link collapsed <?= $sayfa=="Anasayfa" || $sayfa=="urunListe "?"active":""?> "href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        YÖNETİM PANELİ
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>


                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link <?= $sayfa=="anasayfa" ?"active":""?>" href="anasayfa.php">Anasayfa</a>
                            <a class="nav-link <?= $sayfa=="urunListe" ?"active":""?>" href="urunliste.php">Ürün Liste</a>
                            <?php
                             $sorguOkundu=$baglanti->prepare("select count(*) as sayi from duyuru where okundu=0");
                             $sorguOkundu->execute();
                             $sorguOkundu=$sorguOkundu->fetch();

                            ?>
                            <a class="nav-link <?= $sayfa=="Duyuru" ?"active":""?>" href="duyuru.php">Duyurular &nbsp;<span id="okunmaSayisi" class="badge badge-success"><?=$sorguOkundu["sayi"]?></span> </a>
                            <a class="nav-link <?= $sayfa=="Kullanıcılar" ?"active":""?>" href="Kullanici.php">Kullanıcılar</a>
                        </nav>
                    </div>

                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Giriş Yapan:</div>
              <?= $_SESSION["kadi"]?>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">