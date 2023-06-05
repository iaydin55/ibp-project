<?php
$sayfa = "Kullanıcılar";
include('inc/ahead.php');

if($_SESSION["yetki"]!="1"){
    echo' <script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
    echo "<script> Swal.fire( {title:'Hata!', text:'Yetkisiz Kullanıcı', icon:'error',confirmButtonText: 'Tamam'}).then((value)=>{
    if(value.isConfirmed){window.location.href='anasayfa.php'}})</script>";
    exit;
}
?>

<main>
    <div class="container-fluid ">
        <h1 class="mt-4"><?= $sayfa ?></h1>


        <div class="card mb-4">
            <div class="card-header">
                <?php if($_SESSION["yetki"]=="1"){ ?>
              <a href="kullaniciEkle.php" class="btn btn-primary">Kullanıcı Ekle</a>
                <?php } ?>
            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered" id="dataTable">


                        <thead>
                        <tr>
                            <th>Kullanıcı Adı</th>
                            <th>Yetki</th>
                            <th>Email</th>
                            <th>Parola Güncelle</th>
                            <th>Güncelle</th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php
                        $sorgu = $baglanti->prepare("select * from kullanici ");

                        $sorgu->execute();
                        while ($sonuc = $sorgu->fetch()) {

                            ?>
                            <tr>
                                <td><?= $sonuc["kadi"] ?></td>
                                <td><?= $sonuc["yetki"]==1?'Admin':'Normal Kullanıcı'?></td>
                                <td><?= $sonuc["email"] ?></td>

                                <td class="text-center">

                                        <a href="parolaGuncelle.php?id=<?= $sonuc["id"] ?>">
                                            <span class="fa fa-key fa-2x"></span>
                                        </a>

                                <td class="text-center">
                                    <?php if($_SESSION["yetki"]=="1"){ ?>
                                    <a href="kullaniciGuncelle.php?id=<?= $sonuc["id"] ?>">
                                        <span class="fa fa-edit fa-2x"></span>
                                    </a>
                                    <?php } ?>
                                <td class="text-center">
                                    <?php if($_SESSION["yetki"]=="1"){ ?>
                                        <a href="#" data-bs-toggle="modal"
                                           data-bs-target="#silModal<?= $sonuc["id"] ?>"> <span
                                                class="fa fa-trash fa-2x"></span></a>
                                    <?php } ?>

                                        <!-- Modal -->
                                        <div class="modal fade" id="silModal<?= $sonuc["id"] ?>" tabindex="-1"
                                             role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Sil</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Silmek istediğinize emin misiniz?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                onclick="$('#silModal<?= $sonuc["id"] ?>').modal('hide')">
                                                            İptal
                                                        </button>
                                                        <a href="sil.php?id=<?= $sonuc["id"] ?>&tablo=kullanici"
                                                           class="btn btn-danger">Sil</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </td>


                            </tr>
                            <?php
                        }
                        ?>

                    </table>
                    </tbody>

                </div>
            </div>
        </div>
    </div>
</main>
<?php

include('inc/afooter.php');
?>
