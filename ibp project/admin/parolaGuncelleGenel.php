<?php
$sayfa="Kullanıcılar";
include('inc/ahead.php');

if ($_POST) {

      if($_POST["guncelParola"] !='' && $_POST["parola"] !=''&& $_POST["parola"] == $_POST["ptekrar"] ){

          $sorgu=$baglanti->prepare("select parola from kullanici where kadi=:kadi");
          $sorgu->execute(['kadi'=>$_SESSION["kadi"]]);
          $sonuc=$sorgu->fetch();
          if($sonuc['parola']==sha1("56".$_POST["guncelParola"]."23")){
              $guncelleSorgu=$baglanti->prepare("UPDATE kullanici set parola=:parola WHERE kadi=:kadi");
              $guncelle=$guncelleSorgu->execute([
                  'kadi'=>$_SESSION["kadi"],
                  'parola'=>sha1("56" . $_POST['parola'] . "23")
              ]);
              if($guncelle){
                  echo' <script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
                  echo "<script> Swal.fire( {title:'Başarılı!', text:'Güncelleme Başarılı', icon:'success',confirmButtonText: 'Tamam'})</script>";
              }
          }
          else{
              echo' <script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
              echo "<script> Swal.fire( {title:'Hata!', text:'Eksik veri',icon:'error',confirmButtonText: 'Kapat'})</script>";
          }
          }
}
?>
                <main>
                    <div class="container-fluid ">
                        <h1 class="mt-4">Kullanıcı Parola Güncelle</h1>


                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>

                            </div>
                            <div class="card-body">
                                <form action="" method="post">

                                    <div class="form-group">
                                        <label>Güncel Parola</label>
                                        <input type="password" name="guncelParola" required class="form-control">
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
