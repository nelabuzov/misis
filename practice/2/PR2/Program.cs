using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace PR2
{
    class QuadEq
    {
        //Инициализация переменных
        private double x, x1;
        private double x3 = 1;
        private double a, b, c, D;

        //Установка коэффициентов
        public void SetCoefficient(double a,double b, double c)
        {
            this.a = a;
            this.b = b;
            this.c = c;
        }
        public QuadEq() { }
        public QuadEq(double a, double b, double c)
        {
            this.a = a;
            this.b = b;
            this.c = c;
        }

        //Расчёт Дискрименанта
        private double Dis(double a, double b, double c)
        {
            return (Math.Pow(b, 2) - 4 * a * c);
        }

        //Расчёт квадратных уравнений всех видов
        public void CalculateRoots()
        {
            D = Dis(a, b, c);
            if (b == 0 & c == 0)
            {
                x = 0;
            }
            else if (b == 0 & c != 0)
            {
                if (-(c / a) > 0)
                {
                    x = -Math.Sqrt(-(c / a));
                    x1 = Math.Sqrt(-(c / a));
                }
                else
                {
                    x3 = 0;
                }
            }
            else if (b != 0 & c == 0)
            {
                x = 0;
                x1 = -(b / a);
            }
            else
            {
                if (D == 0)
                {
                    x = -(b / (2 * a));
                }
                else if (D > 0)
                {
                    x = (-b - Math.Sqrt(D)) / (2 * a);
                    x1 = (-b + Math.Sqrt(D)) / (2 * a);
                }
                else
                {
                    x3 = 0;
                }
            }
        }

        //Вывод значений X's
        public double[] GetX()
        {
            if (x3 == 1)
            {
                double[] xy = new double[2] { x, x1 };
                return xy;
            }
            else
            {
                double[] xy = new double[1] { x3 };
                return xy;
            }
        }

    }

    class Program
    {
        static void Main(string[] args)
        {
            //Инициальзация переменных
            QuadEq Qe = new QuadEq();
            
            //Приветствие
            Console.Write("Вас приветствует Арифмометр 0.1" +
                "\nПравила пользования: " +
                "\n * Уравнение писать писать слитно, без \"=0\"" +
                "\n * Если уравнение неполное, то в недостоющие коэффициенты впишите 0" +
                "\nВведите уравнение: ");
            string input = Console.ReadLine();
            Console.WriteLine("Решение: ");
            
            //Проверка на -
            string[] chars = input.Replace("-","+-").Split('+');
            if (chars[0] == "")
                chars[0] = chars[0] + chars[1];    
            
            //Разбор на числа
            double[] numbers = new double[chars.Length];
            for (int i = 0; i < numbers.Length; i++)
                numbers[i] = double.Parse(chars[i].Replace("x", ""));

            //Ввод переменных
            //QuadEq Qe = new QuadEq(number[0],number[1],number[2]);
            Qe.SetCoefficient(numbers[0],numbers[1], numbers[2]);
            Qe.CalculateRoots();

            //Вывод значений
            double[] xy = Qe.GetX();
            for (int i = 0; i < xy.Length; i++)
                Console.WriteLine($" x{i}= {xy[i]}");
            Console.ReadKey(true);
        }
    }
}
