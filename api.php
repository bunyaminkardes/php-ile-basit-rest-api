<?php

header("Content-Type:application/json");
include("database.php");

$method = $_SERVER['REQUEST_METHOD']; //gelen isteğin türünü method adlı değişkende saklayalım.

if($method == 'GET') //veri çekme için
{
    $id = $_GET['id'];
    $baglanti = baglan();
    $sorgu = $baglanti->prepare("SELECT * FROM bilgisayarlar WHERE id=:id");
    $sorgu->bindParam(":id",$id);
    $sorgu->execute();
    if($sorgu->rowCount()>0)
    {
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
        http_response_code(200);
        echo json_encode($dizi,JSON_PRETTY_PRINT);
    }
    else
    {
        http_response_code(404);
    }
}
else if($method == 'POST') //veri eklemek için
{
    $gelenJson = file_get_contents('php://input',true); //json verisi gelecekse bu şekilde veriyi alabiliriz.
    $gelenJsonVerisi = json_decode($gelenJson); //gelen json verisini decode işlemine sokalım.
    
    /*
    json_decode fonksiyonuna true parametresini eklemezsek gelen json verileri birer nesne olarak return edilir.
    eğer true eklersek bu kez de veriler associative array şeklinde return edilir.
    aşağıdaki kullanımın sebebi true parametresini eklemediğimiz için.
    */
    $marka = $gelenJsonVerisi->marka;
    $model = $gelenJsonVerisi->model;
    $islemci = $gelenJsonVerisi->islemci;
    $ram = $gelenJsonVerisi->ram;
    $ekranKarti = $gelenJsonVerisi->ekranKarti;
    $isletimSistemi = $gelenJsonVerisi->isletimSistemi;

    $baglanti = baglan();
    $sorgu = $baglanti->prepare("INSERT INTO bilgisayarlar(marka,model,islemci,ram,ekranKarti,isletimSistemi) VALUES(:marka,:model,:islemci,:ram,:ekranKarti,:isletimSistemi)");
    $sorgu->bindParam(":marka",$marka);
    $sorgu->bindParam(":model",$model);
    $sorgu->bindParam(":islemci",$islemci);
    $sorgu->bindParam(":ram",$ram);
    $sorgu->bindParam(":ekranKarti",$ekranKarti);
    $sorgu->bindParam(":isletimSistemi",$isletimSistemi);
    $sorgu->execute();

    if($sorgu->rowCount()>0)
    {
        http_response_code(204); //204 kodu alıyorsan işlem başarıyla gerçekleşti demektir.
    }
    else
    {
        http_response_code(400);
    }

}
else if($method == 'PUT') //veri güncellemek için
{
    $gelenJson = file_get_contents('php://input',true);
    $gelenJsonVerisi = json_decode($gelenJson);

    $id = $gelenJsonVerisi->id;
    $marka = $gelenJsonVerisi->marka;
    $model = $gelenJsonVerisi->model;
    $islemci = $gelenJsonVerisi->islemci;
    $ram = $gelenJsonVerisi->ram;
    $ekranKarti = $gelenJsonVerisi->ekranKarti;
    $isletimSistemi = $gelenJsonVerisi->isletimSistemi;

    $baglanti = baglan();
    $sorgu = $baglanti->prepare("UPDATE bilgisayarlar SET marka=:marka, model=:model, islemci=:islemci, ram=:ram, ekranKarti=:ekranKarti, isletimSistemi=:isletimSistemi WHERE id=:id");
    $sorgu->bindParam(":id",$id);
    $sorgu->bindParam(":marka",$marka);
    $sorgu->bindParam(":model",$model);
    $sorgu->bindParam(":islemci",$islemci);
    $sorgu->bindParam(":ram",$ram);
    $sorgu->bindParam(":ekranKarti",$ekranKarti);
    $sorgu->bindParam(":isletimSistemi",$isletimSistemi);
    $sorgu->execute();

    if($sorgu->rowCount()>0)
    {
        http_response_code(204);
    }
    else
    {
        http_response_code(400);
    }
}
else if($metgod == 'DELETE')
{

}


?>