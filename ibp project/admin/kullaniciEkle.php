<?php
$sayfa="Kullanıcılar";
include('inc/ahead.php');

if($_SESSION["yetki"]!="1"){
    echo' <script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
    echo "<script> Swal.fire( {title:'Hata!', text:'Yetkisiz Kullanıcı', icon:'error',confirmButtonText: 'Tamam'}).then((value)=>{
    if(value.isConfirmed){window.location.href='anasayfa.php'}})</script>";
    exit;
}

if ($_POST) {


      if($_POST["kadi"] !='' && $_POST["parola"] !=''&& $_POST["email"] !=''&& $_POST["yetki"] !=''){
        $ekleSorgu=$baglanti->prepare("insert into kullanici set kadi=:kadi,parola=:parola,email=:email,yetki=:yetki");
        $ekle=$ekleSorgu->execute([
            'kadi'=>$_POST['kadi'],
            'parola'=>sha1("56" . $_POST['parola'] . "23"),
            'email'=>$_POST['email'],
            'yetki'=>$_POST['yetki']
        ]);

        if($ekle){
            echo' <script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
            echo "<script> Swal.fire( {title:'Başarılı!', text:'Başarıyla Eklendi', icon:'success',confirmButtonText: 'Tamam'}).then((value)=>{
            if(value.isConfirmed){window.location.href='Kullanici.php'}})</script>";
        }
      }

}
?>

                <main>
                    <div class="container-fluid ">
                        <h1 class="mt-4">Kullanıcı Ekle</h1>


                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>

                            </div>
                            <div class="card-body">
                                <form action="" method="post">

                                    <div class="form-group">
                                        <label>Kullanıcı Adı</label>
                                        <input type="text" name="kadi" required class="form-control"  value="<?=@$_POST["kadi"]?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Parola</label>
                                        <input type="password" name="parola" required class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" required class="form-control" value="<?=@$_POST["email"]?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Yetki</label><br>
                                        <label><input type="radio" name="yetki" value="1" >Admin</label><br>
                                        <label><input type="radio" name="yetki" value="2" checked > Normal Kullanıcı</label>
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
