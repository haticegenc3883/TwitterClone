<?php 
session_start();
require_once('connect.php');
$db = new Db();
$db = $db->connect();
$id = $_GET['goruntuleID'];
$tweetsahibi = "SELECT username From tweets Where id=:id";
$baslatici = $db->prepare($tweetsahibi);
$baslatici->bindParam("id",$id);
$baslatici->execute();
$kullaniciad = $_SESSION['username'];
$tweetsahibiad = $baslatici->fetch(PDO::FETCH_ASSOC);
if($kullaniciad === $tweetsahibiad['username'])
{
$sorgu = "DELETE FROM tweets WHERE id=:id";
$tetikleme = $db->prepare($sorgu);
$tetikleme->bindParam("id",$id);
$tetikleme->execute();
}
Header('Location:dashboard.php');
exit();
?>