using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.IO;

namespace PR5
{
    //Интерфейс с методом Voice
    interface IAnimal
    {
        void Voice();
    }

    //Классы с интерфейсом IAnimal
    class Dog : IAnimal
    {
        public void Voice()
        {
            Console.WriteLine("Гав!");
        }
    }

    class Cat : IAnimal
    {
        public void Voice()
        {
            Console.WriteLine("Мяу!");
        }
    }

    class Pigeon : IAnimal
    {
        public void Voice()
        {
            Console.WriteLine("Курлык!");
        }
    }
    class Sparrow : IAnimal
    {
        public void Voice()
        {
            Console.WriteLine("Вик!");
        }
    }

    class Owl :  IAnimal
    {
        //Чтение времени(Часа) из файла
        private int GetCurrentTime()
        {
            return Convert.ToInt32(File.ReadAllText("current_time.txt"));
        }

        //Проверка времени и воспроизведение звука совы
        public void Voice()
        {
            int currentTime = GetCurrentTime();

            if((currentTime >=8) && (currentTime <=21))
            {
                Console.WriteLine("Тише, я сплю!");
            }
            else
            {
                Console.WriteLine("Ух! Ух! Ух!");
            }
        }
    }

    class Program
    {
        //Статический метод
        static void PetAnimal(IAnimal animal)
        {
            Console.WriteLine("Мы гладим зверушку, а она нам говорит: ");
             animal.Voice();
        }

        static void Main(string[] args)
        {
            //Приветствие пользователя
            Console.WriteLine("Вас приветсвует наш гладильный зоопарк!");

            //Инициализация объектов с интерфейсом и дочерним классом
            Dog tuzik = new Dog();
            PetAnimal(tuzik);

            Cat boris = new Cat();
            PetAnimal(boris);

            IAnimal hewdig = new Owl();
            PetAnimal(hewdig);

            IAnimal sparrow = new Sparrow();
            PetAnimal(sparrow);

            IAnimal pigeon = new Pigeon();
            PetAnimal(pigeon);

            Console.ReadKey(true);
        }
    }
}
