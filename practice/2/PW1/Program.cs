using System;

namespace PW1
{
    class QuadEqual
    {
        private double x, x1;
        private double x3 = 1;
        private double a, b, c, D;

        public void SetCoefficient(double a, double b, double c)
        {
            this.a = a;
            this.b = b;
            this.c = c;
        }

        public QuadEqual(double a, double b, double c)
        {
            this.a = a;
            this.b = b;
            this.c = c;
        }

        private double SetDiscriminant(double a, double b, double c)
        {
            return (Math.Pow(b, 2) - 4 * a * c);
        }

        public void CalculateRoots()
        {
            D = SetDiscriminant(a, b, c);
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
            QuadEqual QE = new QuadEqual();
            Console.Write("Арифмометр" +
                "\nПравила: " +
                "\n * Только слитные уравнения" +
                "\n * Для неполного уравнения впишите 0" +
                "\nВведите уравнение: ");
            string input = Console.ReadLine();
            Console.WriteLine("Решение: ");

            string[] chars = input.Replace("-", "+-").Split("+");
            if (chars[0] == "")
                chars[0] = chars[0] + chars[1];

            double[] numbers = new double[chars.Length];
            for (int i = 0; i < numbers.Length; i++)
                numbers[i] = double.Parse(chars[i].Replace("x", ""));

            QE.SetCoefficient(numbers[0], numbers[1], numbers[2]);
            QE.CalculateRoots();

            double[] xy = QE.GetX();
            for (int i = 0; i < xy.Length; i++)
                Console.WriteLine($" x{i}= {xy[i]}");
            Console.ReadKey(true);
        }
    }
}
