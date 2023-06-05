<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Login - SB Admin</title>
    <link href="css/styles.css" rel="stylesheet"/>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="bg-primary">
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">Çetinay Plastik<br>Kullanıcı
                                    Girişi</h3></div>
                            <div class="card-body">

                                <?php
                                session_start(); //Oturum başlatıcı
                                include("../inc/vt.php");//veritabanı bağlayıcı

                                if (isset($_SESSION["cerez"]) && $_SESSION["Oturum"] == "6789") {
                                   header("location:anasayfa.php");} //önceden oturum açıldıysa doğrudan anasayfa.php sayfası acılıyor

                                elseif (isset($_COOKIE["cerez"])) {
                                    $sorgu = $baglanti->prepare("select kadi,yetki from kullanici ");
                                    $sorgu->execute();
                                    while ($sonuc = $sorgu->fetch()) {
                                        if ($_COOKIE["cerez"] == sha1("aa" . $sonuc["kadi"] . "bb")) {
                                            $_SESSION["Oturum"] = "6789";
                                            $_SESSION["kadi"] = $sonuc["kadi"];
                                            $_SESSION["yetki"] = $sonuc["yetki"];
                                            header("location:anasayfa.php");
                                        }
                                    }

                                }

                                if ($_POST) { //girilen kullanıcı adını ve parolayı burada tutuyoruz
                                    $kadi = $_POST["txtkadi"];
                                    $parola = $_POST["txtparola"];
                                }
                                //echo sha1("56"."1234"."23");
                                ?>
                                <form method="post" action="login.php">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputEmail" name="txtkadi" value="<?= @$kadi ?>"
                                               type="text" placeholder="Kullanıcı Adı"/>
                                        <label for="inputEmail">Kullanıcı Adı</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputPassword" name="txtparola" type="password"
                                               placeholder="Parola"/>
                                        <label for="inputPassword">Parola</label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" id="inputRememberPassword" type="checkbox"
                                               name="cbHatirla"/>
                                        <label class="form-check-label" for="inputRememberPassword">Beni Hatırla</label>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">

                                        <input type="submit" class="btn btn-primary" value="Giriş">

                                    </div>
                                </form>
                                <script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>
                                <?php

                                if ($_POST) { //veritabanındaki bilgilerle girilen bilgilerin karşılaştırılması
                                    $sorgu = $baglanti->prepare("select parola,yetki from kullanici where kadi=:kadi");
                                    $sorgu->execute(['kadi' => htmlspecialchars($kadi)]);
                                    $sonuc = $sorgu->fetch();
                                    if (sha1("56" . $parola . "23") == $sonuc["parola"]) {   //Oturum oluşturma kısmı
                                        $_SESSION["Oturum"] = "6789";//bilgiler eşleşiyorsa oturum oluştur
                                        $_SESSION["kadi"] = $kadi;
                                        $_SESSION["yetki"] = $sonuc["yetki"];

                                        if (isset($_POST["cbHatirla"])) {
                                            setcookie("cerez", sha1("aa" . $kadi . "bb"), time() + (60 * 60 ));
                                        }

                                        header("location:anasayfa.php");
                                    }
                                    else {
                                        echo "<script> Swal.fire('Hata','Kullanıcı adı veya parola hatalı','error')</script>";
                                    }
                                    }
                                ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div id="layoutAuthentication_footer">
        <footer class="py-4 bg-light mt-auto">

        </footer>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
</body>
</html>
