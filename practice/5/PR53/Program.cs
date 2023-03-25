using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace PR53
{

    // Интерфейс с методом для создания фигур
    interface IShare
    {
        void Draw(int size);
    }

    // Класс позволяющий рисовать прямую вертикальную линию
    class VerticalLine : IShare
    {
        public void Draw(int size)
        {
            for(int i=0; i < size; i++)
            Console.Write("#");
        }
    }

    // Класс рисующий горизонтальную линию
    class HorizontalLine : IShare
    {
        public void Draw(int size)
        {
            for (int i = 0; i < size; i++)
                Console.WriteLine("#");
        }
    }

    // Класс отрисовывающий квадрат
    class Square : IShare
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

            // Инициализация объектов
            IShare square = new Square();
            IShare vertLine = new VerticalLine();
            IShare horline = new HorizontalLine();

            // Приветствие пользователя
            Console.Write("Вас приветсвует генератор простых и не очень геометрических фигур!" +
                "\nВозможности: " +
                "\n* Отрисовка вертикальных/горизонтальных линий;" +
                "\n* Отрисовка квадрата;" +
                "\n" +
                "\nВыберите фигуру (К/Г/В): ");

            // Получение ответа
            char answ = char.Parse(Console.ReadLine());

            // Получение размера фигуры
            Console.Write("Введите её размер: ");
            int size = int.Parse(Console.ReadLine());

            // Отступ
            Console.WriteLine("");

            // Отрисовка
            if (answ == 'К' | answ == 'к')
                square.Draw(size);
            else if (answ == 'Г' | answ == 'г')
                horline.Draw(size);
            else if (answ == 'В' | answ == 'в')
                vertLine.Draw(size);
            else
                Console.WriteLine("ОШИБКА, ВЫ ОШИБЛИСЬ ВЫБОРОМ");

            Console.ReadLine();
        }

    }
}
