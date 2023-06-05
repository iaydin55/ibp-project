<?php
$sayfa = "Anasayfa";
include('inc/ahead.php');

?>

<main>
    <div class="container-fluid ">
        <h1 class="mt-4">Anasayfa</h1>

        <div class="card mb-4">
            <div class="card-header">
                <a href="kisiEkle.php" class="btn btn-primary">Kişi Ekle</a>

            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>

                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-bordered" id="dataTable">

                            <thead>
                            <tr>
                                <th>Ad Soyad</th>
                                <th>Pozisyon</th>
                                <th>Yaş</th>
                                <th>Başlangıç Tarihi</th>
                                <th>Maaş</th>

                                <th></th>
                                <th></th>

                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            $sorgu = $baglanti->prepare("select * from anasayfa ");

                            $sorgu->execute();
                            while ($sonuc = $sorgu->fetch()) {

                                ?>
                                <tr>
                                    <td><?= $sonuc["adSoyad"] ?></td>
                                    <td><?= $sonuc["pozisyon"] ?></td>
                                    <td><?= $sonuc["yas"] ?></td>
                                    <td><?= $sonuc["bTarih"] ?></td>
                                    <td><?= $sonuc["maas"] ?></td>

                                    <td class="text-center">

                                        <?php if ($_SESSION["yetki"] == "1") {
                                            ?>
                                            <a href="anasayfaGuncelle.php?id=<?= $sonuc["id"] ?>">
                                                <span class="fa fa-edit fa-2x"></span>
                                            </a>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($_SESSION["yetki"] == "1") { ?>
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
                                                        <a href="sil.php?id=<?= $sonuc["id"] ?>&tablo=anasayfa"
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

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</main>
<?php

include('inc/afooter.php');
?>
