using System;

namespace PW1
{
    interface Animal
    {
        void Voice();
    }

    class Dog : Animal
    {
        public void Voice()
        {
            Console.WriteLine("Гав!");
        }
    }

    class Cat : Animal
    {
        public void Voice()
        {
            Console.WriteLine("Мяу!");
        }
    }

    class Pigeon : Animal
    {
        public void Voice()
        {
            Console.WriteLine("Курлык!");
        }
    }

    class Sparrow : Animal
    {
        public void Voice()
        {
            Console.WriteLine("Вик!");
        }
    }

    class Owl : Animal
    {
        private int GetCurrentTime()
        {
            return Convert.ToInt32(File.ReadAllText("current_time.txt"));
        }

        public void Voice()
        {
            int currentTime = GetCurrentTime();

            if((currentTime >=8) && (currentTime <=21))
            {
                Console.WriteLine("Я сплю!");
            }
            else
            {
                Console.WriteLine("Ух! Ух! Ух!");
            }
        }
    }

    class Program
    {
        static void PetAnimal(Animal animal)
        {
            Console.WriteLine("Гладим зверушку и она говорит: ");
             animal.Voice();
        }

        static void Main(string[] args)
        {
            Console.WriteLine("Зоопарк");

            Dog dog = new Dog();
            PetAnimal(dog);

            Cat cat = new Cat();
            PetAnimal(cat);

            Animal owl = new Owl();
            PetAnimal(owl);

            Animal sparrow = new Sparrow();
            PetAnimal(sparrow);

            Animal pigeon = new Pigeon();
            PetAnimal(pigeon);

            Console.ReadKey(true);
        }
    }
}
