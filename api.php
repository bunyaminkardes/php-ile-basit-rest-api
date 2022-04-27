<?php

header("Content-Type:application/json");
include("database.php");

$method = $_SERVER['REQUEST_METHOD']; //gelen isteğin türünü method adlı değişkende saklayalım.

if($method == 'GET')
{
    $id = $_GET['id'];
    $baglanti = baglan();
    $sorgu = $baglanti->prepare("SELECT * FROM bilgisayarlar WHERE id=:id");
    $sorgu->bindParam(":id",$id);
    $sorgu->execute();
    $sonuc = $sorgu->fetch();
    $dizi = array(
        "id" => intval($sonuc['id']),
        "marka" => $sonuc['marka'],
        "model" => $sonuc['model'],
        "islemci" => $sonuc['islemci'],
        "ram" => $sonuc['ram'],
        "ekranKarti" => $sonuc['ekranKarti'],
        "isletimSistemi" => $sonuc['isletimSistemi']
    );
    echo json_encode($dizi,JSON_PRETTY_PRINT);
}
else if($method == 'POST')
{

}
else if($method == 'PUT')
{

}
else if($metgod == 'DELETE')
{

}


?>