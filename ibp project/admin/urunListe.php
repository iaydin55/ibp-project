<?php
$sayfa = "Ürün Liste";
include('inc/ahead.php');

?>

<main>
    <div class="container-fluid ">
        <h1 class="mt-4"><?= $sayfa ?></h1>

        <div class="card mb-4">
            <div class="card-header">
                <a href="urunekle.php" class="btn btn-primary">Ürün Ekle</a>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered" id="dataTable">


                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Ürün Adı</th>
                            <th>Ürün Ebat</th>
                            <th>Fiyat</th>
                            <th>Adet</th>
                            <th></th>
                            <th></th>

                        </tr>
                        </thead>

                        <tbody>
                        <?php
                        $sorgu = $baglanti->prepare("select * from urunliste");
                        $sorgu->execute();
                        while ($sonuc = $sorgu->fetch()) {


                            ?>
                            <tr>
                                <td><?= $sonuc["id"] ?></td>
                                <td><?= $sonuc["urunAdi"] ?></td>
                                <td><?= $sonuc["urunEbat"] ?></td>
                                <td><?= $sonuc["fiyat"] ?></td>
                                <td><?= $sonuc["adet"] ?></td>
                                <td class="text-center"><?php if ($_SESSION["yetki"] == "1") {
                                        ?>
                                        <a href="urunguncelle.php?id=<?= $sonuc["id"] ?>">
                                            <span class="fa fa-edit fa-2x"></span>
                                        </a>
                                        <?php
                                    }
                                    ?></td>

                                <td class="text-center">
                                    <?php if ($_SESSION["yetki"] == "1") {
                                        ?>
                                        <a href="#" data-bs-toggle="modal"
                                           data-bs-target="#silModal<?= $sonuc["id"] ?>"> <span
                                                class="fa fa-trash fa-2x"></span></a>
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
                                                        <a href="sil.php?id=<?= $sonuc["id"] ?>&tablo=urunliste"
                                                           class="btn btn-danger">Sil</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
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
