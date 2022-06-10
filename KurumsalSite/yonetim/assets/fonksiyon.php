<?php ob_start();
try {
   $baglanti = new PDO("mysql:host=localhost;dbname=kurumsal;charset=utf8", "root", "");
   $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
   die($e->getMessage());
}

class yonetim{

  function sorgum($vt,$sorgu,$tercih){
    $al=$vt->prepare($sorgu);
    $al->execute();

    if($tercih==1):
      return $sonuc=$al->fetch();
    
    elseif($tercih==2):
      return $sonuc=$al->fetch(PDO::FETCH_ASSOC);
    
  endif;


  }

  function siteayar($baglanti){

    $sonuc=$this->sorgum($baglanti,"select * from ayarlar",1);
    
    if($_POST):
      //burada veritabanı işlemleri

      $title = htmlspecialchars($_POST["title"]);
      $metatitle = htmlspecialchars($_POST["metatitle"]);
      $metadesc = htmlspecialchars($_POST["metadesc"]);
      $metakey = htmlspecialchars($_POST["metakey"]);
      $metaaut = htmlspecialchars($_POST["metaaut"]);
      $metaown = htmlspecialchars($_POST["metaown"]);
      $metacopy = htmlspecialchars($_POST["metacopy"]);
      $logoyazi = htmlspecialchars($_POST["logoyazi"]);
      $twit = htmlspecialchars($_POST["twit"]);
      $face = htmlspecialchars($_POST["face"]);
      $inst = htmlspecialchars($_POST["inst"]);
      $telno = htmlspecialchars($_POST["telno"]);
      $adres = htmlspecialchars($_POST["adres"]);
      $mailadres = htmlspecialchars($_POST["mailadres"]);
      $slogan = htmlspecialchars($_POST["slogan"]);
      $refsayfabas = htmlspecialchars($_POST["refsayfabas"]);
      $filosayfabas = htmlspecialchars($_POST["filosayfabas"]);
      $yorumsayfabas = htmlspecialchars($_POST["yorumsayfabas"]);
      $iletisimsayfabas = htmlspecialchars($_POST["iletisimsayfabas"]);

      //buradan bunların boş veya doluluk kontrolü yapılabilir.

      $guncelleme = $baglanti->prepare("update ayarlar set title=?,metatitle=?,metadesc=?,metakey=?,metaauthor=?,metaowner=?,metacopy=?,
      logoyazisi=?,twit=?,face=?,ints=?,telefonno=?,adres=?,mailadres=?,slogan=?,referansbaslik=?,filobaslik=?,
      yorumbaslik=?,iletisimbaslik=?,");
      
      $guncelleme->bindParam(1, $title, PDO::PARAM_STR);
      $guncelleme->bindParam(2, $metatitle, PDO::PARAM_STR);
      $guncelleme->bindParam(3, $metadesc, PDO::PARAM_STR);
      $guncelleme->bindParam(4, $metakey, PDO::PARAM_STR);
      $guncelleme->bindParam(5, $metaaut, PDO::PARAM_STR);
      $guncelleme->bindParam(6, $metaown, PDO::PARAM_STR);
      $guncelleme->bindParam(7, $metacopy, PDO::PARAM_STR);
      $guncelleme->bindParam(8, $logoyazi, PDO::PARAM_STR);
      $guncelleme->bindParam(9, $twit, PDO::PARAM_STR);
      $guncelleme->bindParam(10, $face, PDO::PARAM_STR);
      $guncelleme->bindParam(11, $inst, PDO::PARAM_STR);
      $guncelleme->bindParam(12, $telno, PDO::PARAM_STR);
      $guncelleme->bindParam(13, $adres, PDO::PARAM_STR);
      $guncelleme->bindParam(14, $mailadres, PDO::PARAM_STR);
      $guncelleme->bindParam(15, $slogan, PDO::PARAM_STR);
      $guncelleme->bindParam(16, $refsayfabas, PDO::PARAM_STR);
      $guncelleme->bindParam(17, $filosayfabas, PDO::PARAM_STR);
      $guncelleme->bindParam(18, $yorumsayfabas, PDO::PARAM_STR);
      $guncelleme->bindParam(19, $iletisimsayfabas, PDO::PARAM_STR);
      $guncelleme->execute();
      
      echo '<div class="alert alert-success" role="alert">
      <strong>Site ayarları</strong> başarıyla güncellendi.
      </div>';

      header("refresh:2,url=index.php");

      
    else:
      ?>

<form action="index.php?sayfa=siteayar" method="POST">
              <div class="row">
                <div class="col-lg-7 mx-auto mt-2 ">
                  <h3 class="text-info">SİTE AYARLARI</h3>
                </div>
                <div class="col-lg-7 mx-auto mt-2 border">
                  <div class="row">
                    <div class="col-lg-3 border-right pt-3 text-left">
                      <span id="siteayarfont">Title</span>
                    </div>
                    <div class="col-lg-9 p-1">
                      <input type="text" name="title" class="form-control" value="<?php echo $sonuc["title"];?>">
                    </div>
                  </div>
                </div>
                <!--************-->

                <div class="col-lg-7 mx-auto  border">
                  <div class="row">
                    <div class="col-lg-3 border-right pt-3 text-left">
                      <span id="siteayarfont">Meta Title</span>
                    </div>
                    <div class="col-lg-9 p-1">
                      <input type="text" name="metatitle" class="form-control" value="<?php echo $sonuc["metatitle"];?>">
                    </div>
                  </div>
                </div>
                <!--************-->

                <div class="col-lg-7 mx-auto  border">
                  <div class="row">
                    <div class="col-lg-3 border-right pt-3 text-left">
                      <span id="siteayarfont">Sayfa Açıklama</span>
                    </div>
                    <div class="col-lg-9 p-1">
                      <input type="text" name="metadesc" class="form-control" value="<?php echo $sonuc["metadesc"];?>">
                    </div>
                  </div>
                </div>
                <!--************-->

                <div class="col-lg-7 mx-auto  border">
                  <div class="row">
                    <div class="col-lg-3 border-right pt-3 text-left">
                      <span id="siteayarfont">Anahtar Kelimeler</span>
                    </div>
                    <div class="col-lg-9 p-1">
                      <input type="text" name="metakey" class="form-control" value="<?php echo $sonuc["metakey"];?>">
                    </div>
                  </div>
                </div>
                <!--************-->

                <div class="col-lg-7 mx-auto  border">
                  <div class="row">
                    <div class="col-lg-3 border-right pt-3 text-left">
                      <span id="siteayarfont">Yapımcı</span>
                    </div>
                    <div class="col-lg-9 p-1">
                      <input type="text" name="metaaut" class="form-control" value="<?php echo $sonuc["metaauthor"];?>">
                    </div>
                  </div>
                </div>
                <!--************-->

                <div class="col-lg-7 mx-auto  border">
                  <div class="row">
                    <div class="col-lg-3 border-right pt-3 text-left">
                      <span id="siteayarfont">Firma</span>
                    </div>
                    <div class="col-lg-9 p-1">
                      <input type="text" name="metaown" class="form-control" value="<?php echo $sonuc["metaowner"];?>">
                    </div>
                  </div>
                </div>
                <!--************-->

                <div class="col-lg-7 mx-auto  border">
                  <div class="row">
                    <div class="col-lg-3 border-right pt-3 text-left">
                      <span id="siteayarfont">Copyright</span>
                    </div>
                    <div class="col-lg-9 p-1">
                      <input type="text" name="metacopy" class="form-control" value="<?php echo $sonuc["metacopy"];?>">
                    </div>
                  </div>
                </div>
                <!--************-->

                <div class="col-lg-7 mx-auto  border">
                  <div class="row">
                    <div class="col-lg-3 border-right pt-3 text-left">
                      <span id="siteayarfont">Logo Yazısı</span>
                    </div>
                    <div class="col-lg-9 p-1">
                      <input type="text" name="logoyazi" class="form-control" value="<?php echo $sonuc["logoyazisi"];?>">
                    </div>
                  </div>
                </div>
                <!--************-->

                <div class="col-lg-7 mx-auto  border">
                  <div class="row">
                    <div class="col-lg-3 border-right pt-3 text-left">
                      <span id="siteayarfont">Twitter</span>
                    </div>
                    <div class="col-lg-9 p-1">
                      <input type="text" name="twit" class="form-control" value="<?php echo $sonuc["twit"];?>">
                    </div>
                  </div>
                </div>
                <!--************-->

                <div class="col-lg-7 mx-auto  border">
                  <div class="row">
                    <div class="col-lg-3 border-right pt-3 text-left">
                      <span id="siteayarfont">Facebook</span>
                    </div>
                    <div class="col-lg-9 p-1">
                      <input type="text" name="face" class="form-control" value="<?php echo $sonuc["face"];?>">
                    </div>
                  </div>
                </div>
                <!--************-->

                <div class="col-lg-7 mx-auto  border">
                  <div class="row">
                    <div class="col-lg-3 border-right pt-3 text-left">
                      <span id="siteayarfont">İnstagram</span>
                    </div>
                    <div class="col-lg-9 p-1">
                      <input type="text" name="inst" class="form-control" value="<?php echo $sonuc["ints"];?>">
                    </div>
                  </div>
                </div>
                <!--************-->

                <div class="col-lg-7 mx-auto  border">
                  <div class="row">
                    <div class="col-lg-3 border-right pt-3 text-left">
                      <span id="siteayarfont">Telefon Numarası</span>
                    </div>
                    <div class="col-lg-9 p-1">
                      <input type="text" name="telno" class="form-control" value="<?php echo $sonuc["telefonno"];?>">
                    </div>
                  </div>
                </div>
                <!--************-->

                <div class="col-lg-7 mx-auto  border">
                  <div class="row">
                    <div class="col-lg-3 border-right pt-3 text-left">
                      <span id="siteayarfont">Adres</span>
                    </div>
                    <div class="col-lg-9 p-1">
                      <input type="text" name="adres" class="form-control" value="<?php echo $sonuc["adres"];?>">
                    </div>
                  </div>
                </div>
                <!--************-->

                <div class="col-lg-7 mx-auto  border">
                  <div class="row">
                    <div class="col-lg-3 border-right pt-3 text-left">
                      <span id="siteayarfont">Mail Adresi</span>
                    </div>
                    <div class="col-lg-9 p-1">
                      <input type="text" name="mailadres" class="form-control" value="<?php echo $sonuc["mailadres"];?>">
                    </div>
                  </div>
                </div>
                <!--************-->

                <div class="col-lg-7 mx-auto  border">
                  <div class="row">
                    <div class="col-lg-3 border-right pt-3 text-left">
                      <span id="siteayarfont">Slogan</span>
                    </div>
                    <div class="col-lg-9 p-1">
                      <input type="text" name="slogan" class="form-control" value="<?php echo $sonuc["slogan"];?>">
                    </div>
                  </div>
                </div>
                <!--************-->

                <div class="col-lg-7 mx-auto  border">
                  <div class="row">
                    <div class="col-lg-3 border-right pt-3 text-left">
                      <span id="siteayarfont">Referans Başlık</span>
                    </div>
                    <div class="col-lg-9 p-1">
                      <input type="text" name="refsayfabas" class="form-control" value="<?php echo $sonuc["referansbaslik"];?>">
                    </div>
                  </div>
                </div>
                <!--************-->

                <div class="col-lg-7 mx-auto  border">
                  <div class="row">
                    <div class="col-lg-3 border-right pt-3 text-left">
                      <span id="siteayarfont">Filo Başlık</span>
                    </div>
                    <div class="col-lg-9 p-1">
                      <input type="text" name="filosayfabas" class="form-control" value="<?php echo $sonuc["filobaslik"];?>">
                    </div>
                  </div>
                </div>
                <!--************-->

                <div class="col-lg-7 mx-auto  border">
                  <div class="row">
                    <div class="col-lg-3 border-right pt-3 text-left">
                      <span id="siteayarfont">Yorum Başlık</span>
                    </div>
                    <div class="col-lg-9 p-1">
                      <input type="text" name="yorumsayfabas" class="form-control" value="<?php echo $sonuc["yorumbaslik"];?>">
                    </div>
                  </div>
                </div>
                <!--************-->

                <div class="col-lg-7 mx-auto  border">
                  <div class="row">
                    <div class="col-lg-3 border-right pt-3 text-left">
                      <span id="siteayarfont">İletişim Başlık</span>
                    </div>
                    <div class="col-lg-9 p-1">
                      <input type="text" name="iletisimsayfabas" class="form-control" value="<?php echo $sonuc["iletisimbaslik"];?>">
                    </div>
                  </div>
                </div>
                <!--************-->

                <div class="col-lg-7 mx-auto mt-2 border-bottom">
                  <input type="submit" name="buton" class="btn btn-info m-1" value="GÜNCELLE">
                </div>



              </div>


            </form>
      <?php
    endif;

  }














}

?>
