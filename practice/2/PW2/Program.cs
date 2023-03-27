using System;

namespace PW2
{
    class PlusOne
    {
        private int n = 0;
        public bool SetNumber(int n1)
        {
            if (n + 1 == n1)
            {
                this.n = n1;
                return true;
            }
            else
            {
                this.n = 0;
                Console.Clear();
                return false;
            }
        }

        public int GetNumber()
        {
            return n;
        }
    }

    class Program
    {
        static void Main(string[] args)
        {
            Console.WriteLine("Сравнитель чисел");
            PlusOne PO = new PlusOne();
            int n = 0;
            while (true)
            {
                Console.Write("Введите число: ");
                Console.WriteLine(PO.SetNumber(int.Parse(Console.ReadLine())));

            }
        }

    }
}
