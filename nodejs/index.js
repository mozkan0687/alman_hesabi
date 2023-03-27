/**
* Alman Hesabı
* @author   Mustafa ÖZKAN
* @author   Mustafa ÖZKAN <ozkanmustafa@live.com>
* @datetime 27 Mart 2023
*/
const readline = require('readline')
const rl = readline.createInterface({
    input:process.stdin,
    output:process.stdout,
    terminal: false,
    
});

try{
  
    rl.question('' , (input) => {
    let ilk_satir = input.trim().split(' ');
    let yemek_sayisi = parseInt(ilk_satir[0]); 
    let yemedigi_yemek_indexi = parseInt(ilk_satir[1]); 

    if(!control(1,yemek_sayisi,Math.pow(10,5)))
         throw new Error("Yemek sayısı 2 ile " + (Math.pow(10,5)-1) + " aralığında olmalıdır.\n");
    if(!control(1,yemedigi_yemek_indexi,yemek_sayisi,true))
        throw new Error("Ali'nin yemediği yemek sayısı 1 ile " + yemek_sayisi + " aralığında olmalıdır.\n");


    rl.question('' , (input) => {
        let yemek_gecici = input.trim().split(' ');
        let yemek_ucretleri = yemek_gecici.map(ucret => parseInt(ucret)); 
        
        
        rl.question('' , (input)=> {
            let odedigi_ucret = parseInt(input);
            if(odedigi_ucret < 0)
                throw new Error("Ali'nin ödediği ücret 0'dan büyük olmalıdır");
           afiyetOlsun(yemek_ucretleri,yemedigi_yemek_indexi,odedigi_ucret); 
           rl.close();
        });
    });
    
});




}catch(e)
{

    console.log(e.message)
}
function afiyetOlsun(yemek_ucretleri,yemedigi_yemek_indexi,odedigi_ucret)
{
    let toplam = 0;
    for(let i = 0; i<yemek_ucretleri.length; i++)
    {
        if(!control(0,yemek_ucretleri[i],Math.pow(10,4)))
        throw new Error(yemek_ucretleri[i]+ " Geçersiz yemek ücreti. Yemek ücreti 0 ile "+ Math.pow(10,4)+" aralığında olmalıdır\n ")
        if (i != yemedigi_yemek_indexi)
        toplam += yemek_ucretleri[i];
    }
    let aliye_dusen = toplam /2;
    let sonuc = odedigi_ucret == aliye_dusen ? "Afiyet Olsun\n" : odedigi_ucret-aliye_dusen
    console.log(sonuc);

}
function control(altlimit,sayi,ustlimit,esitlik = false)
{
    if(esitlik)
        return sayi >= altlimit  && sayi <= ustlimit;
    else
        return sayi > altlimit  && sayi < ustlimit;
}



