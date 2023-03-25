using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace PR52
{

    // Интерфейс фильтра
    interface IFilter
    {
        string Execute(string textLine);
    }

    // Класс числового фильтра
    class DigitFilter : IFilter
    {
        public string Execute(string textline)
        {

            // Возвращение строки без чисел с помощью метода Split и его аргумента
            return string.Concat(textline.Split("1234567890".ToCharArray(), StringSplitOptions.RemoveEmptyEntries));
        }
    }

    // Класс буквенного фильтра
    class LetterFilter : IFilter
    {
       public string Execute(string textline)
        {

            //Возвращение строки без букв с помощью метода Split и его аргумента
            return string.Concat(textline.Split("АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯяAaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz"
                .ToCharArray(), StringSplitOptions.RemoveEmptyEntries));
        }
    }

    class Program
    {
        static void Main(string[] args)
        {

            // Инициализация объектов с интерфейсом
            IFilter digfilter = new DigitFilter();
            IFilter letterfilter = new LetterFilter();

            //Инициализация переменной
            string outString;

            //Приветствие пользователя
            Console.Write("Вас приветствует \"Kluger Filter\"!" +
                "\nВозможности:" +
                "\n* Удаление букв кириллицы/латиницы;" +
                "\n* Удаление чисел" +
                "\n" +
                "\nВыберите действие (Б/Ч/В): ");

            // Ввод выбора
            char answ = char.Parse(Console.ReadLine());

            // Ввод полезного тела
            Console.Write("Введите вашу строку: ");
            string inString = Console.ReadLine();

            // Выбор и удаление символов
            if (answ == 'Б' | answ == 'б')
                outString = letterfilter.Execute(inString);
            else if (answ == 'Ч' | answ == 'ч')
                outString = digfilter.Execute(inString);
            else if (answ == 'В' | answ == 'в')
                outString = letterfilter.Execute(digfilter.Execute(inString));
            else
                outString = "Ошибка, в выборе";

            // Вывод рабочего тела
            Console.WriteLine(outString);
            Console.ReadKey();
        }
    }
}
