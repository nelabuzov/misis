using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace PR35
{
    class RndMath
    {
        //Инициализация свойств класса
        public double Disperation { get { return CalcDispertion(); }  }
        public double Mediana { get { return CalcMediana(); } }
        public double QuadRev { get { return CalcQuadRev(); } }

        //Инициализация длины выборки
        private int num;

        //Конструктор принимающий значения длинны поля
        public RndMath(int n)
        {
            num = n;
        }

        //Метод генерации массивов с рандомными числами
        private int[] GetRndNum()
        {
            int[] rndNum = new int[num];
            Random rand = new Random();
            for (int i = 0; i < rndNum.Length; i++)
            {
                rndNum[i] = rand.Next(10);
            }
            return rndNum;
        }

        //Расчёт дисперсии
        private double CalcDispertion()
        {
            //Сохранение массива с рандомными числами
            int[] DispRndNum = new int[num];
            for (int i = 0; i < DispRndNum.Length; i++)
            {
                DispRndNum[i] = GetRndNum()[i];
            }

            //Вычитание значений от среднегоарифметического и возведение во квадрат
            double DispMathAvg = DispRndNum.Average();
            double[] ChAvgNum = new double[num];
            for (int i=0;i<ChAvgNum.Length;i++)
            {
                ChAvgNum[i] = Math.Pow(DispRndNum[i] - DispMathAvg,2);
            }

            //Расчёт суммы прошлого выражения
            double SumQuad = 0;
            for (int i=0; i<ChAvgNum.Length;i++)
            {
                SumQuad = ChAvgNum[i] + SumQuad;
            }

            //Расчёт дисперсии
            return SumQuad / (DispRndNum.Length - 1);
        }

        //Расчёт квадратичного отклонения
        private double CalcQuadRev()
        {
            //Отличие отклонения от дисперсии в квадрате -> дисперсия под корнем
            return Math.Sqrt(CalcDispertion());
        }

        //Расчёт медианы
        private double CalcMediana()
        {
            //Сохранение массива со случайными данными
            int[] MedianaRndNum = new int[num];
            for (int i = 0; i < MedianaRndNum.Length; i++)
            {
                MedianaRndNum[i] = GetRndNum()[i];
            }

            //Расчёт медианы
            int sum = MedianaRndNum.Sum();
            int accum = 0;
            for (int i = 0; i < MedianaRndNum.Length; i++)
            {
                accum += MedianaRndNum[i];
                if (accum >= sum / 2)
                    return i;
            }

            return MedianaRndNum.Length;
        }
    }
    class Program
    {
        static void Main(string[] args)
        {
            //Приветствие пользователя
            Console.Write("Вас приветсвует Математик-1000! Данная программа способна:" +
                "\n* Вычислить медиану;" +
                "\n* Дисперсии;" +
                "\n* Среднеквадратичное откланение" +
                "\n" +
                "\nВведите количество чисел: ");

            //Вввод длины выборки
            int num = int.Parse(Console.ReadLine());

            //Расчёт
            RndMath rndmath = new RndMath(num);

            //Вывод значений
            Console.Write($"Ответы:" +
                $"\nДисперсия: {rndmath.Disperation:f3};" +
                $"\nСреднеквадратичное отклонение: {rndmath.QuadRev:f3};" +
                $"\nМедиана: {rndmath.Mediana:f2}");
            Console.ReadKey();
        }
    }
}
