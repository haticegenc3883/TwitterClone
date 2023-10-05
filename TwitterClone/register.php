<?php
session_start();  // Yeni bir oturum başlatır veya eskisini yeniden devreye sokar
if (!empty($_SESSION['username']))
{
    Header('Location:dashboard.php');
    exit();
}
include('connect.php'); //require_once ifadesi, dosyayı evvelce dahil edilmişse tekrar dahil etmemesi dışında require deyimiyle aynıdır.
$baglanti = new PDO("mysql:host=localhost;dbname=twitterclone", "root", "");
  $baglanti->exec("SET NAMES utf8");
  $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if ($_POST)
{
$username=$_POST['username'] ?? null;
$password=$_POST['password'] ?? null;


$sorgu = $baglanti->prepare("Select * from users where username = :username");
$sorgu->bindparam(":username",$username,PDO::PARAM_STR);  //bindParam kullanılmasının en büyük avantajı sqlinjection’a karşı ek bir güvenlik sağlamaktır.
$sorgu->execute();
$kullanici = $sorgu->fetch(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC: Sütun isimlerine indisli bir dizi döner.
$db = null;
if ($kullanici)
{
    $hata_mesaji = "Bu kullanıcı adı kullanılıyor !";
}
else
{
$ifade = "INSERT INTO users (username,password) VALUES (:username,:password)";
$sorgu2 = $baglanti->prepare($ifade);
$sorgu2->bindparam(":username",$username);
$sorgu2->bindparam(":password",$password);
$sorgu2->execute();
$_SESSION['username'] = $username;
Header('Location:dashboard.php');
exit();
}}
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
<div class="mx-auto overflow-auto" style="width:600px;height:550px;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; border-radius: 15px; background-color:white;" >
<br>
<button type="button" class="btn-close" aria-label="Close"style=" margin-left: 2%; margin-right:2%; "></button>
<br>
<form action="register.php" method="post" style=" margin-left: 15%; margin-right:15%; padding:10px; ">
<h2 >Hesabını oluştur</h2>
<br>
    <div class="mb-3">
    <input class="form-control form-control-lg" type="text" placeholder="Kullanıcı Adı"   name="username" required>
    <div class="text-danger"></div>
    </div>   
    <div class="mb-3">
    <br>
    <input type="password" class="form-control form-control-lg" id="inputPassword4" placeholder="Şifre giriniz" name="password"> <br/>
    <div class="text-danger"></div>
    </div> 
    <label style="font-family: Verdana, Arial, sans-serif; font-size: 18px; font-weight:bold;">Doğum tarihi</label>
    <label style="font-family:Verdana, Arial, sans-serif; font-size: 15px;">Bu, herkese açık olarak gösterilmeyecek. Bu hesap bir işletme, evcil hayvan veya başka bir şey için olsa bile kendi yaşını doğrulaman gerekir.</label>
    <br>
    <div class="col-sm-7">
<select class="form-select" aria-label="Default select example" style="width: 70px;">
    <option selected>Ay</option>
    <option value="ocak">Ocak</option>
    <option value="subat">Şubat</option>
    <option value="mart">Mart</option>
    <option value="nisan">Nisan</option>
    <option value="mayis">Mayıs</option>
    <option value="haziran">Haziran</option>
    <option value="temmuz">Temmuz</option>
    <option value="agustos">Ağustos</option>
    <option value="eylul">Eylül</option>
    <option value="ekim">Ekim</option>
    <option value="kasim">Kasım</option>
    <option value="aralik">Aralık</option>
    </select>
    <select class="form-select" aria-label="Default select example" style="width: 80px;">
    <option selected>Gün</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="1">4</option>
    <option value="2">5</option>
    <option value="3">6</option>
    <option value="1">7</option>
    <option value="2">8</option>
    <option value="3">9</option>
    <option value="1">10</option>
    <option value="2">11</option>
    <option value="3">12</option>
    <option value="1">13</option>
    <option value="2">14</option>
    <option value="3">15</option>
    <option value="">16</option>
    <option value="3">17</option>
    <option value="3">18</option>
    <option value="3">19</option>
    <option value="3">20</option>
    <option value="3">21</option>
    <option value="3">22</option>
    <option value="3">23</option>
    <option value="3">24</option>
    <option value="3">25</option>
    <option value="3">26</option>
    <option value="3">27</option>
    <option value="3">28</option>
    <option value="3">29</option>
    <option value="3">30</option>
    <option value="3">31</option>
    </select>
    <select class="form-select" aria-label="Default select example" style="width: 70px;">
    <option selected>Yıl</option>
    <option value="1">2022</option>
    <option value="2">2021</option>
    <option value="3">2020</option>
    <option value="1">2019</option>
    <option value="2">2018</option>
    <option value="3">2017</option>
    <option value="1">2016</option>
    <option value="2">2015</option>
    <option value="3">2014</option>
    <option value="1">2013</option>
    <option value="2">2012</option>
    <option value="3">2011</option>
    <option value="1">2010</option>
    <option value="2">2009</option>
    <option value="3">2008</option>
    <option value="1">2007</option>
    <option value="2">2006</option>
    <option value="3">2005</option>
    <option value="1">2004</option>
    <option value="2">2003</option>
    <option value="3">2002</option>
    <option value="1">2001</option>
    <option value="2">1999</option>
    <option value="3">1998</option>
    <option value="1">1997</option>
    <option value="2">1996</option>
    <option value="2">1995</option>
    <option value="3">1994</option>
    <option value="1">1993</option>
    <option value="2">1992</option>
    <option value="2">1991</option>
    <option value="3">1989</option>
    <option value="1">1988</option>
    <option value="2">1987</option>
</select></div>
    <br>
    <input class="btn btn-primary w-100" type="submit" value="Kaydol" style="background-color:#272c30;border-color:#272c30;">
    <br>
    <br>
    <h6>Zaten bir hesabın var mı?
    <a href="login.php">Giriş yap</a></h6>
    </form>
</div>
</body>
</html>