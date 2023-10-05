<?php
session_start();
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
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>tweetle</title>
  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/modals/">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link href="/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
  <div class="modal modal-sheet position-static d-block bg-secondary py-5" tabindex="-1" role="dialog" id="modalSheet" style="background-color:#70747c;height: 697px;">
    <div class="modal-dialog" role="document">
      <div class="modal-content rounded-4 shadow" style="height: 400px;width:600px;margin:0px;position:relative;left:-40px;">
        <form action="tweet.php" method="POST">
          <div class="tweet">
            <div class="form-floating">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position:relative;top:10px;left: 10px;" onclick="window.location.href='dashboard.php'"></button>
              <div class="photo">
                <label for="" style="position:relative;top: 35px;left:100px;margin:10px;">
                  <?php
                  echo "<b> &nbsp; " . $adtutamac . "</br>";
                  ?></label>
                <img src="img/vogayer.jpg" alt="" width="50" height="50" class="rounded-circle me-2" style="position:relative;top:35px;left:-75px;margin:10px;">
              </div>
              <!--Tweet yazılacak alan-->
              <textarea name="tweetle" class="form-control" id="floatingTextareaDisabled" placeholder="Neler Oluyor?" style="top: 120px;left: 20px; width: 540px;height: 150px;padding: 10px;margin: 10px;padding: 30px;background-color:#f8f9fa;float: left;position:absolute;resize:none;border:1px  #e9e9e9;"></textarea>
              <label for="floatingTextarea2"></label>
              <br>
              <div style="position:relative;top:-50px;">
                <img src="img/icons8-gallery-18.png" alt="" style="top:240px;position:relative;left:100px;"><label for=""> &nbsp;&nbsp;&nbsp;</label>
                <img src="img/icons8-gif-18.png" alt="" style="top:240px;position:relative;left:100px;"><label for=""> &nbsp;&nbsp;&nbsp;</label>
                <img src="img/icons8-questionnaire-18.png" alt="" style="top:240px;position:relative;left:100px;"><label for=""> &nbsp;&nbsp;&nbsp;</label>
                <img src="img/icons8-happy-18.png" alt="" style="top:240px;position:relative;left:100px;"><label for=""> &nbsp;&nbsp;&nbsp;</label>
                <img src="img/icons8-schedule-18.png" alt="" style="top:240px;position:relative;left:100px;"><label for=""> &nbsp;&nbsp;&nbsp;</label>
                <img src="img/icons8-location-18.png" alt="" style="top:240px;position:relative;left:100px;"><label for=""> &nbsp;&nbsp;&nbsp;</label>
                <br>
                <!--tweetle butonu-->
                <button type="submit" class="btn btn-primary btn-lg" style="top:230px;border-radius: 75px; width:100px;height:35px;position:relative;margin:10px;left:450px;font-size:16px;" value="1">Twettle</button>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>
  <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>