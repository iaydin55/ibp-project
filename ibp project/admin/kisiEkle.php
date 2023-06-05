<?php
$sayfa="Ürünler";
include('inc/ahead.php');

if($_SESSION["yetki"]!="1"){
    echo' <script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
    echo "<script> Swal.fire( {title:'Hata!', text:'Yetkisiz Kullanıcı', icon:'error',confirmButtonText: 'Tamam'}).then((value)=>{
    if(value.isConfirmed){window.location.href='anasayfa.php'}})</script>";
    exit;
}

if ($_POST) {

      if($_POST["adSoyad"] !='' && $_POST["pozisyon"] !=''&& $_POST["yas"] !=''&& $_POST["bTarih"] !=''&& $_POST["maas"] !=''){
        $ekleSorgu=$baglanti->prepare("INSERT INTO anasayfa set adSoyad=:adSoyad,pozisyon=:pozisyon,yas=:yas,bTarih=:bTarih,maas=:maas ");
        $ekle=$ekleSorgu->execute([
            'adSoyad'=>$_POST['adSoyad'],
            'pozisyon'=>$_POST['pozisyon'],
            'yas'=>$_POST['yas'],
            'bTarih'=>$_POST['bTarih'],
            'maas'=>$_POST['maas'],

        ]);

        if($ekle){
            echo' <script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
            echo "<script> Swal.fire( {title:'Başarılı!', text:'Başarıyla Eklendi', icon:'success',confirmButtonText: 'Tamam'}).then((value)=>{
            if(value.isConfirmed){window.location.href='anasayfa.php'}})</script>";
        }
      }
}
?>

                <main>
                    <div class="container-fluid ">
                        <h1 class="mt-4">Kişi Ekle</h1>


                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>

                            </div>
                            <div class="card-body">
                                <form action="" method="post">

                                    <div class="form-group">
                                        <label>Ad Soyad</label>
                                        <input type="text" name="adSoyad" required class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label>Pozisyon</label>
                                        <input type="text" name="pozisyon" required class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label>Yaş</label>
                                        <input type="text" name="yas" required class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label>Başlama Tarihi</label>
                                        <input type="date" name="bTarih" required class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label>Maaş</label>
                                        <input type="text" name="maas" required class="form-control" >
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
