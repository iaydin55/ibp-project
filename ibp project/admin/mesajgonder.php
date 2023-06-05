<?php
$sayfa = "Mesaj Gönder";
include('inc/ahead.php');


if ($_POST) {


    if ($_POST["Ad"] != '' && $_POST["Mesaj"] != '') {
        $ekleSorgu = $baglanti->prepare("INSERT INTO mesajlar set Ad=:Ad,Mesaj=:Mesaj");
        $ekle = $ekleSorgu->execute([
            'Ad' => $_POST['Ad'],
            'Mesaj' => $_POST['Mesaj']

        ]);

        if ($ekle) {
            echo ' <script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
            echo "<script> Swal.fire( {title:'Başarılı!', text:'Başarıyla Eklendi', icon:'success',confirmButtonText: 'Tamam'}).then((value)=>{
            if(value.isConfirmed){window.location.href='duyuru.php'}})</script>";
        }
    }
}
?>
<main>
    <div class="container-fluid ">
        <h1 class="mt-4">Mesaj Gönder</h1>


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>

            </div>
            <div class="card-body">
                <form action="" method="post">

                    <div class="form-group">
                        <label>Ad</label>
                        <input type="text" name="Ad" required class="form-control" value="<?= @$_POST["Ad"] ?>">
                    </div>
                    <div class="form-group">
                        <label>Mesaj</label>
                        <input type="text" name="Mesaj" required class="form-control" value="<?= @$_POST["Mesaj"] ?>">
                    </div>


                    <div class="form-group">
                        <input type="submit" value="Gönder" class="btn btn-primary">
                    </div>

                </form>

            </div>
        </div>
    </div>
</main>
<?php

include('inc/afooter.php');
?>
