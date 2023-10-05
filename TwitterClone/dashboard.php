<?php
require('connect.php');
session_start();
if (empty($_SESSION['username'])) {
  Header('Location:login.php');
  exit();
}
$adtutamac = $_SESSION['username'];
$_SESSION['button_clicked'] = true;
try {      //giriş yaptığımızda altta hesaba girişin olduğuna dair 
  $baglanti = new PDO("mysql:host=localhost;dbname=twitterclone", "root", "");
  $baglanti->exec("SET NAMES utf8");
  $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die($e->getMessage());
}

$tweet = $baglanti->query("SELECT * FROM tweets")->fetchALL(PDO::FETCH_ASSOC);
$baglanti = null;

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.108.0">
  <title>Anasayfa</title>
  <link href="nav.css" rel="stylesheet">
  <link href="timeline.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"><!---bootsrap çalıştırmak için link-->
  <link href="sidebars.css" rel="stylesheet">
  <style>
    /* Dropup Button */
    .dropbtn {
      background-color: #f8f9fa;
      color: black;
      padding: 16px;
      font-size: 16px;
      border: none;
      position: relative;
      top: -5px;
    }

    /* The container <div> - needed to position the dropup content */
    .dropup {
      position: relative;
      display: inline-block;
    }

    /* Dropup content (Hidden by Default) */
    .dropup-content {
      display: none;
      position: absolute;
      bottom: 50px;
      background-color: #f8f9fa;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
      z-index: 1;
    }

    /* Links inside the dropup */
    .dropup-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }

    /* Change color of dropup links on hover */
    .dropup-content a:hover {
      background-color: #f8f9fa;
    }

    /* Show the dropup menu on hover */
    .dropup:hover .dropup-content {
      display: block;
    }


    /* Change the background color of the dropup button when the dropup content is shown */
    .dropup:hover .dropbtn {
      background-color: #f8f9fa;
    }
  </style>

</head>

<body style="background-color:#f8f9fa;">
  <!--  Navbar başlangıcı-->
  <div class="b-example-divider b-example-vr"></div>

  <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;left: 0px;background-color:#f8f9fa;position:fixed;">
    <a href="dashboard.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
      <svg class="bi pe-none me-2" width="40" height="32">
        <use xlink:href="#bootstrap"></use>
      </svg>
      <span class="fs-4"><img src="img/icons8-twitter-48.png" alt="">
      </span>
    </a>

    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="#" class="nav-link link-dark" aria-current="page"">
          <svg class=" bi pe-none me-2" width="16" height="16">
          <use xlink:href="#home"></use></svg>
          <img src="img/icons8-home-28.png" alt="">
          Anasayfa
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link link-dark" aria-current="page" ">
          <svg class=" bi pe-none me-2" width="16" height="16">
          <use xlink:href="#home"></use></svg>
          <img src="img/icons8-hashtag-28.png" alt="">
          Keşfet
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link link-dark" aria-current="page">
          <svg class="bi pe-none me-2" width="16" height="16">
            <use xlink:href="#home"></use>
          </svg>
          <img src="img/icons8-notification-28.png" alt="">
          Bildirimler
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link link-dark" aria-current="page">
          <svg class="bi pe-none me-2" width="16" height="16">
            <use xlink:href="#home"></use>
          </svg>
          <img src="img/icons8-message-read-28.png" alt="">
          Mesajlar
        </a>
      </li>
      <li>
        <a href="#" class="nav-link link-dark">
          <svg class="bi pe-none me-2" width="16" height="16">
            <use xlink:href="#speedometer2"></use>
          </svg>
          <img src="img/icons8-bookmark-outline-28.png" alt="">
          Yer İşaretleri
        </a>
      </li>
      <li>
        <a href="#" class="nav-link link-dark">
          <svg class="bi pe-none me-2" width="16" height="16">
            <use xlink:href="#table"></use>
          </svg>
          <img src="img/icons8-list-view-28.png" alt="">
          Listeler
        </a>
      </li>
      <li>
        <a href="profile.php" class="nav-link link-dark">
          <svg class="bi pe-none me-2" width="16" height="16">
            <use xlink:href="#grid"></use>
          </svg>
          <img src="img/icons8-customer-28.png" alt="">
          Profil
        </a>
      </li>
      <li>
        <a href="#" class="nav-link link-dark">
          <svg class="bi pe-none me-2" width="16" height="16">
            <use xlink:href="#people-circle"></use>
          </svg>
          <img src="img/icons8-view-more-28.png" alt="">
          Daha Fazlası
        </a>
      </li>
      <!--tweetle butonu-->
      <button type="button" onclick="window.location.href='tweetle.php'" class="btn btn-primary btn-lg" style="border-radius: 75px; width:250px">Twettle</button>
    </ul><br>


    <br>
    <hr>
    <!--dropup başlangıcı-->
    <div class="dropup">
      <button class="dropbtn"><img src="img/vogayer.jpg" alt="" width="32" height="32" class="rounded-circle me-2" style="margin:10px;"><?php echo "<b> &nbsp; " . $adtutamac . "</br>"; ?><img src="img/icons8-arrow-18.png" style="position: relative;top:-38px;left:90px;" width="18px" height="18px"></button>
      <div class="dropup-content">
        <a href="#">Ayarlar</a>

        <a href="logout.php">Çıkış Yap</a>
      </div>
    </div>


  </div>

  <div class="input-group mb-3" style="width:350px;position:fixed;position: absolute;right: 0px;margin:10px;"> <!--style="float:right;  width:350px; position:fixed;"-->
    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Twitter'da ara" style="background-color:#f8f9fa;border-radius:15px;">
  </div>
  <div class="b-example-divider b-example-vr"></div>
  <br>
  <br> <!--Timeline kısmı-->
  <div class="overflow-hiddesn">
    <div class="timeline" style="box-shadow:yellow;">
      <form action="tweet.php" method="POST"> <!--Tweet form'u başlangıcı-->
        <div class="anasayfa">
          <h4 class="left:-10px;position:relative;font-size:20px;font-family: Georgia, serif;">Anasayfa</h4>
        </div>
        <div class="tweet">
          <div class="form-floating">
            <div class="photo">
              <?php echo "<b> &nbsp; " . $adtutamac . "</br>"; ?>
              <img src="img/vogayer.jpg" alt="" width="42" height="42" class="rounded-circle me-2" style="margin:10px;">
            </div>
            <!--Tweet yazılacak alan-->
            <textarea name="tweetle" class="form-control" id="floatingTextareaDisabled" placeholder="Neler Oluyor?" style="
            top: -60px;
            left: 20px; 
            width: 540px;
            height: 100px;
            padding: 10px;
            margin: 10px;
            padding: 30px;
            background-color:#f8f9fa;
            float: left;
            position:absolute;
            resize:none;
            border:1px  #e9e9e9;">

    </textarea>
            <label for="floatingTextarea2"></label>
            <br>
            <img src="img/icons8-gallery-18.png" alt="" style="top:-70px;position:relative;left:10px;"><label for=""> &nbsp;&nbsp;&nbsp;</label>
            <img src="img/icons8-gif-18.png" alt="" style="top:-70px;position:relative;left:10px;"><label for=""> &nbsp;&nbsp;&nbsp;</label>
            <img src="img/icons8-questionnaire-18.png" alt="" style="top:-70px;position:relative;left:10px;"><label for=""> &nbsp;&nbsp;&nbsp;</label>
            <img src="img/icons8-happy-18.png" alt="" style="top:-70px;position:relative;left:10px;"><label for=""> &nbsp;&nbsp;&nbsp;</label>
            <img src="img/icons8-schedule-18.png" alt="" style="top:-70px;position:relative;left:10px;"><label for=""> &nbsp;&nbsp;&nbsp;</label>
            <img src="img/icons8-location-18.png" alt="" style="top:-70px;position:relative;left:10px;"><label for=""> &nbsp;&nbsp;&nbsp;</label>
            <br>
            <!--tweetle butonu-->
            <button type="submit" class="btn btn-primary btn-lg" style="top:-95px;border-radius: 75px; width:100px;height:35px;position:relative;margin:10px;left:450px;font-size:16px;" value="1">Twettle</button>

          </div>
      </form>
      <!--Verileri çekeceğimiz yer-->

      <?php foreach ($tweet as $key => $dutamac) { ?>
        <table class="table table-borderless" style="position:relative;top:-120px;left:-30px;width:560px;margin:0px;">
          <thead>
            <tr>
              <th scope="col"><img src="img/vogayer.jpg" alt="" width="50" height="50" class="rounded-circle me-2"></th>
              <th scope="col" style="position:relative;left:-150px;top: -10px;height: 18px;"><?php echo "     \t" . $dutamac['username']; ?></th>
              <th style="position: relative;left:120px;"><!--drowdown başlangıcı-->
                <nav class="navbar navbar-expand-lg" style="background-color:f9f8fa;">
                  <div class="container-fluid" style="background-color:f9f8fa;">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" style="background-color:f9f8fa;" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon" style="background-color:f9f8fa;"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDarkDropdown" style="background-color:f9f8fa;">
                      <ul class="navbar-nav" style="background-color:f9f8fa;">
                        <li class="nav-item dropdown" style="background-color:f9f8fa;">
                          <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true" style="background-color: #f8f9fa;border:1px solid transparent;">
                            <img src="img/icons8-three-dots-28.png" width="20" height="20" alt="">
                          </button>
                          <ul class="dropdown-menu dropdown-menu-dark" style="background-color:f9f8fa;">
                            <li style="background-color:f9f8fa;"><a class="dropdown-item" href="tweetduzenle.php?goruntuleID=<?php echo $dutamac['id']; ?>">Tweeti Düzenle</a></li>
                            <li style="background-color:f9f8fa;"><a class="dropdown-item" href="tweetsil.php?goruntuleID=<?php echo $dutamac['id']; ?>">Tweeti sil</a></li>
                          </ul>
                        </li>
                      </ul>
                    </div>
                  </div>
                </nav>
              </th>
            </tr>
          </thead>  
          <tbody>
            <tr>
              <th scope="row"><label for=""><?php echo $dutamac['tweet']; ?></label></th>
              <br>
            </tr>
            <tr>
              <th scope="row">
                <img src="img/icons8-comments-30.png" style="position:relative;left:100px;" width="30" height="30" alt="">
                <img src="img/icons8-retweet-30.png" style="position:relative;left:200px;" width="30" height="30" alt="">
                <img src="img/icons8-love-30.png" style="position:relative;left:300px;" width="30" height="30" alt="">
              </th>
            </tr>
          </tbody>
        </table>
        <div style="width:550;height:1px;border:0.5px solid #cdd1ce;position:relative;top: -115px;">
        </div>
        <br>
      <?php } ?>

    </div>
  </div>
  </div>
  <!--Hastag kısmı-->
  <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white" style="margin:10px;padding:10px;float: right; width: 350px;background-color:#f8f9fa;border-radius:20px;border-width:80px">
    <a href="/" class="d-flex align-items-center flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
      <svg class="bi pe-none me-2" width="30" height="24">
        <use xlink:href="#bootstrap" />
      </svg>
      <h6 style="text-align:left;">İlgini Çekebilcek Gündemler</h6>
    </a>
    <div class="list-group list-group-flush border-bottom scrollarea">
      <a href="#" class="list-group-item list-group-item-action py-3 lh-sm" aria-current="true">
        <div class="d-flex w-100 align-items-center justify-content-between">
          <strong class="mb-1">#ElonMusk.</strong>
          <small class="text-muted"><img src="img/icons8-view-more-18.png" alt=""></small>
        </div>
        <div class="col-10 mb-1 small">21.000 Tweet</div>
      </a>
      <a href="#" class="list-group-item list-group-item-action py-3 lh-sm">
        <div class="d-flex w-100 align-items-center justify-content-between">
          <strong class="mb-1">#BillGates</strong>
          <small class="text-muted"><img src="img/icons8-view-more-18.png" alt=""></small>
        </div>
        <div class="col-10 mb-1 small">10.425 Tweet</div>
      </a>
      <a href="#" class="list-group-item list-group-item-action py-3 lh-sm">
        <div class="d-flex w-100 align-items-center justify-content-between">
          <strong class="mb-1">Galatasaray</strong>
          <small class="text-muted"><img src="img/icons8-view-more-18.png" alt=""></small>
        </div>
        <div class="col-10 mb-1 small">5.722 tweet</div>
      </a>

      <a href="#" class="list-group-item list-group-item-action py-3 lh-sm" aria-current="true">
        <div class="d-flex w-100 align-items-center justify-content-between">
          <strong class="mb-1">Gündem1</strong>
          <small class="text-muted"><img src="img/icons8-view-more-18.png" alt=""></small>
        </div>
        <div class="col-10 mb-1 small">3.200 Tweet</div>
      </a>
      <a href="#" class="list-group-item list-group-item-action py-3 lh-sm">
        <div class="d-flex w-100 align-items-center justify-content-between">
          <strong class="mb-1">#Gündem2</strong>
          <small class="text-muted"><img src="img/icons8-view-more-18.png" alt=""></small>
        </div>
        <div class="col-10 mb-1 small">5.345 Tweet</div>
      </a>
      <a href="#" class="list-group-item list-group-item-action py-3 lh-sm">
        <div class="d-flex w-100 align-items-center justify-content-between">
          <strong class="mb-1">#Gündem3</strong>
          <small class="text-muted"><img src="img/icons8-view-more-18.png" alt=""></small>
        </div>
        <div class="col-10 mb-1 small">1 Tweet</div>
      </a>
      <a href="#" class="list-group-item list-group-item-action py-3 lh-sm" aria-current="true">
        <div class="d-flex w-100 align-items-center justify-content-between">
          <strong class="mb-1">#Gündem4</strong>
          <small class="text-muted"><img src="img/icons8-view-more-18.png" alt=""></small>
        </div>
        <div class="col-10 mb-1 small"></div>
      </a>
    </div>
    </a>
  </div>
  <script src="popper.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"></script><!--dropdown çalıştırmak için yazılan js-->
  <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <script src="sidebars.js"></script>
  <script></script>
</body>
</html>