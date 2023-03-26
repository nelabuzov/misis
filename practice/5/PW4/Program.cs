using System;

namespace PW4
{
    interface Share
    {
        void Draw(int size);
    }

    class VerticalLine : Share
    {
        public void Draw(int size)
        {
            for(int i = 0; i < size; i++)
            Console.Write("#");
        }
    }

    class HorizontalLine : Share
    {
        public void Draw(int size)
        {
            for (int i = 0; i < size; i++)
                Console.WriteLine("#");
        }
    }

    class Square : Share
    {
       public void Draw(int size)
        {
            for (int i = 0; i < size; i++)
            {
                for (int j = 1; j < size; j++)
                    Console.Write("#");
                Console.WriteLine("#");
            }
        }
    }

    class Program
    {
        static void Main(string[] args)
        {
            Share square = new Square();
            Share verticalline = new VerticalLine();
            Share horizontalline = new HorizontalLine();

            Console.Write("Генератор геометрических фигур" +
                "\nВозможности: " +
                "\n* Отрисовка вертикальных/горизонтальных линий" +
                "\n* Отрисовка квадрата" +
                "\nВыберите фигуру (К/Г/В): ");

            char answer = char.Parse(Console.ReadLine());

            Console.Write("Введите размер: ");
            int size = int.Parse(Console.ReadLine());

            Console.WriteLine("");

            if (answer == 'К' | answer == 'к')
                square.Draw(size);
            else if (answer == 'Г' | answer == 'г')
                horizontalline.Draw(size);
            else if (answer == 'В' | answer == 'в')
                verticalline.Draw(size);
            else
                Console.WriteLine("Ошибка выбора");

            Console.ReadLine();
        }

    }
}
