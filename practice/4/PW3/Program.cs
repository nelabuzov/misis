using System;

namespace PW3
{
    class Ork
    {
        private static int population;
        public static int WalletOfGold;

        public Ork()
        {
            if (population < 5)
                WalletOfGold = WalletOfGold+2;
            else
                WalletOfGold = WalletOfGold-2;
            population++;
        }
    }

    class Program
    {
        static void Main(string[] args)
        {
            Ork ork1 = new Ork();
            Ork ork2 = new Ork();
            Ork ork3 = new Ork();
            Ork ork4 = new Ork();
            Ork ork5 = new Ork();
            Ork ork6 = new Ork();

            Console.WriteLine($"Количество переносимого золота: {Ork.WalletOfGold}");
            Console.ReadKey(true);
        }
    }
}
