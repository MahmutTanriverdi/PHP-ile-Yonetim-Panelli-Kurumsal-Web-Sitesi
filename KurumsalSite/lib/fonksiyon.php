<?php
try {
   $baglanti = new PDO("mysql:host=localhost;dbname=kurumsal;charset=utf8", "root", "");
   $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
   die($e->getMessage());
}

class kurumsal
{
   public $normaltitle, $metatitle, $metdesc, $metakey, $metaout, $metaown, $metacopy, $logoyazi, $tvit, $face, $ints, $telno, $mailadres,
      $normaladres, $slogan, $referansbaslik, $filobaslik, $yorumbaslik, $iletisimbaslik;

   function __construct() //ayarlar geliyor
   {
      try {
         $baglanti = new PDO("mysql:host=localhost;dbname=kurumsal;charset=utf8", "root", "");
         $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (PDOException $e) {
         die($e->getMessage());
      }
      $ayarcek = $baglanti->prepare("select * from ayarlar");
      $ayarcek->execute();
      $sorguSon = $ayarcek->fetch();

      $this->normaltitle = $sorguSon["title"];
      $this->metatitle = $sorguSon["metatitle"];
      $this->metadesc = $sorguSon["metadesc"];
      $this->metakey = $sorguSon["metakey"];
      $this->metaout = $sorguSon["metaauthor"];
      $this->metaown = $sorguSon["metaowner"];
      $this->metacopy = $sorguSon["metacopy"];
      $this->logoyazi = $sorguSon["logoyazisi"];
      $this->tvit = $sorguSon["twit"];
      $this->face = $sorguSon["face"];
      $this->ints = $sorguSon["ints"];
      $this->telno = $sorguSon["telefonno"];
      $this->mailadres = $sorguSon["mailadres"];
      $this->normaladres = $sorguSon["adres"];
      $this->slogan = $sorguSon["slogan"];
      $this->referansbaslik = $sorguSon["referansbaslik"];
      $this->filobaslik = $sorguSon["filobaslik"];
      $this->yorumbaslik = $sorguSon["yorumbaslik"];
      $this->iletisimbaslik = $sorguSon["iletisimbaslik"];
   }

   function introbak($baglanti) //intro
   {
      $introal = $baglanti->prepare("select * from intro ");
      $introal->execute();

      while ($sonucum = $introal->fetch(PDO::FETCH_ASSOC)) {
         echo '<div class="item" style="background-image:url(' . $sonucum["resimyol"] . ');"></div>';
      };
      'endwhile';
   }

   function hakkimizda($baglanti) //hakkımızda bölümü
   {
      $introal = $baglanti->prepare("select * from hakkimizda ");
      $introal->execute();
      $sonucum = $introal->fetch();

      echo '<div class="row">
      <div class="col-lg-6 hakkimizda-img">
        <img src="' . $sonucum["resim"] . '" alt="' . $sonucum["resim"] . '-Hakkında">
      </div>

      <div class="col-lg-6 content">
        <h2>' . $sonucum["baslik"] . '</h2>
        <h3>' . $sonucum["icerik"] . '</h3>
      </div>

    </div>';
   }

   function hizmetler($baglanti) //hizmetler bölümü
   {
      $introal = $baglanti->prepare("select * from hizmetler ");
      $introal->execute();
      $sonucum = $introal->fetch();

      echo '<div class="section-header">
      <h2>HİZMETLERİMİZ</h2>
      <p>' . $sonucum["hizmetlerbaslik"] . '</p>
    </div>

    <div class="row">
      <div class="col-lg-6">
        <div class="box wow fadeInLeft">
          <div class="icon"><i class="fa fa-bar-chart"></i></div>
          <h4 class="title"><a href="#">' . $sonucum["baslik1"] . '</a></h4>
          <p class="description">' . $sonucum["icerik1"] . '</p>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="box wow fadeInRight">
          <div class="icon"><i class="fa fa-picture-o"></i></div>
          <h4 class="title"><a href="#">' . $sonucum["baslik2"] . '</a></h4>
          <p class="description">' . $sonucum["icerik2"] . '</p>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="box wow fadeInLeft">
          <div class="icon"><i class="fa fa-map"></i></div>
          <h4 class="title"><a href="#">' . $sonucum["baslik3"] . '</a></h4>
          <p class="description">' . $sonucum["icerik3"] . '</p>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="box wow fadeInRight">
          <div class="icon"><i class="fa fa-shopping-bag"></i></div>
          <h4 class="title"><a href="#">' . $sonucum["baslik4"] . '</a></h4>
          <p class="description">' . $sonucum["icerik4"] . '</p>
        </div>
      </div>

    </div>';
   }

   function referans($baglanti) //referans bölümü
   {
      $introal = $baglanti->prepare("select * from referanslar ");
      $introal->execute();

      echo '<div class="section-header">
      <h2>Referanslar</h2>
      <p>';
      echo $this->referansbaslik;
      echo '</p>
    </div>

    <div class="owl-carousel clients-carousel">';



      while ($sonucum = $introal->fetch(PDO::FETCH_ASSOC)) {
         echo '<img src="' . $sonucum["resimyol"] . '" alt="Referans - ' . $sonucum["id"] . '">';
      };
      'endwhile';

      echo '</div>';
   }

   function filomuz($baglanti) //filomuz bölümü
   {
      $introal = $baglanti->prepare("select * from filomuz ");
      $introal->execute();

      echo '<div class="container">
      <div class="section-header">
        <h2>Araçlarımız</h2>
        <p>';
        echo $this->filobaslik;
        echo '</p>
      </div>

      <div class="container-fluid">

        <div class="row no-gutters">';
        while ($sonucum = $introal->fetch(PDO::FETCH_ASSOC)) {
         echo '<div class="col-lg-3 col-md-4">
           <div class="filo-item wow fadeInUp">
             <a href="' . $sonucum["resimyol"] . '" class="filo-popup">
               <img src="' . $sonucum["resimyol"] . '" alt="Referans - ' . $sonucum["id"] . '">
               <div class="filo-overlay">
               </div>
             </a>
           </div>
         </div>';
      };
      'endwhile';

      echo '</div></div>';

      
   }

   function yorumlar($baglanti) //filomuz bölümü
   {
      $introal = $baglanti->prepare("select * from yorumlar ");
      $introal->execute();

      echo ' <div class="section-header">
      <h2>Müşteri Yorumları</h2>
      <p>';
      echo $this->yorumbaslik;
      echo '</p>
    </div>

    <div class="owl-carousel testimonials-carousel">';

    while ($sonucum = $introal->fetch(PDO::FETCH_ASSOC)) {
      echo ' <div class="testimonial-item">

      <p>
        <img src="img/sol.png" class="quote-sign-left" />
        ' . $sonucum["icerik"] . '
        <img src="img/sag.png" class="quote-sign-right" />
      </p>
      <img src="img/yorum.jpg" class="testimonial-img" alt="Müşteri Yorum - ' . $sonucum["id"] . '" />
      <h3>' . $sonucum["isim"] . '</h3>
    </div>';
   };
   'endwhile';

    echo '</div>';
      
   }


}
