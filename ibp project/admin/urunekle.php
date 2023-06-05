<?php
$sayfa="Ürünler";
include('inc/ahead.php');

if($_SESSION["yetki"]!="1"){
    echo' <script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
    echo "<script> Swal.fire( {title:'Hata!', text:'Yetkisiz Kullanıcı', icon:'error',confirmButtonText: 'Tamam'}).then((value)=>{
    if(value.isConfirmed){window.location.href='urunListe.php'}})</script>";
    exit;
}

if ($_POST) {


      if($_POST["urunAdi"] !='' && $_POST["urunEbat"] !=''&& $_POST["fiyat"] !=''&& $_POST["adet"] !=''){
        $ekleSorgu=$baglanti->prepare("INSERT INTO urunliste set urunAdi=:urunAdi,urunEbat=:urunEbat,fiyat=:fiyat,adet=:adet ");
        $ekle=$ekleSorgu->execute([
            'urunAdi'=>$_POST['urunAdi'],
            'urunEbat'=>$_POST['urunEbat'],
            'fiyat'=>$_POST['fiyat'],
            'adet'=>$_POST['adet']
        ]);

        if($ekle){
            echo' <script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
            echo "<script> Swal.fire( {title:'Başarılı!', text:'Başarıyla Eklendi', icon:'success',confirmButtonText: 'Tamam'}).then((value)=>{
            if(value.isConfirmed){window.location.href='urunListe.php'}})</script>";
        }
      }

}
?>

                <main>
                    <div class="container-fluid ">
                        <h1 class="mt-4">Ürün Ekle</h1>


                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>

                            </div>
                            <div class="card-body">
                                <form action="" method="post">

                                    <div class="form-group">
                                        <label>Ürün Adı</label>
                                        <input type="text" name="urunAdi" required class="form-control" value="<?=@$_POST["urunAdi"]?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Ürün Ebat</label>
                                        <input type="text" name="urunEbat" required class="form-control" value="<?=@$_POST["urunEbat"]?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Fiyat</label>
                                        <input type="text" name="fiyat" required class="form-control" value="<?=@$_POST["fiyat"]?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Adet</label>
                                        <input type="text" name="adet" required class="form-control" value="<?=@$_POST["adet"]?>">
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" value="Ekle" class="btn btn-primary">
                                     </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </main>
<?php

include('inc/afooter.php');
?>
