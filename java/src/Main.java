import java.util.Arrays;
import java.util.Scanner;
import static java.lang.Integer.parseInt;
/**
 * Alman Hesabı
 * @author   Mustafa ÖZKAN
 * @author   Mustafa ÖZKAN <ozkanmustafa@live.com>
 * @datetime 27 Mart 2023
 */
public class Main {
    public static void main(String[] args) {

        Scanner scanner = new Scanner(System.in);
        try{
            String[] ilk_satir = scanner.nextLine().trim().split(" ");
            int yemek_sayisi = parseInt(ilk_satir[0]);
            int yemedigi_yemek_indexi = parseInt(ilk_satir[1]);
            int[] yemek_ucretleri = Arrays.stream(scanner.nextLine().trim().split(" ")).mapToInt(Integer::parseInt).toArray();
            int odedigi_ucret = parseInt(scanner.nextLine().trim());
           if(!control(1,yemek_sayisi,Math.pow(10,5),false))
               throw new Exception("Error: Yemek sayısı 2 ile " +Math.pow(10,5)+" aralığında olmalıdır.");
           if(!control(1,yemedigi_yemek_indexi,yemek_sayisi,true))
               throw new Exception("Error: Ali'nin yemediği yemek sayısı 1 ile " +yemek_sayisi+" aralığında olmalıdır.");
           if(odedigi_ucret < 0)
               throw new  Exception("Error: Ali'nin ödediği ücret 0'dan büyük olmalıdır");
            afiyetOlsun(yemek_ucretleri,yemedigi_yemek_indexi,odedigi_ucret);
        }catch (Exception e)
        {
            System.out.println(e.getMessage());
        }
    }

    public static void afiyetOlsun(int[] yemek_ucretleri , int yemedigi_yemek_indexi, int odedigi_ucret) throws Exception {
        double toplam = 0;
        for(int i=0; i < yemek_ucretleri.length; i++)
        {
            if(!control(0,yemek_ucretleri[i],Math.pow(10,4) ,true))
                throw new Exception("Error: "  + yemek_ucretleri + "Geçersiz yemek ücreti. Yemek ücreti 0 ile " + Math.pow(10,4) + " aralığında olmalıdır");
            if(i != yemedigi_yemek_indexi)
                toplam += yemek_ucretleri[i];
        }
        double aliye_dusen = toplam / 2;
        System.out.println(odedigi_ucret == aliye_dusen ? "Afiyet Olsun" : String.valueOf(Math.round(odedigi_ucret-aliye_dusen) ));
    }

    public static boolean control(double altlimit, double sayi, double ustlimit, boolean esitlik ) {
        if(esitlik)
            return sayi >= altlimit && sayi <= ustlimit;
        else
            return sayi > altlimit && sayi < ustlimit;
    };

}