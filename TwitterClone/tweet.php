<?php 
session_start();
  require('connect.php');
$kullanicininAD = $_SESSION['username'];

if($kullanicininAD)
{
if($_POST['tweetle']!="")
{
  $txtboxx = $_POST['tweetle'];      
  $baglanti = new PDO("mysql:host=localhost;dbname=twitterclone", "root", "");
  $baglanti->exec("SET NAMES utf8");
  $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $idsorgutweet = $baglanti->prepare("SELECT * FROM users WHERE username = :username");  //username kullanarak id'yi çektim
  $idsorgutweet->bindParam("username", $kullanicininAD);
  $idsorgutweet->execute();
  $idciktitweet = $idsorgutweet->fetch(PDO::FETCH_ASSOC);    
  $idtutamactweet = $idciktitweet['id'];
  $adtutamactweet = $idciktitweet['username'];
  
  $zaman = time();    //tweet atılan zamanı çektik 
  $baglanti = new PDO("mysql:host=localhost;dbname=twitterclone", "root", "");

  $stmt = $baglanti->prepare("INSERT INTO tweets (username,user_id,tweet,timestampp) VALUES (:ad, :id, :tweet, :timestampp)");
  //kayıt sorgusu

  $stmt->bindParam("ad",$adtutamactweet);   
  $stmt->bindParam("id",$idtutamactweet);
  $stmt->bindParam("tweet",$txtboxx);
  $stmt->bindParam("timestampp",$zaman);

  $stmt->execute();
}
}
$baglanti = null;
Header('Location:dashboard.php');
?>