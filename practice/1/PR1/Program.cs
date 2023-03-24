using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace PR1
{
    class Car
    {
        public int maxSpeed;
        public string Name;
        public Car(int maxSpeed,string Name)
        {
            this.Name = Name;
            this.maxSpeed = maxSpeed;
        }
        //Расчёт времени гонщика в минутах, округление в большую сторону
        public double CalculateTime(double distance)
        {
            return (distance / maxSpeed)*100;
        }
    }
    class Program
    {
        static void Main(string[] args)
        {
            int distance = 100;
            string win = "";
            //Генерация значений скорости
            Random rndSpeed = new Random();
            int[] mXS = {
                rndSpeed.Next(100, 180),
                rndSpeed.Next(100, 180),
                rndSpeed.Next(100, 180),
                rndSpeed.Next(100, 180)
            };

            //Генерация номеров гонщиков
            Random rndNum = new Random();
            string[] num = {
                "Автомобиль-" +  rndNum.Next(0, 99),
                "Автомобиль-" + rndNum.Next(0, 99),
                "Автомобиль-" + rndNum.Next(0, 99),
                "Автомобиль-" + rndNum.Next(0, 99)
            };

            //Инициализация классов с конструкторами
            Car car1 = new Car(mXS[0], num[0]);
            Car car2 = new Car(mXS[1], num[1]);
            Car car3 = new Car(mXS[2], num[2]);
            Car car4 = new Car(mXS[3], num[3]);

            //Расчёт времени движения гонщика в минутах
            double[] timeC = {
                car1.CalculateTime(distance),
                car2.CalculateTime(distance),
                car3.CalculateTime(distance),
                car4.CalculateTime(distance)
            };    

            //Вычисление победителя
            double winner = timeC.Min();
            if (winner == timeC[0])
                win = num[0];
            else if (winner == timeC[1])
                win = num[1];
            else if (winner == timeC[2])
                win = num[2];
            else if (winner == timeC[3])
                win = num[3];

            //Вывод значений
            Console.WriteLine($"Случайные гонки " +
                $"\nЗаезд на 100Км " +
                $"\n\tПобедитель: \"{win}\""+
                $"\n{car1.Name}, \tV = {car1.maxSpeed} Км/ч, t = {timeC[0]:f2} м.;" +
                $"\n{car2.Name}, \tV = {car2.maxSpeed} Км/ч, t = {timeC[1]:f2} м.;" +
                $"\n{car3.Name}, \tV = {car3.maxSpeed} Км/ч, t = {timeC[2]:f2} м.;" +
                $"\n{car4.Name}, \tV = {car4.maxSpeed} Км/ч, t = {timeC[3]:f2} м.;");
            Console.ReadKey(true);
        }
    }
}
