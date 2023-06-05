<?php
$sayfa = "Gelen Mesajlar";
include('inc/ahead.php');

?>

<main>
    <div class="container-fluid ">
        <h1 class="mt-4"><?= $sayfa ?></h1>


        <div class="card mb-4">
            <div class="card-header">


            </div>
            <div class="card mb-4">


                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-bordered" id="dataTable">


                            <thead>
                            <tr>
                                <th>Ad</th>
                                <th>Mesaj</th>
                                <th>Tarih</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $sorgu = $baglanti->prepare("select * from mesajlar order by okundu");
                            $sorgu->execute();
                            while ($sonuc = $sorgu->fetch()) {


                                ?>
                                <tr <?php if ($sonuc["okundu"] == 0) echo 'class="font-weight-bold"' ?>
                                <td><?= $sonuc["id"] ?></td>
                                <td><?= $sonuc["Ad"] ?></td>

                                <td><a id="<?= $sonuc["id"] ?> " href="#" class="btn btn-primary oku"
                                       data-bs-toggle="modal"
                                       data-bs-target="#okuModal<?= $sonuc["id"] ?>">
                                        Oku</a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="okuModal<?= $sonuc["id"] ?>" tabindex="-1"
                                         role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Mesaj</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?= $sonuc["Mesaj"] ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            onclick="$('#okuModal<?= $sonuc["id"] ?>').modal('hide')">
                                                        Kapat
                                                    </button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td><?= $sonuc["Tarih"] ?></td>
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
                                                        <a href="sil.php?id=<?= $sonuc["id"] ?>&tablo=mesajlar"
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

<script type="text/javascript">
    $('.oku').click(function (event) {
        var id = $(this).attr("id");
        var veri = $(this);
        var sayi = parseInt($('okunmaSayisi').text());

        $.ajax({
            type: 'POST',
            url: 'inc/okundu2.php',
            data: {id: id, tablo: 'mesajlar'},
            success: function (result) {
                if (result == true) {
                    veri.closest('tr').removeClass("font-weight-bold");
                    if (sayi > 0) $("#okunmaSayisi").text(sayi - 1);
                }
            }
        })


    });

</script>

