using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace PR51
{
    //Интерфейс с методом 
    interface IHello
    {
        void SayHello();
    }

    //Дочерний класс с интерфейсом
    class EngHello : IHello
    {
        public void SayHello()
        {
            Console.WriteLine("Hello! Im from Britain");
        }
    }

    //Дочерний класс с интерфейсом
    class GerHallo : IHello
    {
        public void SayHello()
        {
            Console.WriteLine("Hallo! Ich komme aus Deutschland");
        }
    }

    //Дочерний класс с интерфейсом
    class PolWitam : IHello
    {
        public void SayHello()
        {
            Console.WriteLine("Cześć! Jestem z Polski");
        }
    }

    class Program
    {
        static void Main(string[] args)
        {
            //Инициализация коллекции 
            List<IHello> interNatHello = new List<IHello>();

            //Инициализации элементов коллекции с интерфейсом и дочерним классом
            interNatHello.Add(new EngHello());
            interNatHello.Add(new GerHallo());
            interNatHello.Add(new PolWitam());

            //Перебор элементов и вывод 
            foreach(IHello interhello in interNatHello)
            {
                interhello.SayHello();
            }

            Console.ReadKey();
        }
    }
}
