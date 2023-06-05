<?php
$sayfa="Kullanıcılar";
include('inc/ahead.php');



$sorgu = $baglanti->prepare("select * from kullanici where id=:id");
$sorgu->execute(['id'=>$_GET['id']]);
($sonuc = $sorgu->fetch());

if ($_POST) {


      if($_POST["kadi"] !='' && $_POST["parola"] !=''&& $_POST["parola"] == $_POST["ptekrar"] ){
        $ekleSorgu=$baglanti->prepare("UPDATE kullanici set kadi=:kadi,parola=:parola WHERE id=:id");
        $ekle=$ekleSorgu->execute([
            'kadi'=>$_POST['kadi'],
            'parola'=>sha1("56" . $_POST['parola'] . "23"),
            'id'=>$_GET['id']

        ]);

        if($ekle){
            echo' <script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
            echo "<script> Swal.fire( {title:'Başarılı!', text:'Güncelleme Başarılı', icon:'success',confirmButtonText: 'Tamam'}).then((value)=>{
            if(value.isConfirmed){window.location.href='Kullanici.php'}})</script>";
        }

      }
      else{
          echo' <script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
          echo "<script> Swal.fire( {title:'Hata!', text:'Eksik veri',icon:'error',confirmButtonText: 'Kapat'})</script>";
      }

}
?>

                <main>
                    <div class="container-fluid ">
                        <h1 class="mt-4"> Kullanıcı Adı Ve Parola Güncelle</h1>


                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>

                            </div>
                            <div class="card-body">
                                <form action="" method="post">

                                    <div class="form-group">
                                        <label>Kullanıcı Adı</label>
                                        <input type="text" name="kadi" required class="form-control"  value="<?=$sonuc["kadi"]?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Parola</label>
                                        <input type="password" name="parola" required class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Parola Tekrar</label>
                                        <input type="password" name="ptekrar" required class="form-control">
                                    </div>


                                    <div class="form-group">
                                        <input type="submit" value="Güncelle" class="btn btn-primary">
                                     </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </main>
<?php

include('inc/afooter.php');
?>
