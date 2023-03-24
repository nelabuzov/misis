using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace PR62
{
    //Родительский скласс
    class Human
    {
        //Инициализация свойств родительского класса
        public string Name { get; private set; }
        public byte Age { get; private set; }
        public char Sex { get; private set; }

        //Конструктор принимающий свойства родительского класса
        public Human(string man, byte age, char sex)
        {
            Name = man;
            Age = age;
            Sex = sex;
        }
    }

    //Дочерний класс
    class Worker : Human
    {
        //Инициализация свойства дочернего класса
        public string JobTitle { get; private set; }
        
        //Конструктор принимающий свойства родительского и дочерних классов
        public Worker(string man,  byte age, char sex, string jobtitle) : base(man,age,sex)
        {
            JobTitle = jobtitle;
        }
    }

    class Program
    {
        static void Main(string[] args)
        {
            //Создание объектов
            Worker Petrovich = new Worker("Иван Глушенко Петрович", 45, 'М', "Фрезеровщик");
            Worker Ivanovna = new Worker("Людмила Кузнечкова Ивановна", 56, 'Ж', "Повар");

            //Приветствие
            Console.WriteLine("Перепись работников завод по обработке тяжелых металлов" +
                "\nИмя                          \tДолжность \tВозраст\tПол");

            //Вывод "таблицы" со свойствами работников
            Console.WriteLine($"{Petrovich.Name}    \t{Petrovich.JobTitle}\t{Petrovich.Age}\t{Petrovich.Sex}");
            Console.WriteLine($"{Ivanovna.Name}\t{Ivanovna.JobTitle}    \t{Ivanovna.Age}\t{Ivanovna.Sex}");
            Console.ReadKey();
        }
    }
}
