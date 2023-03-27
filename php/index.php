<?php
/**
* Alman Hesabı
* @author   Mustafa ÖZKAN
* @author   Mustafa ÖZKAN <ozkanmustafa@live.com>
* @datetime 27 Mart 2023
*/
try {
    
    $ilk_satir = explode(' ' , rtrim(fgets(STDIN)));
    $yemek_sayisi = intval($ilk_satir[0]);
    $yemedigi_yemek_indexi = intval($ilk_satir[1]); 

    $yemekler_gecici = rtrim(fgets(STDIN)); 
    $yemek_ucretleri = array_map('intval' ,preg_split('/ /', $yemekler_gecici, -1, PREG_SPLIT_NO_EMPTY));
    
    $odedigi_ucret = intval(trim(fgets(STDIN))); 
    
    if(!control(1,$yemek_sayisi,pow(10,5))) // Fonksiyon olarak yazabiliriz ya da aşağıdaki örnekte in_array ve range kullanarak yapılabilir.
        throw new ErrorException("Error: Yemek sayısı 2 ile ".(pow(10,5)-1). " aralığında olmalıdır\n" );
    
    if(!in_array($yemedigi_yemek_indexi ,range(1 , $yemek_sayisi)))
        throw new ErrorException("Error: Ali'nin yemediği yemek sayısı 1 ile ".$yemek_sayisi. "aralığında olmalıdır\n" );
    
    if($odedigi_ucret < 0)
        throw new ErrorException("Error: Ali'nin ödediği ücret 0'dan büyük tamsayı olmalıdır\n");

    afiyetOlsun($yemek_ucretleri,$yemedigi_yemek_indexi,$odedigi_ucret);

}catch (ErrorException $e)
{
    echo $e->getMessage();
}

function afiyetOlsun($yemek_ucretleri,$yemedigi_yemek_indexi,$odedigi_ucret)
{
    $toplam = 0;
    for($i=0; $i < count($yemek_ucretleri); $i++)
    {
        if(!control(0,$yemek_ucretleri[$i],pow(10,4), true))
        throw new ErrorException("Error: ".$yemek_ucretleri[$i]. " Geçersiz yemek ücreti. Yemek ücreti 0 ile ".pow(10,4)." aralığında olmalıdır\n");    
        if($i != $yemedigi_yemek_indexi)
        $toplam += $yemek_ucretleri[$i];
    }
    $aliye_dusen = $toplam / 2;
    echo $odedigi_ucret == $aliye_dusen ?  "Afiyet Olsun\n" :  $odedigi_ucret-$aliye_dusen."\n";
}

function control($altlimit , $sayi , $ustlimit , $esitlik = false)
{
    if($esitlik)
        return $sayi >= $altlimit && $sayi <= $ustlimit;
    else
        return $altlimit<$sayi && $ustlimit > $sayi;
}


?>