using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace PR41
{
    //Класс посылки
    class Parcel
    {
        //Инициализация свойств класса
        public string AboutParcel { get;  private set; }
        public static double MassParcel { get; private set; }
        public string To { get; private set; }
        public string Name { get; private set; }

        //Конструктор, принимающий значения свойств посылки
        public Parcel(double mass, string about, string to, string name)
        {
            AboutParcel = about;
            MassParcel = mass + MassParcel;
            To = to;
            Name = name;
        }

    }

    //Класс сервиса доставки
    class SrvDeliver
    {
        //Инициализация меры посылки
        private int limitMass = 60;

        //Метод отправки посылки
        public void sendParcel(Parcel parcel)
        {

           //Проверка посылки на перевес
          if(Parcel.MassParcel > limitMass)
          {
            Console.WriteLine($"Невозможно отправить посылку, так как её вес больше на: {Parcel.MassParcel - limitMass}");
          }
          else
          {
             Console.WriteLine($"Послыка {parcel.Name}, успешно отправлена в {parcel.To}");
          }
        }
    }

    class Program
    {
        static void Main(string[] args)
        {
            //Инициализация сервиса доставки
            SrvDeliver Pochta = new SrvDeliver();

            //Приветствие
            Console.Write($"Вас приветствует \"Корресподент-9000\"!" +
                $"\nМы отправим быстро вашу корреспонденцию, но только если она не превышает меру" +
                $"\nВведите пожалуйста данные вашей бандерольки (Имя/Описание/Вес/Назначение): ");

            //Приём строки и её разбитие на подстроки
            string corrInf = Console.ReadLine();
            string[] correspodentInf = corrInf.Split(new char[] { ' ' }, StringSplitOptions.RemoveEmptyEntries); ;
            
            //Выдача свойств посылки
            Parcel bander = new Parcel(Convert.ToDouble(correspodentInf[2]),correspodentInf[1],correspodentInf[3],correspodentInf[0]);

            //Отправка
            Pochta.sendParcel(bander);
            Console.ReadKey(true);
        }
    }
}
