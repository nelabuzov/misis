using System;

namespace PW6
{
    class RandomMath
    {
        public double Disperation { get { return CalcDispertion(); }  }
        public double Mediana { get { return CalcMediana(); } }
        public double QuadRev { get { return CalcQuadRev(); } }

        private int num;

        public RandomMath(int n)
        {
            num = n;
        }

        private int[] GetRandomNumber()
        {
            int[] randomNumber = new int[num];
            Random rand = new Random();
            for (int i = 0; i < randomNumber.Length; i++)
            {
                randomNumber[i] = rand.Next(10);
            }
            return randomNumber;
        }

        private double CalcDispertion()
        {
            int[] DispRandomNumber = new int[num];
            for (int i = 0; i < DispRandomNumber.Length; i++)
            {
                DispRandomNumber[i] = GetRandomNumber()[i];
            }

            // Вычитание значений от среднего арифметического и возведение в квадрат
            double DispMathAvg = DispRandomNumber.Average();
            double[] ChAvgNum = new double[num];
            for (int i=0;i<ChAvgNum.Length;i++)
            {
                ChAvgNum[i] = Math.Pow(DispRandomNumber[i] - DispMathAvg,2);
            }

            // Расчет суммы прошлого выражения
            double SumQuad = 0;
            for (int i=0; i<ChAvgNum.Length;i++)
            {
                SumQuad = ChAvgNum[i] + SumQuad;
            }

            // Расчет дисперсии
            return SumQuad / (DispRandomNumber.Length - 1);
        }

        // Расчет квадратичного отклонения
        private double CalcQuadRev()
        {

            // Отличие отклонения от дисперсии под корнем
            return Math.Sqrt(CalcDispertion());
        }

        // Расчет медианы
        private double CalcMediana()
        {

            // Сохранение массива со случайными данными
            int[] MedianaRandomNumber = new int[num];
            for (int i = 0; i < MedianaRandomNumber.Length; i++)
            {
                MedianaRandomNumber[i] = GetRandomNumber()[i];
            }

            // Расчет медианы
            int sum = MedianaRandomNumber.Sum();
            int accum = 0;
            for (int i = 0; i < MedianaRandomNumber.Length; i++)
            {
                accum += MedianaRandomNumber[i];
                if (accum >= sum / 2)
                    return i;
            }

            return MedianaRandomNumber.Length;
        }
    }

    class Program
    {
        static void Main(string[] args)
        {
            Console.Write("Программа математика" +
                "\nФункционал: "
                "\n* Вычисление медианы" +
                "\n* Вычисление дисперсии" +
                "\n* Вычисления среднеквадратичное откланения" +
                "\nВведите количество чисел: ");

            int num = int.Parse(Console.ReadLine());
            RandomMath randommath = new RandomMath(num);

            Console.Write($"Ответы: " +
                $"\nМедиана: {randommath.Mediana:f2}");
                $"\nДисперсия: {randommath.Disperation:f3};" +
                $"\nСреднеквадратичное отклонение: {randommath.QuadRev:f3};" +
            Console.ReadKey();
        }
    }
}
