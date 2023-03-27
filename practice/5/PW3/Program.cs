using System;

namespace PW3
{
    interface Filter
    {
        string Execute(string textLine);
    }

    class DigitFilter : Filter
    {
        public string Execute(string textline)
        {
            return string.Concat(textline.Split("1234567890".ToCharArray(), StringSplitOptions.RemoveEmptyEntries));
        }
    }

    class LetterFilter : Filter
    {
       public string Execute(string textline)
        {
            return string.Concat(textline.Split("АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯяAaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz"
                .ToCharArray(), StringSplitOptions.RemoveEmptyEntries));
        }
    }

    class Program
    {
        static void Main(string[] args)
        {
            Filter digitfilter = new DigitFilter();
            Filter letterfilter = new LetterFilter();

            string outString;

            Console.Write("Kluger Filter" +
                "\nФункционал: " +
                "\n* Удаление букв" +
                "\n* Удаление чисел" +
                "\nВыберите действие (Б/Ч/В): ");

            char answ = char.Parse(Console.ReadLine());

            Console.Write("Введите строку: ");
            string inString = Console.ReadLine();

            if (answ == 'Б' | answ == 'б')
                outString = letterfilter.Execute(inString);
            else if (answ == 'Ч' | answ == 'ч')
                outString = digitfilter.Execute(inString);
            else if (answ == 'В' | answ == 'в')
                outString = letterfilter.Execute(digitfilter.Execute(inString));
            else
                outString = "Ошибка выбора";

            Console.WriteLine(outString);
            Console.ReadKey();
        }
    }
}
