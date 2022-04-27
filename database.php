<?php

//veritabanı bağlantısı için gerekli connectionstring, kullanıcı adı ve şifre bilgilerini constant olarak tanımlıyoruz.
define('CONNECTIONSTRING', 'mysql:host=localhost;dbname=ornekveritabani; charset=utf8');
define('USERNAME','root');
define('PASSWORD','');

function baglan() //veritabanı bağlantısını sağlamak için oluşturduğumuz fonksiyon.
{
    try
    {
        $baglanti = new PDO(CONNECTIONSTRING,USERNAME,PASSWORD);
        $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $baglanti;
    }
    catch(exception $e)
    {
        echo "Veritabanı bağlantı hatası : ". $e->getMessage();
    }
}

?>