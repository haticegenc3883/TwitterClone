<?php
session_start();

if (!empty($_SESSION['username']))
{
    Header('Location:dashboard.php');
    exit();
}
$username=$_POST['username'] ?? null;
$password=$_POST['password'] ?? null;

$hata_mesaji = '';

$dogrulama = [
    'username_icin' => [
        'class' => null,
        'mesaj' => null
    ],
    'password_icin' => [
        'class' => null,
        'mesaj' => null
    ]
    ];

if ($_POST)
{
require_once('connect.php');
$db = new Db();

$db = $db->connect();
$ifade = "Select * from users where username = :username";
$sorgu = $db->prepare($ifade);
$sorgu->bindparam("username",$username);
$sorgu->execute();
$kullanici = $sorgu->fetch(PDO::FETCH_ASSOC);
$db = null;

if ($kullanici)
{
    if ($kullanici[''] === $password)
    {
        $username = $kullanici['username'];
        $_SESSION['username'] = $username;
        Header('Location:dashboard.php');
        exit();

    }
    else
    {
    $dogrulama['password_icin']['class'] = 'is-invalid';
    $dogrulama['password_icin']['mesaj'] = 'Hatalı Şifre !';
    $dogrulama['username_icin']['class'] = 'is-valid';
    $dogrulama['username_icin']['mesaj'] = '';
    }
}
else
{
    $dogrulama['username_icin']['class'] = 'is-invalid';
    $dogrulama['username_icin']['mesaj'] = 'Hatalı Kullanıcı Adı !';
    $dogrulama['password_icin']['class'] = 'is-valid';
    $dogrulama['password_icin']['mesaj'] = '';

}
}
?>
<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <title>Login</title>
</head>
<body  class="h-100 d-flex align-items-center" style="background-color: #999999;">
<div class="mx-auto" style="width:600px;height:550px;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; border-radius: 15px; background-color:white;" >
<br>
<button type="button" class="btn-close" aria-label="Close"style=" margin-left: 2%; margin-right:2%; "></button>
<img src="img/icons8-twitter-48.png" style="margin-left: 45%; margin-right:45%; ">
<br>
<br>
<br>
<form action="login.php" method="post" style=" margin-left: 20%; margin-right:20%; ">
<h2 >Twitter'a giriş yap</h2>
<br>
    <div class="mb-3">
    <label for="username">Kullanıcı Adı</label>
    <input class="form-control form-control-lg <?php echo $dogrulama['username_icin']['class'];?>" type="text" placeholder="kullanıcı adı"   name="username" required>   <!--kullanıcı adı girişi textbox -->
    <div class="text-danger"><?php echo $dogrulama['username_icin']['mesaj'];?></div>
    </div>   
    <div class="mb-3">
    <label for="password">Şifre</label>
    <br>
    <input type="password" class="form-control form-control-lg <?php echo $dogrulama['password_icin']['class'];?>" id="inputPassword4"> <br/>    <!--şifre girişi textbox -->
    <div class="text-danger"><?php echo $dogrulama['password_icin']['mesaj']; ?></div>
    </div> 
    <input class="btn btn-primary w-100" type="submit" value="Giriş" style="background-color:#272c30;border-color:#272c30;">    <!--giriş yapma textbox -->
    <br>
    <br>
    <h6>Henüz bir hesabın yok mu?
    <a href="register.php"> Kaydol</a></h6>
    </form>
</div>
</body>
</html>