using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace PR61
{
    //Родительский класс 
    class Vehicle
    {
        //Инициализация свойство класса
        public string Name { get; private set; }
        public double MaxSpeed { get; private set; }

        //Конструктор принимающий значения свойства
        public Vehicle(string name, double mxspeed)
        {
            Name = name;
            MaxSpeed = mxspeed;
        }

    }

    //Дочерний класс: Политех-машина
    class PolitehMachina : Vehicle
    {
        //Инициализация свойства класса
        public string Music { get; private set; }

        //Конструктор принимающий значения родительского и дочернего класса
        public PolitehMachina(string name, double mxspeed, string music) : base (name, mxspeed)
        {
            Music = music;
        }
        
        //Метод проигрывания композиций
        public void BadMusic()
        {
            Console.WriteLine($"Политех-машина громко включила плохую музыку: {Music}");
        }
     }

    //Дочерний класс, Самолёт
    class Airplane : Vehicle
    {
        //Инициализация свойства класса
        public string XxX { get; private set; }

        //Конструктор принимающий значения дочернего и родительского класса
        public Airplane(string name, double mxspeed, string xxx) : base (name, mxspeed)
        {
            XxX = xxx;
        }

        //Метод опыления города
        public void PollenAfield()
        {
            Console.WriteLine($"Самолёт \"{Name}\" со скоростью {MaxSpeed} опылил поле размером {XxX}");
        }
    }

    //Дочерний класс, Автобетоносмеситель
    class ConcreteMixer : Vehicle
    {
        //Инициализация свойства
        public string TypeConcrete { get; private set; }

        //Конструктор принимающий значения свойств родительского и дочернего класса
        public ConcreteMixer(string name, double mxspeed, string typeconcrete) : base (name,mxspeed)
        {
            TypeConcrete = typeconcrete;
        }

       //Метод выполняющий смешивание бетона
        public void MixThesolution()
        {
            Console.WriteLine($"{Name}, замешала раствор для бетона типа \"{TypeConcrete}\" ");
        }
    }

    class Program
    {
        static void Main(string[] args)
        {
            //Создание объектов
            PolitehMachina tazik = new PolitehMachina("Жигуль",100,"Rammstein Dicke Titten");
            Airplane Kukuruznik = new Airplane("Ан-2",250, "9x9");
            ConcreteMixer AutoMixer = new ConcreteMixer("КрАЗ-257", 80, "Пенобетон");

            //Приветствие
            Console.WriteLine("Вас приветствует: \"Симуляция жизни в городе, но не в спальном районе\"." +
                "\nВаше прекрасное время препровождение: \n");
            
            //Выполнение методов плохой музыки и автобетонасмесителя
            tazik.BadMusic();
            AutoMixer.MixThesolution();

            //Выполнение метода опыления поля
            Console.WriteLine("\nНе понравилось? Тогда вот вам симуляция \"Жизнь в селе\":");
            Kukuruznik.PollenAfield();

            Console.ReadKey();
        }
    }
}
