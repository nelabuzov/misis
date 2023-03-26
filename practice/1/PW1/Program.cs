using System;

namespace PW1
{
    class Car
    {
        public int maxSpeed;
        public string Name;
        public Car(int maxSpeed, string Name)
        {
            this.Name = Name;
            this.maxSpeed = maxSpeed;
        }

        public double CalculateTime(double distance)
        {
            return (distance / maxSpeed) * 100;
        }
    }

    class Program
    {
        static void Main(string[] args)
        {
            int distance = 100;
            string win = "";

            Random randomSpeed = new Random();
            int[] maxs = {
                randomSpeed.Next(100, 180),
                randomSpeed.Next(100, 180),
                randomSpeed.Next(100, 180),
                randomSpeed.Next(100, 180)
            };

            Random randomNum = new Random();
            string[] num = {
                "Машина -" +  randomNum.Next(0, 99),
                "Машина -" + randomNum.Next(0, 99),
                "Машина -" + randomNum.Next(0, 99),
                "Машина -" + randomNum.Next(0, 99)
            };

            Car car1 = new Car(maxs[0], num[0]);
            Car car2 = new Car(maxs[1], num[1]);
            Car car3 = new Car(maxs[2], num[2]);
            Car car4 = new Car(maxs[3], num[3]);

            double[] timeCalc = {
                car1.CalculateTime(distance),
                car2.CalculateTime(distance),
                car3.CalculateTime(distance),
                car4.CalculateTime(distance)
            };    

            double winner = timeCalc.Min();
            if (winner == timeCalc[0])
                win = num[0];
            else if (winner == timeCalc[1])
                win = num[1];
            else if (winner == timeCalc[2])
                win = num[2];
            else if (winner == timeCalc[3])
                win = num[3];

            Console.WriteLine($"Случайные гонки " +
                $"\nЗаезд на 100 км. " +
                $"\n\tПобедитель: \"{win}\""+
                $"\n{car1.Name}, \tV = {car1.maxSpeed} Км/ч, t = {timeCalc[0]:f2} м.;" +
                $"\n{car2.Name}, \tV = {car2.maxSpeed} Км/ч, t = {timeCalc[1]:f2} м.;" +
                $"\n{car3.Name}, \tV = {car3.maxSpeed} Км/ч, t = {timeCalc[2]:f2} м.;" +
                $"\n{car4.Name}, \tV = {car4.maxSpeed} Км/ч, t = {timeCalc[3]:f2} м.;");
            Console.ReadKey(true);
        }
    }
}
