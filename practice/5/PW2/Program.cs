using System;

namespace PW2
{
    interface Hello
    {
        void SayHello();
    }

    class EnglishHello : Hello
    {
        public void SayHello()
        {
            Console.WriteLine("Hello! I'm from USA");
        }
    }

    class GermanHello : Hello
    {
        public void SayHello()
        {
            Console.WriteLine("Hallo! Ich komme aus Deutschland");
        }
    }

    class PolishHello : Hello
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
            List<Hello> interNatHello = new List<Hello>();

            interNatHello.Add(new EnglishHello());
            interNatHello.Add(new GermanHello());
            interNatHello.Add(new PolishHello());

            foreach(Hello interhello in interNatHello)
            {
                interhello.SayHello();
            }

            Console.ReadKey();
        }
    }
}
