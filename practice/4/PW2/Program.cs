using System;

namespace PW2
{
    class Parcel
    {
        public string AboutParcel { get;  private set; }
        public static double MassParcel { get; private set; }
        public string To { get; private set; }
        public string Name { get; private set; }

        public Parcel(double mass, string about, string to, string name)
        {
            AboutParcel = about;
            MassParcel = mass + MassParcel;
            To = to;
            Name = name;
        }
    }

    class Delivery
    {
        private int limitMass = 60;

        public void sendParcel(Parcel parcel)
        {
          if(Parcel.MassParcel > limitMass)
          {
            Console.WriteLine($"Невозможно отправить посылку, вес больше на: {Parcel.MassParcel - limitMass}");
          }
          else
          {
             Console.WriteLine($"Посылка {parcel.Name} успешно отправлена в {parcel.To}");
          }
        }
    }

    class Program
    {
        static void Main(string[] args)
        {
            Delivery Pochta = new Delivery();

            Console.Write($"Программа Корресподент" +
                $"\nОтправит корреспонденцию если она не превышает меру" +
                $"\nВведите данные бандероли (Имя/Описание/Вес/Назначение): ");

            string Info = Console.ReadLine();
            string[] correspodentInf = Info.Split(new char[] { ' ' }, StringSplitOptions.RemoveEmptyEntries); ;

            Parcel bander = new Parcel(Convert.ToDouble(correspodentInf[2]),correspodentInf[1],correspodentInf[3],correspodentInf[0]);

            Pochta.sendParcel(bander);
            Console.ReadKey(true);
        }
    }
}
