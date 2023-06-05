<?php
$sayfa="Kullanıcılar";
include('inc/ahead.php');

if($_SESSION["yetki"]!="1"){
    echo' <script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
    echo "<script> Swal.fire( {title:'Hata!', text:'Yetkisiz Kullanıcı', icon:'error',confirmButtonText: 'Tamam'}).then((value)=>{
    if(value.isConfirmed){window.location.href='anasayfa.php'}})</script>";
    exit;
}
$sorgu = $baglanti->prepare("select * from kullanici where id=:id");
$sorgu->execute(['id'=>$_GET['id']]);
($sonuc = $sorgu->fetch());
if ($_POST) {


      if($_POST["kadi"] !='' && $_POST["email"] !=''&& $_POST["yetki"] !=''){
        $ekleSorgu=$baglanti->prepare("UPDATE kullanici set kadi=:kadi,email=:email,yetki=:yetki WHERE id=:id");
        $ekle=$ekleSorgu->execute([
            'kadi'=>$_POST['kadi'],
            'email'=>$_POST['email'],
            'yetki'=>$_POST['yetki'],
            'id'=>$_GET['id']
        ]);

        if($ekle){
            echo' <script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
            echo "<script> Swal.fire( {title:'Başarılı!', text:'Güncelleme Başarılı', icon:'success',confirmButtonText: 'Tamam'}).then((value)=>{
            if(value.isConfirmed){window.location.href='Kullanici.php'}})</script>";
        }
      }

}
?>

                <main>
                    <div class="container-fluid ">
                        <h1 class="mt-4">Kullanıcı Güncelleme</h1>


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
                                        <label>Email</label>
                                        <input type="email" name="email" required class="form-control" value="<?=$sonuc["email"]?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Yetki</label><br>
                                        <label><input type="radio" name="yetki" value="1" <?= $sonuc['yetki']=='1'? 'checked':'' ?>>Admin</label><br>
                                        <label><input type="radio" name="yetki" value="2"<?= $sonuc['yetki']=='2'? 'checked':'' ?>> Normal Kullanıcı</label>
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
